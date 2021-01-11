@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body"> 
            @include('partials.errors')
                <!-- CREATE DYNAMIC ACTION & METHOD-->
            <form action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="POST">
            @if(isset($category))
                @method('PUT')
            @endif

                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value="{{ isset($category) ? $category->name : '' }}" id="name" name="name" class="form-control" placeholder="Enter Name" >
                </div>
                <div class="form-group" align="right">
                    <button class="btn btn-success">{{ isset($category) ? 'Save' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection