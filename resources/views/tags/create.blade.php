@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}
        </div>
        <div class="card-body"> 
            @include('partials.errors')
            <!-- CREATE DYNAMIC ACTION & METHOD-->
            <form action="{{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}" method="POST">
            @if(isset($tag))
                @method('PUT')
            @endif

                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value="{{ isset($tag) ? $tag->name : '' }}" id="name" name="name" class="form-control" placeholder="Enter Name" >
                </div>
                <div class="form-group" align="right">
                    <button class="btn btn-success">{{ isset($tag) ? 'Save' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection