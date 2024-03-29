<?php
namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Zeigt Expenses Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = \DB::table('expenses')
                        ->where('vehicle_id', session('vehicle'))
                        ->orderBy('created_at', 'desc')
                        ->paginate(6);

        $rData = $this->getMaxAndStep($expenses);

        return view('home.expenses.all', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expenses',
            'expenses' => $expenses,
            'maxAmount' => $rData['max'],
            'step' => $rData['step'],
            'prevQuery' => '',
            'prevSort' => '',
        ]);
    }

    /**
     * Zeigt Formular zum Erstellen einer Expense
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \App\ExpenseType::all();
        return view('home.expenses.create', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expenses',
            'types' => $types
        ]);
    }

    /**
     * Speichert neuen Expenses Eintrag in der Datenbank
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();

        $requestDate = \Carbon\Carbon::create($data['date'] . " 00:00:00");
        $currentDate = \Carbon\Carbon::now();

        $compareDateRequest = $requestDate->format('Y-m-d');
        $compareDateCurrent = $currentDate->format('Y-m-d');
        if($compareDateCurrent == $compareDateRequest) {
            $date = $data['current_timestamp'];
        } else {
            $date = $requestDate->format('Y-m-d') . " 00:00:00";
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
     * Zeigt eine einzelne Ausgabe
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('home.expenses.show', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expenses',
            'expense' => $expense
        ]);
    }

    /**
     * Zeigt das Bearbeitungsformular für Ausgaben
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('home.expenses.edit', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expenses',
            'expense' => $expense,
            'types' => \App\ExpenseType::all()
        ]);
    }

    /**
     * Expense wird nach Bearbeitung gespeichert
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $data = $request->validated();

        $requestDate = $data['date'];

        $date = \Carbon\Carbon::create($requestDate)->format('Y-m-d h:i:s');

        \DB::table('expenses')->where('id', $expense->id)->update([
            'expense_type_id' => $data['type'],
            'title' => $data['title'],
            'amount' => $data['amount'],
            'description' => $data['description'],
            'created_at' => $date
        ]);

        $request->session()->flash('notification', ["Expense saved", "{$data['amount']} {$data['title']}"]);

        return redirect('expenses');
    }

    /**
     * Expense $expense wird aus der Datenbank entfernt
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense, Request $request)
    {
        \DB::table('expenses')->where('id', $expense->id)->delete();

        $request->session()->flash('notification', ["Expense deleted", "{$expense->title}"]);
        return redirect('expenses');
    }

    /**
     * Gibt die Summer aller einzelnen Ausgabenkategorien für den Expenses Donut zurück-
     * Als Get Request muss hierbei der Parameter scope mitgeschickt werden.
     * Dieser kann 'all', 'week' oder 'year' enthalten
     * Die Summen werden je nach Scope ausgerechnet und zurückgegeben
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $data = [];

        // Daten werden dem Scope entsprechend aus Datenbank gelesen
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

            $service = \DB::table('expenses')->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 3]
            ])->get();
    
            $other = \DB::table('expenses')->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 4], 
            ])->get();
            
        } elseif ($request->scope == "month") {
            $all = \App\Expense::thisMonth()->where('vehicle_id', session('vehicle'))->get();

            $fuel = \App\Expense::thisMonth()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 1]
            ])->get();

            $tickets = \App\Expense::thisMonth()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 2]
            ])->get();

            $service = \App\Expense::thisMonth()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 3]
            ])->get();

            $other = \App\Expense::thisMonth()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 4]
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

            $service = \App\Expense::thisYear()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 3]
            ])->get();

            $other = \App\Expense::thisYear()->where([
                ['vehicle_id', session('vehicle')],
                ['expense_type_id', 4]
            ])->get();

        } else {
            return response()->json('Invalid Scope');
        }

        // Summen werden ausgerechnet um anschließend gerundet zu werden
        $sum        = $this->getSum($all);
        $fuelSum    = $this->getSum($fuel);
        $ticketSum  = $this->getSum($tickets);
        $serviceSum = $this->getSum($service);
        $otherSum   = $this->getSum($other);
        
        $data = [
            // Runden der Daten auf 2 Dezimalstellen und Datenzuweisung
            'sum'           => round($sum, 2),
            'ticket_sum'    => round($ticketSum, 2),
            'fuel_sum'      => round($fuelSum, 2),
            'service_sum'   => round($serviceSum, 2),
            'other_sum'     => round($otherSum, 2)
        ];

        // Senden der Daten im JSON Format
        return response()->json( $data );
    }

    /**
     * Addiert alle Ausgaben einer Expense Query zusammen und gibt Summe als Float zurück
     *
     * @param  \App\Expense[]  $expenses
     * @return float
     */
    private function getSum( $expenses )
    {
        $sum = 0;

        foreach($expenses as $e) {
            $sum += $e->amount;
        }

        return $sum;
    }

    /**
     * Sucht nach Titeln, die die geg. Query enthalten, in allen Expenses des aktuellen Fahrzeugs
     *
     * @param  string  $query
     * @return \Illuminate\Http\Response
     */
    public function getSearchResults(Request $request)
    {   

        if($request->sort === 'date') {
            $sort = 'created_at';
        } else {
            $sort = $request->sort;
        }

        $amountRange = explode(',', $request->amountRange);
        $amountMin = $amountRange[0];
        $amountMax = $amountRange[1];

        $results = \App\Expense::where([
            ['title', 'LIKE', "%".$request->q."%"],
            ['vehicle_id', session('vehicle')],
            ['amount', '>', $amountMin],
            ['amount', '<', $amountMax],
        ])->orderBy($sort, 'desc')->paginate(50);

        $allExpenses = \App\Expense::where('vehicle_id', session('vehicle'))->get();

        $rData = $this->getMaxAndStep($allExpenses);

        return view('home.expenses.showSearch', [
            'title' => 'Expenses Dashboard',
            'currentPage' => 'expenses',
            'expenses' => $results,
            'prevQuery' => $request->q,
            'prevSort' => $request->sort,
            'prevAmountRange' => [$amountMin, $amountMax],
            'maxAmount' => $rData['max'],
            'step' => $rData['step']
        ]);
    }

    public function getMaxAndStep($expenses) {
        $data = [];

        $maxAmount = 0;
        foreach($expenses as $entry) {
            if($entry->amount > $maxAmount) {
                $maxAmount = ceil($entry->amount);
            }
        }

        $step = ceil($maxAmount / 10);

        return [
            'max' => $maxAmount,
            'step' => $step
        ];
    }
}
