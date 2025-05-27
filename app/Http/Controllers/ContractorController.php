<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            return redirect()->route('contractor.index')->with('success', 'Contratista creado con exito');
        } catch (\Throwable $th) {
            return redirect()->route('contractor.index')->with('error', 'Error al crear el Contratista: ' . $th->getMessage());
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
        $contractor = Contractor::find($id);
        return view('contractor.edit', compact('contractor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractorRequest $request, string $id)
    {
        $contractor = Contractor::find($id);
        $contractor->update($request->all());
        return redirect()->route('contractor.index')->with('success', 'Contratista actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contractor = Contractor::find($id);
        $contractor->delete();
        return redirect()->route('contractor.index')->with('success', 'Contratista eliminado con exito');
    }
}
