<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('category.index')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'description'=>'required|max:255'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();   // save data to database

        Session::flash('category_created','New category has been created...!');
        return redirect('/category/create');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category,$id)
    {
        $category = Category::find($id);
        if($category != null){
            return view('category.show')->with('category',$category);
        }else{
            Session::flash('category_notExist','This category with id '.$id.' is not exist in the database');
            return redirect('/category');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category,$id)
    {
        $category = Category::find($id);

        if($category != null){
            return view('category.edit')->with('category',$category);
        }else{
            Session::flash('category_notExist','This category with id '.$id.' is not exist in the database');
            return redirect('/category');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'description'=>'required|max:255'
        ]);
        if($validator->fails()){
            return redirect('/category/'.$id.'/edit')
            ->withInput()
            ->withErrors($validator);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        
        Session::flash('category_updated','Update Category Success...!');
        return redirect('/category/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category,$id)
    {
        $category = Category::find($id);
        
        if($category != null){
            $category->delete();
            Session::flash('category_delete','Delete Category Success...!');
            return redirect('/category');
        }else{
            Session::flash('category_notExist','This category with id '.$id.' is not exist in the database');
            return redirect('/category');
        }

        
    }
}
