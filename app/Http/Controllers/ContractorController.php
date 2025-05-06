<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Contractor\StoreContractorRequest;
use App\Http\Requests\Contractor\UpdateContractorRequest;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contractor::select(
                'id',
                DB::raw('CONCAT_WS(" ", nombre, apellido) AS contratista'),
                'telefono',
                'correo',
                'provincia'
            );
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('contractor.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('contractor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contractor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractorRequest $request)
    {
        try {
            Contractor::create($request->all());
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
        $client = Contractor::find($id);
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Contractor::find($id);
        return view('contractor.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractorRequest $request, string $id)
    {
        $client = Contractor::find($id);
        $client->update($request->all());
        return redirect()->route('client.index')->with('success', 'Comitente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Contractor::find($id);
        if ($client->budgets()->exists() ) {
            return redirect()->route('client.index')->with('error', 'No se puede eliminar el Comitente porque tiene registros relacionados.');
        }
        $client->delete();
        return redirect()->route('client.index')->with('success', 'Comitente eliminado con exito');
    }
}
