@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Create Category
        </div>
        <div class="card-body">            
            <form action="">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" >
                </div>
                <div class="form-group" align="right">
                    <button class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection