<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        // get posts
        $posts=Post::latest()->get();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //create posts
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        //validation form
        $this->validate($request,[
            'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            'title'=>'required|min:3',
            'content'=>'required|min:10'
        ]);

        //upload file
        $image=$request->file('image');
        $image->storeAs('public/posts/',$image->hashName());

        //create ke database
        Post::create([
            'image'=>$image->hashName(),
            'title'=>$request->title,
            'content'=>$request->content
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get post
        $posts=Post::findOrFail($id);
        return view('posts.show',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get post
        $posts=Post::findOrFail($id);
        return view('posts.edit',compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        //validation form
        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:2048',
            'title'=>'required|min:3',
            'content'=>'required|min:10'
        ]);

        // get post
        $posts=Post::findOrFail($id);

        //cek upload file ga?
        if ($request->hasFile('image')){
            //delete file
            Storage::delete('public/posts/'.$posts->image);

            //upload file
            $image=$request->file('image');
            $image->storeAs('public/posts/',$image->hashName());

            //update ke database
           $posts->update([
                'image'=>$image->hashName()
                ]);
        }

        //update ke database
        $posts->update([
            'title'=>$request->title,
            'content'=>$request->content
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get post
        $posts=Post::findOrFail($id);

        //delete file
        Storage::delete('public/posts/'.$posts->image);

        //delete record
        $posts->delete();

        return redirect()->route('posts.index');
    }
}
