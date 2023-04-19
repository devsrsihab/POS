<?php

namespace App\Http\Controllers\admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('adminAuth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['customers'] = Customer::where('status',1)->get();
        return view('admin.customers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'           => 'required|string',
            'phone'          => 'required|numeric|digits:11',
            'email'          => 'required|email|unique:Suppliers',
            'adress'         => 'required|string|max:100',
          
            'photo'          => 'required|image|mimes:jpeg,png,jpg|max:2048', // jpeg,png,jpg and max s 2mb
            'shop'           => 'required|string',
            'bank_name'      => 'required|string',
            'branch_name'    => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|numeric|digits_between:13,17',
            'city'           => 'required|string',
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
            $Customer                 = new Customer;
            $Customer->name           = $request->name;
            $Customer->phone          = $request->phone;
            $Customer->email          = $request->email;
            $Customer->adress         = $request->adress;
            $Customer->shop           = $request->shop;
            $Customer->bank_name      = $request->bank_name;
            $Customer->branch_name    = $request->branch_name;
            $Customer->account_holder = $request->account_holder;
            $Customer->account_number = $request->account_number;
            $Customer->city           = $request->city;
            //import photo 
            if ($request->hasfile('photo')) {
                $file            = $request->file('photo');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/customers/',$fileName);
                $Customer->photo = $fileName;
            }
            $Customer->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Customer Created Successfully'
            ]);
            
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $data['customer'] = Customer::find($id);
        return view('admin.customers.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)

    {
        
        $data['customer'] = Customer::find($id);
        
        return view('admin.customers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'           => 'required|string',
            'phone'          => 'required|numeric|digits:11',
            'email'          => 'required|email|unique:Customers,email,'.$id,
            'adress'         => 'required|string|max:100',
            
            'photo'          => 'image|mimes:jpeg,png,jpg|max:2048', // jpeg,png,jpg and max s 2mb
            'shop'           => 'required|string',
            'bank_name'      => 'required|string',
            'branch_name'    => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|numeric|digits_between:13,17',
            'city'           => 'required|string',
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
            $Customer                 = Customer::find($id);
            $Customer->name           = $request->name;
            $Customer->phone          = $request->phone;
            $Customer->email          = $request->email;
            $Customer->adress         = $request->adress;
           
            $Customer->shop           = $request->shop;
            $Customer->bank_name      = $request->bank_name;
            $Customer->branch_name    = $request->branch_name;
            $Customer->account_holder = $request->account_holder;
            $Customer->account_number = $request->account_number;
            $Customer->city           = $request->city;
            //import photo
            if ($request->hasfile('photo')) {
                //existing delete
                $path = 'uploads/customers/'.$Customer->photo;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file            = $request->file('photo');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/customers/',$fileName);
                $Customer->photo = $fileName;
            }
            $Customer->save();

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
    public function destroy( $id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->status = 0;
            $customer->save();
            return response()->json(['status'=>200,'message'=>'Customer Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Customer Not found']);

        }
    }
}
