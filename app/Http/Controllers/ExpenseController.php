<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\ExpenseRequest;
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

        return view('home.expenses.all', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expenses',
            'expenses' => $expenses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \App\ExpenseType::all();
        return view('home.expenses.create', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expense',
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];

        if($date === NULL) {
            $date = new \Carbon\Carbon();
            $date = $date->toDateString();
        }

        if (!$request->session()->has('vehicle')) {
            $request->session()->flash('notification', ["Action Failed", "Please select a Vehicle."]);
            return redirect('expenses');
        }

        \DB::table('expenses')->insert([
            'vehicle_id' => session('vehicle'),
            'expense_type_id' => $data['type'],
            'title' => $data['title'],
            'amount' => $data['amount'],
            'description' => $data['description'],
            'created_at' => $date,
        ]);

        $request->session()->flash('notification', ["Added Expense", "{$data['amount']} {$data['title']}"]);

        return redirect('expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
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
    public function edit(Expense $expense)
    {
        return view('home.expenses.edit', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expense',
            'expense' => $expense,
            'types' => \App\ExpenseType::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $data = $request->validated();

        $date = $expense->created_at;

        if($data['date'] !== NULL) {
            $date = $data['date'];
        }

        \DB::table('expenses')->where('id', $expense->id)->update([
            'expense_type_id' => $data['type'],
            'title' => $data['title'],
            'amount' => $data['amount'],
            'description' => $data['description'],
            'created_at' => $date
        ]);

        $request->session()->flash('notification', ["Expense changed", "{$data['amount']} {$data['title']}"]);

        return redirect('expenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense, Request $request)
    {
        \DB::table('expenses')->where('id', $expense->id)->delete();

        $request->session()->flash('notification', ["Expense deleted", "{$expense->amount} {$expense->title}"]);
        return redirect('expenses');
    }

    /**
     * Gibt die Summe aller einzelnen Ausgaben als Array zurück
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $data = [];

        if($request->scope == "all") {

            $all = \DB::table('expenses')->where([
                ['vehicle_id', session('vehicle')]
            ])->get();
            
            $fuel = \DB::table('expenses')->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 1], 
            ])->get();
    
            $tickets = \DB::table('expenses')->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 2], 
            ])->get();
    
            $other = \DB::table('expenses')->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 3], 
            ])->get();
            
        } elseif ($request->scope == "week") {

            $all = \App\Expense::thisWeek()->where('vehicle_id', session('vehicle'))->get();

            $fuel = \App\Expense::thisWeek()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 1]
            ])->get();

            $tickets = \App\Expense::thisWeek()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 2]
            ])->get();

            $other = \App\Expense::thisWeek()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 3]
            ])->get();

        } else if ($request->scope == "year") {

            $all = \App\Expense::thisYear()->where('vehicle_id', session('vehicle'))->get();

            $fuel = \App\Expense::thisYear()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 1]
            ])->get();

            $tickets = \App\Expense::thisYear()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 2]
            ])->get();

            $other = \App\Expense::thisYear()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 3]
            ])->get();

        } else {
            return response()->json('Invalid Scope');
        }

        $sum = 0;
        foreach($all as $a) {
            $sum += $a->amount;
        }

        $fuelSum = 0;
        foreach($fuel as $f) {
            $fuelSum += $f->amount;
        }

        $ticketSum = 0;
        foreach($tickets as $t) {
            $ticketSum += $t->amount;
        }

        $otherSum = 0;
        foreach($other as $o) {
            $otherSum += $o->amount;
        }
        

        $data = [
            'sum' => $sum,
            'ticket_sum' => $ticketSum,
            'fuel_sum' => $fuelSum,
            'other_sum' => $otherSum
        ];


        return response()->json($data);;
    }
}
