@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
        <div class="card-body bg-light">
        @include('partials.errors')
        
            <form action="{{isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @if(isset($post))
                    @method('PUT')
                @endif
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter Title" class="form-control" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Enter Description" cols="3" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                @if (isset($post))
                    <img src="http://localhost/blog-system/public/storage/{{ $post->image }}" style="width: 100%;" >
                @endif
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" placeholder="Enter Image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" 
                        @if(isset($post))
                            @if($category->id == $post->category->id)
                                selected
                            @endif
                        @endif
                        >{{$category->name}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="published_at">Publish at</label>
                    <input type="text" id="published_at" name="published_at"  class="form-control" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>

                <div class="form-group" align="right">
                    <button type="submit" class="btn btn-success">{{ isset($post) ? 'Save Post' : 'Create Post' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true
    });
</script>

    
@endsection