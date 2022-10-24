<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
       [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($validate->fails()) {
            return(['status'=>0]);

       } Product::create($request->all());
       return(['status'=>1]);    
       
        

 
   }    
        
    

    public function show($id)
    {
        return Product::find($id);
    }


    public function update (Request $request, $id)
    {
       $validate = Validator::make($request->all(),
        [
            'name'=>'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

       if($validate->fails()){
        return(['status'=>0]);
       }else{
            $product = Product::find($request->id);
            $product->update($request->all());
            return(['status'=>1]);
      
    }
    }

    public function edit(Request $request)
    {    
        $validate = Validator::make($request->all(),
        [
            'name'=>'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
     if($validate->fails()){
        return(['status'=>0]);
       }else{
            $product->edit($request->all());
            return(['status'=>1]);
    }
    }
    

    

    public function destroy ($id)
    {
        $product = Product::destroy($id);
        if($product) 
        return response()->json(['message'=>'Silme Basarili']);
        else
        return response()->json(['message'=>'Kullanici bulunamadi']);
    }
    

    public function search($id)
    {
        return Product::where('name', 'like', '%'.$id.'%')->get();
    }

    
}
