<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = \DB::table('expenses')->where('vehicle_id', session('vehicle'))->get();

        $ex_tik = [];
        $ex_gas = [];
        $ex_oth = [];

        foreach($expenses as $ex) {
            switch($ex->expense_type_id) {
                case 1:
                    $ex_gas[] = $ex;
                break;
                case 2:
                    $ex_tik[] = $ex;
                break;
                case 3:
                    $ex_oth[] = $ex;
                break;
                default:
                dd('Oops.. Something went wrong!');
            }
        }


        return view('home.expenses.all', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expense',
            'expenses' => $expenses,
            'tickets' => $ex_tik,
            'fuel' => $ex_gas,
            'other' => $ex_oth
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.expenses.create', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expense'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Expense $expense)
    {
        return view('home.expenses.show', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expense',
            'expense' => $expense
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('home.expenses.edit', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expense'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
