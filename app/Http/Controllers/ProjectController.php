<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Projects\StoreProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::with(['customer', 'budget', 'user'])
                ->select('projects.*')
                ->orderBy('created_at', 'desc');

            return DataTables::of($data)
                ->addColumn('cliente', function ($row) {
                    return $row->customer ? $row->customer->nombre . ' ' . $row->customer->apellido : 'N/A';
                })
                ->addColumn('total_presupuestado', function ($row) {
                    return $row->budget ?  $row->budget->total . ' ' . $row->budget->currency->abbreviation : 0;
                })
                ->addColumn('usuario', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })      
                ->addColumn('fecha', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('status_permission', function ($row) {
                    return $row->status_permission. ' ' .$row->permissions->count() . ' de 3';
                })
                ->addColumn('actions', function ($row) {
                    return view('projects.partials.actions', ['project' => $row])->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    public function getClients()
    {
        $clients = DB::table('customers')
            ->select('id', DB::raw('CONCAT_WS(" ", nombre, apellido) AS nombre'))
            ->get();
        return response()->json($clients);
    }

    public function getBudgets($client_id)
    {
        $budgets = Budget::with('currency')
                            ->where('customer_id', $client_id)
                            ->where('status', 'Aprobado')
                            ->get();
        return response()->json(['budgets' => $budgets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            // Iniciar transacción
            DB::beginTransaction();

            try {
                // Obtener el presupuesto seleccionado
                $budget = Budget::with(['customer', 'currency'])->findOrFail($request->budget_id);

                // Crear el proyecto
                $project = Project::create([
                    'name'              => $request->name,
                    'description'       => $request->description,
                    'url_image'         => $request->hasFile('url_image') ? $this->saveFile($request->file('url_image'), 'projects/') : null,
                    'customer_id'       => $budget->customer_id,
                    'budget_id'         => $budget->id,
                    'status'            => 'Pendiente',
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'address'           => $request->address,
                    'location'          => $request->location,
                    'province'          => $request->province,
                    'user_id'           => auth()->user()->id,
                ]);

                // Confirmar la transacción
                DB::commit();

                return redirect()->route('project.index')->with('success', 'Proyecto creado correctamente');
            
            } catch (\Exception $e) {
                // Revertir la transacción en caso de error
                DB::rollBack();
                return redirect()->route('project.index')->with('error', 'Error al crear el proyecto: ' . $e->getMessage());
            }

        } catch (\Exception $e) {
            return redirect()->route('project.index')->with('error', 'Error al crear el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    private function saveFile($file, $path)
    {
        try {
            if (!$file) {
                return null;
            }

            // Generar un nombre único para el archivo
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Crear el directorio si no existe
            $fullPath = storage_path('app/public/' . $path);
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            // Mover el archivo al directorio de almacenamiento
            $file->move($fullPath, $fileName);

            // Retornar la ruta relativa para guardar en la base de datos
            return $path . $fileName;
        } catch (\Exception $e) {
            throw new \Exception('Error al guardar la imagen: ' . $e->getMessage());
        }
    }
}
