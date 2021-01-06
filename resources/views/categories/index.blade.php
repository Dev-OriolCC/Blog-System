@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="bg-success">
                    <th class="text-center">Name</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="bg-light">
                            <td>{{$category->name}}</td>
                            <td align="right"><a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection