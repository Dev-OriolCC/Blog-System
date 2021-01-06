@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body"> 
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
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