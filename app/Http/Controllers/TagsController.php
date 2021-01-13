<?php

namespace App\Http\Controllers;

// IMPORT MODEL
use App\Tag;

use Illuminate\Http\Request;
// USE CUSTOM REQUEST
use App\Http\Requests\tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Default view for tags
        // Return VIEW with all tags
        return view('tags.index')->with('tags', Tag::all());
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        // VALIDATE DATA BEFORE STORE IN DB

        // STORE DATA IN DB
        // PROVIDE FILLABLE PROP
        Tag::create([
            'name' => $request->name
        ]);
        // Return FLASH MESSAGE
        session()->flash('success', 'Tag Created Successfully🙂');

        return redirect(route('tags.index'));
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
    public function edit(Tag $tag)
    {   // Return the Edit from with parameter
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request , Tag $tag)
    {   // REQUEST FIRST THEN DYNAMIC PARAMETER
        $tag->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Tag Saved Successfully🙂👍'); // MESSAGE TO DISPLAY
        return redirect(route('tags.index')); // RETURN TO MENU
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {
            $number = $tag->posts->count();
            if ($number > 2) {
                session()->flash('error', 'Tag cannot be deleted, Because it has '.$number.' of Post`s Associated.. 😔'); 
            }else{
                session()->flash('error', 'Tag cannot be deleted, Because it has '.$number.' Post Associated.. 😔'); 
            }
            
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success', 'Tag Deleted Successfully ✔');
        return redirect(route('tags.index'));
    }
}
