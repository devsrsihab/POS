<?php

namespace App\Http\Controllers\admin;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * month array
     */
    public $expense_months = [

            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December' 
    ];
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(date('F'));
        $expenses = Expense::all();
        $expense_months = $this->expense_months;
        return view('admin.expenses.index',compact('expenses','expense_months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expenses.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'details' => 'required|string',
            'amount'  => 'required|numeric',
            '_token'  => 'required|in:'.csrf_token(),
            
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $expense          = new Expense;
            $expense->details = $request->details;
            $expense->amount  = $request->amount;
            $expense->month   = date('F');
            $expense->date    = date('d-m-Y');
            $expense->year    = date('Y');
            $expense->save();

            return response()->json([
                'status' => 200,
                'message' => 'Expense Created Successfully 201'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('admin.expenses.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'details' => 'required|string',
            'amount'  => 'required|numeric',
            
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $expense          = Expense::findOrFail($id);
            $expense->details = $request->details;
            $expense->amount  = $request->amount;
            $expense->save();

            return response()->json([
                'status' => 200,
                'message' => 'Expense Updated Successfully'
            ],202);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense  = Expense::findOrFail($id);

        if ($expense) {
            $expense->delete();
            return response()->json(['status'=>200,'message'=>'Expense Deleted Successfully']);

        } else {
            return response()->json(['status'=>404,'message'=>'Expense Not found']);

        }
        

    }


    // today expenses
    public function todayExpense($date)
    {
        $data['todayExpense'] = DB::Table('expenses')->where('date',$date)->get();
        $data['today_cost'] = DB::Table('expenses')->where('date',$date)->sum('amount');
        if ($data['todayExpense']) {
            return view('admin.expenses.today_expense',$data);

        }      
    }


    //ExpenseController
    public function monthlyExpense($month)
    {
        $data['monthlyExpense'] = DB::table('expenses')->where('month',$month)->get();
        $data['cost'] = DB::table('expenses')->where('month',$month)->sum('amount');

        if ($data['monthlyExpense']) {
            return view('admin.expenses.monthly_expense',$data);
        }
    }

    //ExpenseController
    public function yearlyExpense($year)
    {
        $data['yearlyExpense'] = DB::table('expenses')->where('year',$year)->get();
        $data['cost'] = DB::table('expenses')->where('year',$year)->sum('amount');

        if ($data['yearlyExpense']) {
            return view('admin.expenses.yearly_expense',$data);
        }
    }


}
