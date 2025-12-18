@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add Page</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>{{ ucfirst($page->status) }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.pages.destroy', $page->id) }}"
                          method="POST"
                          class="d-inline-block"
                          onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No pages found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
