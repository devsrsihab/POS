<?php

namespace App\Http\Controllers\admin;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeController extends Controller
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
        $data['employees'] = Employee::where('status',1)->get();
        return view('admin.employees.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());

        $validator = Validator::make($request->all(),[
            'name'       => 'required|string',
            'phone'      => 'required|numeric|digits:11',
            'email'      => 'required|email|unique:employees',
            'adress'     => 'required|max:100',
            'experience' => 'required|numeric|min:0|max:99',
            'photo'      => 'required|image|mimes:jpeg,png,jpg|max:2048', // jpeg,png,jpg and max s 2mb
            'salary'     => 'required|numeric|min:0|max:999999',
            'vacation'   => 'required|numeric:max:2',
            'city'       => 'required|string',
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
            $employee             = new Employee;
            $employee->name       = $request->name;
            $employee->phone      = $request->phone;
            $employee->email      = $request->email;
            $employee->adress     = $request->adress;
            $employee->experience = $request->experience;
            $employee->salary     = $request->salary;
            $employee->vacation   = $request->vacation;
            $employee->city       = $request->city;
            //import photo 
            if ($request->hasfile('photo')) {
                $file            = $request->file('photo');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/employees/',$fileName);
                $employee->photo = $fileName;
            }
            $employee->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Employee Created Successfully'
            ]);
            
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('admin.employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['employe'] = Employee::find($id);
        return view('admin.employees.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[
            'name'       => 'required|string',
            'phone'      => 'required|numeric|digits:11',
            'email'      => 'required|email|unique:employees,email,'.$id,
            'adress'     => 'required|max:100',
            'experience' => 'required|numeric|min:0|max:99',
            'photo'      => 'image|mimes:jpeg,png,jpg|max:2048', // jpeg,png,jpg and max s 2mb
            'salary'     => 'required|numeric|min:0|max:999999',
            'vacation'   => 'required|numeric:max:2',
            'city'       => 'required|string',
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
            $employee             = Employee::find($id);
            $employee->name       = $request->name;
            $employee->phone      = $request->phone;
            $employee->email      = $request->email;
            $employee->adress     = $request->adress;
            $employee->experience = $request->experience;
            $employee->salary     = $request->salary;
            $employee->vacation   = $request->vacation;
            $employee->city       = $request->city;
            //import photo 
            if ($request->hasfile('photo')) {
                //existing delete
                $path = 'uploads/employees/'.$employee->photo;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file            = $request->file('photo');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/employees/',$fileName);
                $employee->photo = $fileName;
            }
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
        $employee = Employee::find($id);

        if ($employee) {
            $employee->status = 0;
            $employee->save();
            return response()->json(['status'=>200,'message'=>'Employe Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Employe Not found']);

        }
        
    }
}
