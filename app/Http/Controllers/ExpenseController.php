<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\House;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ExpenseController
 * @package App\Http\Controllers
 */
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->m)) {
            $month = $request->m;
        } else {
            $month = date('m');
        }
        if (isset($request->y)) {
            $year = $request->y;
        } else {
            $year = date('Y');
        }
        if(isset($request->c)){
            $c = $request->c;
        }
        else{
            $c = "3";
        }
        $categories = Category::all();
        $turkishMonth = Carbon::create($year, $month)->translatedFormat('F');
        $oncekiAy = Carbon::create($year, $month)->subMonth();
        $sonrakiAy = Carbon::create($year, $month)->addMonth();
        if($c == 10){
            $expensequery = Expense::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('id', 'desc');
        }
        else{
            $expensequery = Expense::whereMonth('created_at', $month)->whereYear('created_at', $year)->whereCategory_id($c)->orderBy('id', 'desc');
        }

        $expenses = $expensequery->paginate();
        $expenseSum = $expensequery->sum('price');
        return view('expense.index', compact('expenseSum','month', 'year', 'c','categories','oncekiAy', 'sonrakiAy','expenses', 'turkishMonth'))
            ->with('i', (request()->input('page', 1) - 1) * $expenses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Expense::class);
        $houses = House::all();
        $categories = Category::all();
        $workers = Worker::all();
        $expense = new Expense();
        return view('expense.create', compact('expense', 'houses', 'categories', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Expense::class);
        request()->validate(Expense::$rules);

        $expense = Expense::create($request->all());
        /*   $expense->created_at = "2022-09-01";
           $expense->update();*/

        return redirect()->route('expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('create', Expense::class);
        $expense = Expense::find($id);

        return view('expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('create', Expense::class);
        $expense = Expense::find($id);
        $houses = House::all();
        $categories = Category::all();
        $workers = Worker::all();
        return view('expense.edit', compact('expense', 'houses', 'categories', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->authorize('create', Expense::class);
        request()->validate(Expense::$rules);

        $expense->update($request->all());

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('create', Expense::class);
        $expense = Expense::find($id)->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully');
    }
}
