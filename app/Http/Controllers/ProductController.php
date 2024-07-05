<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $products = Product::orderBy('id', 'desc')->get();
            return view('product.index')->with('products',$products);
            
        }
        return redirect("/login")->withErrors('You do not have access..!');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        if(Auth::check()){

            $categories = array();
            foreach(Category::all() as $category){
                $categories[$category->id] = $category->name;
            }
            return view('product.create')->with('categories',$categories);
            
        }
        return redirect("/login")->withErrors('You do not have access..!');
        
    }

    /**
     * Store a newly created resource in storage.
    */

    public function store(Request $request)
    {
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png,gif',
                'catId'=>'required|integer'
            ]);
    
            if($validator->fails()){
                return redirect('/product/create')
                ->withInput()
                ->withErrors($validator);
            }
    
            $image = $request->file('image');
            $path  = 'img/';
            $fileName = date('Ymd-His').'-'.$image->getClientOriginalName();
            move_uploaded_file($image->getPathname(), $path.$fileName); 
    
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $fileName;
            $product->catId = $request->catId;
            
    
            $product->save();
            Session::flash('product_create','New Product has been Created');
            return redirect('/product/create');
            
        }
        return redirect("/login")->withErrors('You do not have access..!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
    */

    public function edit(Product $product,$id)
    {
        if(Auth::check()){
            $categories = array();
            foreach(Category::all() as $category){
                $categories[$category->id] = $category->name;
            }

            $product = Product::find($id);
            return view('product.edit')->with('product',$product)->with('categories',$categories);
            
        }
        return redirect("/login")->withErrors('You do not have access..!');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product,$id)
    {
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png,gif',
                'catId'=>'required|integer'
            ]);
    
            if($validator->fails()){
                return redirect('/product/'.$id.'/edit')
                ->withInput()
                ->withErrors($validator);
            }
    
            $product = Product::find($id);
            if($request->file('image') != " "){
                $image = $request->file('image');
                $path  = 'img/';
                $fileName = date('Ymd-His').'-'.$image->getClientOriginalName();
                move_uploaded_file($image->getPathname(), $path.$fileName); 
            }
    
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            if(isset($fileName)){
                $product->image = $fileName;
            }
            $product->catId = $request->catId;
    
            $product->save();
            Session::flash('product_update','Update Product Success...!');
            return redirect('/product/'.$id.'/edit');
        }

        return redirect("/login")->withErrors('You do not have access..!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product,$id)
    {
        if(Auth::check()){
            $product = Product::find($id);
            $img_path = 'img/'.$product->image;
            File::delete($img_path);
            $product->delete();
            Session::flash('product_delete','Delete Product Success...!');
            return redirect('/product');
            
        }
        return redirect("/login")->withErrors('You do not have access..!');
       
    }
}
