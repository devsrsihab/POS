<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AdvancedSalary;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdvanceSalaryController extends Controller
{
  /**
     * make guard
     */
    public function __construct(){
        $this->middleware('adminAuth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $data['advanceSalaries'] = DB::table('advanced_salaries')
                                   ->join('employees','employees.id', '=', 'advanced_salaries.employe_id', )
                                   ->where('advanced_salaries.status','=',1)
                                   ->select('advanced_salaries.id','advanced_salaries.created_at','advanced_salaries.month','advanced_salaries.year','advanced_salaries.advance_salary','employees.name')
                                   ->get();

        return view('admin.advance_salary.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



        /* =================================================================
                            my practice
        ======================================================================*/

        //current date
        $currentDate  = Carbon::now();
        //end year date
        $endOfYear    = Carbon::parse('January 1')->addYear()->subDay();
        //current month
        $currentMonth = Carbon::now()->format('F');
        //reamin months
        $remainingMonths= [];

        
        //loop untile the $currentDate > $endOfYear
        while ($currentDate < $endOfYear) {

             $remainingMonth = $currentDate->format('F');

            //skip current month
            if ($currentMonth === $remainingMonth) {
                $currentDate->addMonth();
                continue;
            }

            //if $currentMonth !== $remainingMonth then run this code
            $remainingMonths[] = $remainingMonth;
            $currentDate->addMonth();
            
        }



        $employees = DB::table('employees')
                             ->where('employees.status',1)
                             ->select('employees.name','employees.id')
                             ->get();
        return view('admin.advance_salary.create',compact('employees','remainingMonths'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $validator = Validator::make($request->all(),[
            'employe_id'     => 'required|numeric',
            'month'          => 'required|numeric|digits_between:1,2',
            'year'           => 'required|numeric|digits_between:2,4',
            'advance_salary' => 'required|numeric',

        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

            //employe payment taken coutn
            $advanced_salaries = DB::table('advanced_salaries')
                                 ->where('employe_id',$request->employe_id)
                                 ->count();
            //duplicate
            $duplicate_month = DB::table('advanced_salaries')
                                ->where('month',$request->month)
                                ->count();

            // dd($duplicate_month);

            if ($advanced_salaries >=4 ) {

                //The employee has already received the maximum advance paid
                return response()->json([
                    'status' => 401,
                    'msgTitle' => 'Employee Took 3 Advances!',
                    'message' => 'The employee has already received the maximum number of advance salaries for the year.'
                ]);

            } 
            //check is month duplicate
            elseif ($duplicate_month >=1)
            {
                return response()->json([
                    'status' => 402,
                    'msgTitle' => 'Already Paid in This Month!',
                    'message' => 'The employee has already received this month Advance.'
                ]);
            }
            else{

                
                $advanceSalarie                 = new AdvancedSalary;
                $advanceSalarie->employe_id     = $request->employe_id;
                $advanceSalarie->month          = $request->month;
                $advanceSalarie->year           = $request->year;
                $advanceSalarie->advance_salary = $request->advance_salary;
                $advanceSalarie->save();
                //already advance paid 
                return response()->json([
                    'status' => 200,
                    'message' => 'Advanced Salary Given Successfully'
                ]);

            }

        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advanceSalary = AdvancedSalary::find($id);

        $employe = DB::table('employees')
                         ->where('id',$advanceSalary->employe_id)
                         ->select('employees.name','employees.id')
                         ->first($advanceSalary->$advanceSalary);

        return view('admin.advance_salary.show',compact('advanceSalary','employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
                //current date
                $currentDate  = Carbon::now();
                //end year date
                $endOfYear    = Carbon::parse('January 1')->addYear()->subDay();
                //current month
                $currentMonth = Carbon::now()->format('F');
                //reamin months
                $remainingMonths= [];
        
                
                //loop untile the $currentDate > $endOfYear
                while ($currentDate < $endOfYear) {
        
                     $remainingMonth = $currentDate->format('F');
        
                    //skip current month
                    if ($currentMonth === $remainingMonth) {
                        $currentDate->addMonth();
                        continue;
                    }
        
                    //if $currentMonth !== $remainingMonth then run this code
                    $remainingMonths[] = $remainingMonth;
                    $currentDate->addMonth();
                    
                }


        $advanceSalary = AdvancedSalary::find($id);

        //employees
        $employees = DB::table('employees')
        ->where('employees.status',1)
        ->select('employees.name','employees.id')
        ->get();
        return view('admin.advance_salary.edit',compact('employees','remainingMonths','advanceSalary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[
            'employe_id'     => 'required|numeric',
            'month'          => 'required|numeric|digits_between:1,2',
            'year'           => 'required|numeric|digits:4',
            'advance_salary' => 'required|numeric',
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
            $employee                 = AdvancedSalary::find($id);
            $employee->employe_id     = $request->employe_id;
            $employee->month          = $request->month;
            $employee->year           = $request->year;
            $employee->advance_salary = $request->advance_salary;
            $employee->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Advanced Salary  Updated Successfully'
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advancedSalary = AdvancedSalary::find($id);

        if ($advancedSalary) {
            $advancedSalary->status = 0;
            $advancedSalary->save();
            return response()->json(['status'=>200,'message'=>'Advanced Salary Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Advanced Salary Not found']);

        }
        
    }
}
