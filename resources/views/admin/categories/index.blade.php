@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    <table class="table table-bordered">
        <tr><th>Name</th><th>Actions</th></tr>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit',$category) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy',$category) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
