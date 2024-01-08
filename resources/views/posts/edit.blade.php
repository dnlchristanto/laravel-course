@extends('posts.layout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{route('posts.update',$posts->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <img src="{{asset('storage/posts/'.$posts->image)}}">
                    <div class="form-group">
                        <label>IMAGE</label>
                        <input name="image" type="file" class="form-control
                        @error('image')
                            is-invalid
                        @enderror" accept="image/png, image/jpg, image/jpeg">
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>TITLE</label>
                        <input name="title" type="text" class="form-control
                        @error('title')
                            is-invalid
                        @enderror" value="{{old('title',$posts->title)}}">
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>CONTENT</label>
                        <textarea name="content" class="form-control
                        @error('content')
                            is-invalid
                        @enderror">{{old('content',$posts->content)}}</textarea>
                        @error('content')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button href="{{'posts.update'}}" type="submit" class="btn btn-primary mt-3">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
@endsection
