<?php

namespace App\Http\Controllers\admin;

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
        $data['employees'] = DB::table('employees')
                             ->where('employees.status',1)
                             ->select('employees.name','employees.id')
                             ->get();
        return view('admin.advance_salary.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());

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
        else
        {
            $advanceSalarie                 = new AdvancedSalary;
            $advanceSalarie->employe_id     = $request->employe_id;
            $advanceSalarie->month          = $request->month;
            $advanceSalarie->year           = $request->year;
            $advanceSalarie->advance_salary = $request->advance_salary;
            $advanceSalarie->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Advance Salarie Paid Successfully'
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
        $data['employe'] = AdvancedSalary::find($id);
        return view('admin.advance_salary.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[
            'employe_id'     => 'required|numeric',
            'month'          => 'required|numeric|digits:2',
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
            $employee             = AdvancedSalary::find($id);
            $employee->name       = $request->name;
            $employee->phone      = $request->phone;
            $employee->email      = $request->email;
            $employee->adress     = $request->adress;
            $employee->experience = $request->experience;
            $employee->salary     = $request->salary;
            $employee->vacation   = $request->vacation;
            $employee->city       = $request->city;

            $employee->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Employee Updated Successfully'
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = AdvancedSalary::find($id);

        if ($employee) {
            $employee->status = 0;
            $employee->save();
            return response()->json(['status'=>200,'message'=>'Employe Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Employe Not found']);

        }
        
    }
}
