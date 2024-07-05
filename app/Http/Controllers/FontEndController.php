<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FontEndController extends Controller
{
    public function index(){
        $products = Product::orderByDesc('id')->paginate(8);
        $categories = Category::all();
        return view('frontend.index', compact('products','categories'));
        // return view('frontend.index')->with('products', Product::orderBy('id','DESC')->paginate(4));
    }

    public function show($id){
        $categories = Category::all();
        $products = Product::limit(8)->get();
        return view('frontend.showDetail')
               ->with('product', Product::find($id))
               ->with('products',$products)
               ->with('categories', $categories);
    }

    public function getBysearch(Request $request){
        $categories = Category::all();
        $keyword = !empty($request->input('keyword')) ? $request->input('keyword') : "" ;
        if($keyword != ""){
            $products = Product::where('name', 'LIKE', '%'.$keyword.'%')->paginate(4);
            return view('frontend.index')
                ->with('products', $products)
                ->with('keyword', $keyword)
                ->with('categories', $categories);
        }else{
            $products = Product::paginate(4);
            return view('frontend.index')
                ->with('products', $products)
                ->with('keyword', $keyword)
                ->with('categories', $categories);
        }
    }

    public function getByCategory($id){

        $categories = Category::all();
        $products = DB::table('products')->where('catId', $id)->paginate(3);
        return view('frontend.index')->with('products', $products)->with('categories', $categories);
    }
}
