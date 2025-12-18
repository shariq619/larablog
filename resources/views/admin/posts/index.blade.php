@extends('admin.layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name ?? '-' }}</td>
                <td>{{ ucfirst($post->status) }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
