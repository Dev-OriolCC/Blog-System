<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Middleware\VerifyCategoriesCount;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class PostsController extends Controller
{
    // Constructor to apply a single MiddleWare
    public function __construct(){
        $this->middleware('verifyCategoryCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the VIEW WITH CATEGORIES & TAGS
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all()) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // STORE TAGS ALSO
        // UPLOAD IMAGE TO DB
        $image = $request->image->store('posts');
        // STORE
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'published_at' => $request->published_at
        ]);
        // 
        if ($request->tags) {
            // MAKE RELATIONSHIP 
            $post->tags()->attach($request->tags);
        }
        // FLASH MSG
        session()->flash('success', 'Post Created Successfully! 🙂');
        // REDIRECT
        return redirect(route('posts.index'));
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
    public function edit(Post $post)
    {
        //
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // REQUEST DATA 
        $data = $request->only(['title', 'description', 'content', 'published_at']);
        if ($request->hasFile('image') ) {
            $image = $request->image->store('posts');
            $post->DeleteImage();    //Storage::delete($post->image);
            $data['image'] = $image;
        }
        $data['category_id'] = $request->category;
        $post->update($data);
        // UPDATE TAGS
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }


        session()->flash('success', 'Post Saved Successfully🙂👍'); // MESSAGE TO DISPLAY
        return redirect(route('posts.index')); // RETURN TO MENU
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->DeleteImage();   //Storage::delete($post->image);
            $post->forceDelete();
            session()->flash('success', 'Post Deleted Successfully 😃');
        }else{
            $post->delete();
            session()->flash('success', 'Post Trashed Successfully 😃');
        }
        return redirect(route('posts.index'));
    }
    //TRASH
    /** 
    * @return \Illuminate\Http\Response
    */
    public function trashed(){
        // Fetch Trash Post
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }
    //
    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post '.$post->name.' Restored Successfully🙂👍'); // MESSAGE TO DISPLAY
        return redirect(route('posts.index')); // RETURN TO MENU
    }
}
