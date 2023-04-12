<?php

namespace App\Http\Controllers\admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    /**
     * auth guard
    */
    public function __construct(){
        $this->middleware('adminAuth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['Categories'] = Categorie::where('status',1)->get();
        return view('admin.Categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());

        $validator = Validator::make($request->all(),[
            'cate_name'    => 'required|string',
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
            $Categorie            = new Categorie;
            $Categorie->cate_name = $request->cate_name;
            $Categorie->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Categorie Created Successfully'
            ]);
            
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['Categorie'] = Categorie::find($id);
        return view('admin.Categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[
            'cate_name' => 'required|string',
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
            $Categorie            = Categorie::find($id);
            $Categorie->cate_name = $request->cate_name;
            $Categorie->save();

            //return 
            return response()->json([
                'status' => 200,
                'message' => 'Categorie Updated Successfully'
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Categorie = Categorie::find($id);

        if ($Categorie) {
            $Categorie->status = 0;
            $Categorie->save();
            return response()->json(['status'=>200,'message'=>'Categorie Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Categorie Not found']);

        }
        
    }
}
