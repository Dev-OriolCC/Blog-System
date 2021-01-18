<?php

namespace App\Http\Controllers;
// IMPORT MODELS
use App\Category;
use App\Tag;
use App\Post;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{   
    //
    public function index(){
        
        $search = request()->query('search');
        if ($search) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->paginate(4);
        }else{
            $posts = Post::paginate(3);
        }
        return view('welcome')
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $posts);
    }
}
