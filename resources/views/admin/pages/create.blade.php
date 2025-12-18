@extends('layouts.admin')

@section('content')
    <h3>Create Page</h3>

    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control editor"></textarea>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
@endsection
