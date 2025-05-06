<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::select(
                'id',
                'razon_social',
                DB::raw('CONCAT_WS(" ", nombre, apellido) AS proveedor'),
                'cuit',
                'telefono',
                'correo',
                'provincia'
            );
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('suppliers.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('suppliers.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        try {
            Supplier::create($request->all());
            return redirect()->route('supplier.index')->with('success', 'Proveedor creado con exito');
        } catch (\Throwable $th) {
            return redirect()->route('supplier.index')->with('error', 'Error al crear el Proveedor: ' . $th->getMessage());
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Proveedor actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
       
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Proveedor eliminado con exito');
    }
}
