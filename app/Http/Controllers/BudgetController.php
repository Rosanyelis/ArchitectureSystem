<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\BudgetPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Budget::with(['customer', 'currency'])
                ->select('budgets.*')
                ->orderBy('created_at', 'desc');

            return DataTables::of($data)
                ->addColumn('cliente', function ($row) {
                    return $row->customer ? $row->customer->nombre . ' ' . $row->customer->apellido : 'N/A';
                })
                ->addColumn('moneda', function ($row) {
                    return $row->currency ? $row->currency->abbreviation : 'N/A';
                })
                ->addColumn('total_formatted', function ($row) {
                    return '$ ' . number_format($row->total, 0, ',', '.');
                })
                ->addColumn('fecha', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('abonado', function ($row) {
                    return '$ ' . number_format($row->payments->sum('amount'), 0, ',', '.');
                })
                ->addColumn('pendiente', function ($row) {
                    return '$ ' . number_format($row->total - $row->payments->sum('amount'), 0, ',', '.');
                })
                ->addColumn('estatus', function ($row) {
                    return $row->status;
                })
                ->addColumn('actions', function ($row) {
                    return view('budgets.partials.actions', ['budget' => $row,'pendiente' => $row->total - $row->payments->sum('amount'), 'moneda' => $row->currency->abbreviation])->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        $paymentMethods = DB::table('payment_methods')->get();
        $currencies = DB::table('currencies')->get();
        $dollarRate = DB::table('dollar_rates')->latest()->first() ?? 0;
        return view('budgets.index', compact('paymentMethods', 'currencies', 'dollarRate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = DB::table('customers')
            ->select('id', DB::raw('CONCAT_WS(" ", nombre, apellido) AS nombre'))
            ->get();
        return view('budgets.create', compact('clients'));
    }

    public function getClients()
    {
        $clients = DB::table('customers')
            ->select('id', DB::raw('CONCAT_WS(" ", nombre, apellido) AS nombre'))
            ->get();
        return response()->json($clients);
    }


    public function storeClient(Request $request)
    {
        $client = Customer::create($request->all());
        return response()->json($client);
    }

    public function getCurrencies()
    {
        $currencies = DB::table('currencies')
            ->get();
        return response()->json($currencies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar datos requeridos
            $request->validate([
                'client_id' => 'required|exists:customers,id',
                'currency_id' => 'required',
                'partidas' => 'required|json'
            ]);

            // Decodificar las partidas
            $partidas = json_decode($request->partidas, true);
            
            if (empty($partidas)) {
                return response()->json([
                    'message' => 'Debe agregar al menos una partida al presupuesto'
                ], 422);
            }

            // Calcular el total
            $total = array_sum(array_column($partidas, 'monto'));

            // Iniciar transacción
            DB::beginTransaction();

            try {
                // Crear el presupuesto
                $budget = Budget::create([
                    'customer_id' => $request->client_id,
                    'user_id' => auth()->user()->id,
                    'currency_id' => $request->currency_id,
                    'total' => $total
                ]);

                // Guardar las partidas
                foreach ($partidas as $partida) {
                    $budget->items()->create([
                        'type' => $partida['tipo'],
                        'amount' => $partida['monto']
                    ]);
                }

                // Si todo salió bien, confirmar la transacción
                DB::commit();

                return response()->json([
                    'message' => 'Presupuesto creado exitosamente',
                    'budget' => $budget
                ], 201);

            } catch (\Exception $e) {
                // Si algo salió mal, revertir la transacción
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el presupuesto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request,  $id)
    {
        try {   
            $budget = Budget::find($id);
            $budget->status = $request->status;
            $budget->save();
            return redirect()->back()->with('success', 'Estado actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el estado: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($budget)
    {
        $budget = Budget::with(['customer', 'currency', 'items', 'payments', 'payments.payment_method', 'payments.currency', 'payments.dollar_rate'])->find($budget);
        return response()->json(['budget' => $budget]);
    }
    
    public function getBudget($budget)
    {
        $budget = Budget::with(['customer', 'currency', 'items'])->findOrFail($budget);
        return response()->json(['budget' => $budget]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {  
        $budget = Budget::with(['customer', 'currency', 'items'])->findOrFail($id);
        return view('budgets.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validar datos requeridos
            $request->validate([
                'client_id' => 'required|exists:customers,id',
                'currency_id' => 'required',
                'partidas' => 'required|json'
            ]);

            // Decodificar las partidas
            $partidas = json_decode($request->partidas, true);
            
            if (empty($partidas)) {
                return response()->json([
                    'message' => 'Debe agregar al menos una partida al presupuesto'
                ], 422);
            }

            // Calcular el total
            $total = array_sum(array_column($partidas, 'monto'));

            // Iniciar transacción
            DB::beginTransaction();

            try {
                // Actualizar el presupuesto
                $budget = Budget::findOrFail($id);
                $budget->update([
                    'customer_id' => $request->client_id,
                    'currency_id' => $request->currency_id,
                    'total' => $total
                ]);

                // Eliminar partidas existentes
                $budget->items()->delete();

                // Guardar las nuevas partidas
                foreach ($partidas as $partida) {
                    $budget->items()->create([
                        'type' => $partida['type'],
                        'amount' => $partida['amount']
                    ]);
                }

                // Si todo salió bien, confirmar la transacción
                DB::commit();

                return response()->json([
                    'message' => 'Presupuesto actualizado exitosamente',
                    'budget' => $budget
                ], 200);

            } catch (\Exception $e) {
                // Si algo salió mal, revertir la transacción
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el presupuesto: ' . $e->getMessage()
            ], 500);
        }
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($budget)
    {
        $budget = Budget::findOrFail($budget);
        $budget->delete();
        return response()->json(['message' => 'Presupuesto eliminado exitosamente']);
    }

    /**
     * Procesa el pago de un presupuesto
     */
    public function processPayment(Request $request)
    {
        try {
            // Validar datos requeridos
            $request->validate([
                'budget_id' => 'required|exists:budgets,id',
                'payment_method' => 'required|exists:payment_methods,id',
                'currency_id' => 'required|exists:currencies,id',
                'dollar_rate_id' => 'required|exists:dollar_rates,id',
                'amount' => 'required|numeric|min:0',
                'amount_ars' => 'required|numeric|min:0',
                'concept' => 'required|string'
            ]);

            // Iniciar transacción
            DB::beginTransaction();

            try {
                // Obtener el presupuesto con sus pagos
                $budget = Budget::with('payments')->findOrFail($request->budget_id);
                
                // Calcular el monto total pagado hasta ahora
                $totalPaid = $budget->payments->sum('amount');
                $newTotalPaid = $totalPaid + $request->amount;

                // Validar que el nuevo pago no exceda el total del presupuesto
                if ($newTotalPaid > $budget->total) {
                    throw new \Exception('El monto del pago excede el total pendiente del presupuesto');
                }

                // Registrar el pago
                $payment = $budget->payments()->create([
                    'customer_id'           => $budget->customer_id,
                    'payment_method_id'     => $request->payment_method,
                    'currency_id'           => $request->currency_id,
                    'dollar_rate_id'        => $request->dollar_rate_id,
                    'amount'                => $request->amount,
                    'amount_pesos'          => $request->amount_ars,
                    'concept'               => $request->concept,
                    'payment_date'          => now()
                ]);

                // Actualizar el estado del pago del presupuesto
                if ($newTotalPaid >= $budget->total) {
                    $budget->status_payment = 'Pagado';
                } else {
                    $budget->status_payment = 'Pendiente';
                }
                $budget->save();

                // Confirmar la transacción
                DB::commit();

                return response()->json([
                    'message' => 'Pago registrado exitosamente',
                    'payment' => $payment,
                    'budget' => $budget
                ], 200);

            } catch (\Exception $e) {
                // Revertir la transacción en caso de error
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar el pago: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Muestra el pago de un presupuesto en pdf formato ticket
     */
    public function showPayment($budget, $payment)
    {
        $budget = Budget::with(['customer', 'currency', 'items', 'payments'])->findOrFail($budget);
        $payment = BudgetPayment::with(['payment_method', 'currency', 'dollar_rate'])->findOrFail($payment);
        return Pdf::loadView('budgets.partials.ticket', compact('budget', 'payment'))
            ->setPaper([0,0,150,1000])
            ->stream(''.config('app.name', 'Laravel').' - Recibo ' . $budget->id. '.pdf');
    }
}
