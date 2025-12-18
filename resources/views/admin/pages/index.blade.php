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
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td>{{ $page->category->name ?? '-' }}</td>
                <td>{{ ucfirst($page->status) }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('admin.pages.show', $page->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
