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
                    <th class="text-center">Name</th>
                    <th></th>
                </thead>
                <tbody>
                    <th>1</th>
                    <th>2</th>
                </tbody>
            </table>
        </div>
    </div>
@endsection 