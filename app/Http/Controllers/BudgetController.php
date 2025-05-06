<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
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
            $data = Budget::with('customer')
                ->select(
                    'id',
                    DB::raw('CONCAT_WS(" ", customer.nombre, customer.apellido) AS comitente'),
                    'total',
                    'status'
                );
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('budgets.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('budgets.index');
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
