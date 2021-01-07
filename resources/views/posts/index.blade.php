@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="bg-success">
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                        <!-- http://localhost/blog-system/public/storage/posts/4g3B40ZxXbclt0MN0PQRgiAQcH9GDTyggkzSDEgH.jpg -->
                            <td><img src="http://localhost/blog-system/public/storage/{{ $post->image }}" width="180px" height="100px" alt=""></td>
                            <td>{{$post->title}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 