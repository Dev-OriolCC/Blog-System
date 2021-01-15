@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">My Profile</div>
    <div class="card-body">
        <form action="{{route('users.update')}}" method="POST">
        @include('partials.errors')
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="about">About Me</label>
                <textarea name="about" id="about" cols="4" class="form-control" rows="3">{{$user->about}}</textarea>
            </div>
        <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>

@endsection