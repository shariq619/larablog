@extends('layouts.admin')

@section('content')
    <h3>Edit Page</h3>

    <form method="POST" action="{{ route('admin.pages.update', $page) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $page->title }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="draft" @selected($page->status=='draft')>Draft</option>
                <option value="published" @selected($page->status=='published')>Published</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control editor">{{ $page->content }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
