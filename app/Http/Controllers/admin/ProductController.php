<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        $data['products'] = Product::where('status',1)->get();
        return view('admin.products.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());

        $validator = Validator::make($request->all(),[
            'product_name'   => 'required|string',
            'cat_id'         => 'required|numeric',
            'sup_id'         => 'required|numeric',
            'product_code'   => 'required|numeric',
            'product_garage' => 'required|string',
            'product_route'  => 'required|string',
            'product_image'  => 'required|image|mimes:jpeg,png,jpg|max:2048', //max s 2mb,
            'buy_date'       => 'required|string',
            'expire_date'    => 'required|string',
            'buying_price'   => 'required|numeric',
            'selling_price'  => 'required|numeric',
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
            $Product                 = new Product;
            $Product->product_name   = $request->product_name;
            $Product->cat_id         = $request->cat_id;
            $Product->sup_id         = $request->sup_id;
            $Product->product_code   = $request->product_code;
            $Product->product_garage = $request->product_garage;
            $Product->product_route  = $request->product_route;
            $Product->buy_date       = $request->buy_date;
            $Product->expire_date    = $request->expire_date;
            $Product->buying_price   = $request->buying_price;
            $Product->selling_price  = $request->selling_price;
            //import photo 
            if ($request->hasfile('product_image')) {
                $file            = $request->file('product_image');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/Products/',$fileName);
                $Product->product_image = $fileName;
            }
            $Product->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Product Created Successfully'
            ]);
            
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['supplier'] = Product::find($id);
        return view('admin.products.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['supplier'] = Product::find($id);
        return view('admin.products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[
            'product_name'   => 'required|string',
            'cat_id'         => 'required|numeric',
            'sup_id'         => 'required|numeric',
            'product_code'   => 'required|numeric',
            'product_garage' => 'required|string',
            'product_route'  => 'required|string',
            'product_image'  => 'required|image|mimes:jpeg,png,jpg|max:2048', //max s 2mb,
            'buy_date'       => 'required|string',
            'expire_date'    => 'required|string',
            'buying_price'   => 'required|numeric',
            'selling_price'  => 'required|numeric',
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
            $Product                 = new Product;
            $Product->product_name   = $request->product_name;
            $Product->cat_id         = $request->cat_id;
            $Product->sup_id         = $request->sup_id;
            $Product->product_code   = $request->product_code;
            $Product->product_garage = $request->product_garage;
            $Product->product_route  = $request->product_route;
            $Product->buy_date       = $request->buy_date;
            $Product->expire_date    = $request->expire_date;
            $Product->buying_price   = $request->buying_price;
            $Product->selling_price  = $request->selling_price;
            //import photo 
            if ($request->hasfile('product_image')) {
                $file            = $request->file('product_image');
                $extention       = $file->getClientOriginalExtension();
                $fileName        = time() . '.' . $extention;
                $file->move('uploads/Products/',$fileName);
                $Product->product_image = $fileName;
            }
            $Product->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Product Updated Successfully'
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Product = Product::find($id);

        if ($Product) {
            $Product->status = 0;
            $Product->save();
            return response()->json(['status'=>200,'message'=>'Product Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Product Not found']);

        }
        
    }
}
