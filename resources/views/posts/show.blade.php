@extends('posts.layout')
@section('content')
    <div class="container">
        <h1 class="text-center">POST {{$posts->title}}</h1>
        <div class="card">
            <div class="card-body">
                <a href="{{route('posts.index')}}" class="btn btn-primary">Back</a>

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
                        <tbody>
                            <tr>
                                <td><img src="{{asset('storage/posts/'.$posts->image)}}"></td>
                                <td>{{$posts->title}}</td>
                                <td>{{$posts->content}}</td>
                            </tr>
                        </tbody>
                    </tbody>
                  </table>
            </div>
          </div>
    </div>
@endsection
