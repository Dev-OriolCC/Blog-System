@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
        @if($users->count() > 0)
        <table class="table">
                <thead class="bg-success">
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>_</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                            @if(!$user->isAdmin())
                                <button type="submit" class="btn btn-success">Make Admin</button>
                            @endif
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No Users to display 😔😥</h3>
        @endif
        </div>
    </div>
@endsection 