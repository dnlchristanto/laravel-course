<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index():View
    {
        // get posts
        $posts=Post::latest();
        return view('posts.index',compact('posts'));
    }

    public function create()
    {

    }
}
