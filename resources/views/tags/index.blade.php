@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('tags.create') }}" class="btn btn-success">Create Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead class="bg-success">
                        <th class="text-center">Name</th>
                        <th>Post #</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr class="bg-light">
                                <td>{{$tag->name}}</td>
                                <td>0</td>
                                <td align="right">
                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger" onclick="HandleDelete({{ $tag->id}} )">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Tags to display 😥</h3>
            @endif
        </div>
    </div>
    <!-- CUSTOM MODAL -->
    <form action="" method="POST" id="DeleteTagForm">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">Delete Tag</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-bold">Are you sure you want to Delete this Tag?🤔</p>
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
            var form = document.getElementById('DeleteTagForm');
            form.action = 'tags/'+id
            // OPEN MODAL
            $('#deleteModal').modal('show');
        }
        
    </script>
@endsection