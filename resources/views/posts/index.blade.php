@extends('posts.layout')
@section('content')
    <div class="container">
        <h1 class="text-center">CRUD POST LARAVEL</h1>
        <div class="card">
            <div class="card-body">
                <a href="{{route('posts.create')}}" class="btn btn-primary">Tambah Post</a>

                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">IMAGE</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">KONTEN</th>
                        <th scope="col">ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                            @if (count($posts)>0)
                                @foreach ($posts as $post)
                                    <tr>
                                        <td><img src="{{asset('storage/posts/'.$post->image)}}"></td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->content}}</td>
                                        <td>
                                            <a href="{{route('posts.show',$post->id)}}" class="btn btn-dark">Show</a>
                                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                                            {{--<a href="{{route('posts.destroy',$post->id)}}" class="btn btn-primary">Delete</a>--}}
                                            <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>BELUM ADA DATA</td>
                                </tr>
                            @endif
                    </tbody>
                  </table>
            </div>
          </div>
    </div>
@endsection
