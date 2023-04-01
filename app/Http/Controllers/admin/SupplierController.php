<?php

namespace App\Http\Controllers\admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
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
        $data['suppliers'] = Supplier::where('status',1)->get();
        return view('admin.Suppliers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());

        $validator = Validator::make($request->all(),[
            'name'           => 'required|string',
            'phone'          => 'required|numeric|digits:11',
            'email'          => 'required|email|unique:Suppliers',
            'adress'         => 'required|string|max:100',
            'type'           => 'required',
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
            $Supplier                 = new Supplier;
            $Supplier->name           = $request->name;
            $Supplier->phone          = $request->phone;
            $Supplier->email          = $request->email;
            $Supplier->adress         = $request->adress;
            $Supplier->type           = $request->type;
            $Supplier->shop           = $request->shop;
            $Supplier->bank_name      = $request->bank_name;
            $Supplier->branch_name    = $request->branch_name;
            $Supplier->account_holder = $request->account_holder;
            $Supplier->account_number = $request->account_number;
            $Supplier->city           = $request->city;
            //import photo 
            if ($request->hasfile('photo')) {
                $file            = $request->file('photo');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/Suppliers/',$fileName);
                $Supplier->photo = $fileName;
            }
            $Supplier->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Supplier Created Successfully'
            ]);
            
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['supplier'] = Supplier::find($id);
        return view('admin.suppliers.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['supplier'] = Supplier::find($id);
        return view('admin.Suppliers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[
            'name'           => 'required|string',
            'phone'          => 'required|numeric|digits:11',
            'email'          => 'required|email|unique:Suppliers,email,'.$id,
            'adress'         => 'required|string|max:100',
            'type'           => 'required',
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
            $Supplier                 = Supplier::find($id);
            $Supplier->name           = $request->name;
            $Supplier->phone          = $request->phone;
            $Supplier->email          = $request->email;
            $Supplier->adress         = $request->adress;
            $Supplier->type           = $request->type;
            $Supplier->shop           = $request->shop;
            $Supplier->bank_name      = $request->bank_name;
            $Supplier->branch_name    = $request->branch_name;
            $Supplier->account_holder = $request->account_holder;
            $Supplier->account_number = $request->account_number;
            $Supplier->city           = $request->city;
            //import photo 
            if ($request->hasfile('photo')) {
                //existing delete
                $path = 'uploads/Suppliers/'.$Supplier->photo;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file            = $request->file('photo');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/Suppliers/',$fileName);
                $Supplier->photo = $fileName;
            }
            $Supplier->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Supplier Updated Successfully'
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Supplier = Supplier::find($id);

        if ($Supplier) {
            $Supplier->status = 0;
            $Supplier->save();
            return response()->json(['status'=>200,'message'=>'Employe Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Employe Not found']);

        }
        
    }
}
