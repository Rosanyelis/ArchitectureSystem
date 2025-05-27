<?php

namespace App\Http\Controllers;

use App\Models\DollarRate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DollarRate\StoreDollarRateRequest;
use App\Http\Requests\DollarRate\UpdateDollarRateRequest;

class DollarRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DollarRate::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('dollar-rate.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dollar-rate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dollar-rate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDollarRateRequest $request)
    {
        try {
            DollarRate::create($request->all());
            return redirect()->route('dollar-rate.index')->with('success', 'Tasa de dolar creado con exito');
        } catch (\Exception $e) {
            return redirect()->route('dollar-rate.index')->with('error', 'Error al crear la tasa de dolar: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dollarRate = DollarRate::find($id);
        return view('dollar-rate.edit', compact('dollarRate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDollarRateRequest $request, string $id)
    {
        $dollarRate = DollarRate::find($id);
        $dollarRate->update($request->all());
        return redirect()->route('dollar-rate.index')->with('success', 'Tasa de dolar actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dollarRate = DollarRate::find($id);
        $dollarRate->delete();
        return redirect()->route('dollar-rate.index')->with('success', 'Tasa de dolar eliminado con exito');
    }
}
