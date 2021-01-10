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
        @if($posts->count() > 0)
        <table class="table">
                <thead class="bg-success">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                        <!-- http://localhost/blog-system/public/storage/posts/4g3B40ZxXbclt0MN0PQRgiAQcH9GDTyggkzSDEgH.jpg -->
                            <td><img src="http://localhost/blog-system/public/storage/{{ $post->image }}" width="180px" height="100px" alt=""></td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>
                                @if (!$post->trashed())
                                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-success">Edit</a>
                                @else
                                <form action="{{route('restore-posts', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                                    
                                @endif
                            </td>
                            <td>
                                <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"> {{ $post->trashed() ? 'Delete' : 'Trash' }} </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No Posts to display 😔😥</h3>
        @endif
        </div>
    </div>
@endsection 