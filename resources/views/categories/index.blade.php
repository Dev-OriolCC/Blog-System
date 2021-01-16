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
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-success">
                            <th class="text-center">Name</th>
                            <th>Posts #</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr class="bg-light">
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->posts->count() }}</td>
                                    <td align="right">
                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger" onclick="HandleDelete({{ $category->id}} )">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h3 class="text-center">No Categories to display 😥</h3>
            @endif
        </div>
    </div>
    <!-- CUSTOM MODAL -->
    <form action="" method="POST" id="DeleteCategoryForm">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-bold">Are you sure you want to Delete this Category?🤔</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Yes, Delete</button>
                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal">NO</button>
                </div>
                </div>
            </div>
        </div>
    </form>
@endsection
<!-- HTML -->
@section('scripts')
    <script>
    // This is JAVASCRIPT 
        function HandleDelete(id){
            var form = document.getElementById('DeleteCategoryForm');
            form.action = 'categories/'+id
            // OPEN MODAL
            $('#deleteModal').modal('show');
        }
        
    </script>
@endsection