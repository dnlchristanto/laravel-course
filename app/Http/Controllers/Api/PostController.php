<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::latest()->get();
        return new PostResource(True,'daftar post',$posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation form
        $validator=Validator::make($request->all(),[
            'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            'title'=>'required|min:3',
            'content'=>'required|min:10'
        ]);

        //check if validation failed
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        //upload file
        $image=$request->file('image');
        $image->storeAs('public/posts/',$image->hashName());

        //create ke database
        $post=Post::create([
            'image'=>$image->hashName(),
            'title'=>$request->title,
            'content'=>$request->content
        ]);

        //return responnya
        return new PostResource(True,'create post',$post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    //public function show(string $id)
    {
        //$post=Post::findOrFail($id);

        //return responnya
        return new PostResource(True,'show post',$post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation form
        $validator=Validator::make($request->all(),[
            //'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            'title'=>'required|min:3',
            'content'=>'required|min:10'
        ]);

        //check if validation failed
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $post=Post::findOrFail($id);
        if($request->hasFile('image')){
            //delete file
            Storage::delete('public/posts/'.$post->image);

            //upload image
            $image=$request->file('image');
            $image->storeAs('public/posts/',$image->hashName());

            //update database
            $post->update([
                'image'=>$image->hashName(),
                'title'=>$request->title,
                'content'=>$request->content
            ]);
        }else{
            //update database
            $post->update([
                'title'=>$request->title,
                'content'=>$request->content
            ]);
        }
        //return responnya
        return new PostResource(True,'update post',$post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post=Post::findOrFail($id);
        //delete file
        Storage::delete('public/posts/'.$post->image);

        //delete record
        $post->delete();

        //return responnya
        return new PostResource(True,'delete post',$post);
    }
}
