<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select(
                'id',
                DB::raw('CONCAT_WS(" ", nombre, apellido) AS comitente'),
                'telefono',
                'correo',
                'provincia'
            );
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('clients.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            Customer::create($request->all());
            return redirect()->route('client.index')->with('success', 'Comitente creado con exito');
        } catch (\Throwable $th) {
            return redirect()->route('client.index')->with('error', 'Error al crear el Comitente: ' . $th->getMessage());
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Customer::find($id);
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Customer::find($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $client = Customer::find($id);
        $client->update($request->all());
        return redirect()->route('client.index')->with('success', 'Comitente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Customer::find($id);
        if ($client->budgets()->exists() ) {
            return redirect()->route('client.index')->with('error', 'No se puede eliminar el Comitente porque tiene registros relacionados.');
        }
        $client->delete();
        return redirect()->route('client.index')->with('success', 'Comitente eliminado con exito');
    }
}
