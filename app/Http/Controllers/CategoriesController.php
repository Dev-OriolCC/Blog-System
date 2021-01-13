<?php

namespace App\Http\Controllers;

// IMPORT MODEL
use App\Category;

use Illuminate\Http\Request;
// USE CUSTOM REQUEST
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Default view for Categories
        // Return VIEW with all Categories
        return view('categories.index')->with('categories', Category::all());
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // VALIDATE DATA BEFORE STORE IN DB

        // STORE DATA IN DB
        // PROVIDE FILLABLE PROP
        Category::create([
            'name' => $request->name
        ]);
        // Return FLASH MESSAGE
        session()->flash('success', 'Category Created Successfully🙂');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {   // Return the Edit from with parameter
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request , Category $category)
    {   // REQUEST FIRST THEN DYNAMIC PARAMETER
        $category->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Category Saved Successfully🙂👍'); // MESSAGE TO DISPLAY
        return redirect(route('categories.index')); // RETURN TO MENU
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->posts->count() > 0) {
            $number = $category->posts->count();
            if ($number > 1) {
                session()->flash('error', 'Category cannot be Deleted, Because '.$number.' Post`s are associated to it');
            }else{
                session()->flash('error', 'Category cannot be Deleted, Because '.$number.' Post is associated to it');
            }
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success', 'Category Deleted Successfully 🗑');
        return redirect(route('categories.index'));
    }
}
