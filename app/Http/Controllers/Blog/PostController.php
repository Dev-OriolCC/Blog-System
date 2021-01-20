<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// IMPORT MODELS
use App\Post;
use App\Tag;

class PostController extends Controller
{
    public function show(Post $post){
        return view('blog.show')->with('post', $post);
    }
    // CAT METHOD
    public function category(Category $category){
    $search = request()->query('search');
    if ($search) {
        # Search in specific Category
        $posts = $category->posts()->where('title', 'LIKE', "%{$search}")->paginate(4);
    }else{
        $posts = $category->posts()->paginate(4);
    }

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $posts)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
    // TAG METHOD
    public function tag(Tag $tag){
        return view('blog.tag')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->paginate(4))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
