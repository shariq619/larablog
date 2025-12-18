@extends('admin.layouts.app')

@section('title', 'Add Post')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h2>Add New Post</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':'' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="6">{{ old('content') }}</textarea>
                </div>


                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="draft" {{ old('status')=='draft'?'selected':'' }}>Draft</option>
                        <option value="published" {{ old('status')=='published'?'selected':'' }}>Published</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection

@push('admin_js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('textarea[name="content"]'))
            .then(newEditor => { editor = newEditor; })
            .catch(error => { console.error(error); });

        document.querySelector('form').addEventListener('submit', function(e) {
            if (!editor.getData().trim()) {
                e.preventDefault();
                alert('Content is required.');
                editor.editing.view.focus();
            }
        });
    </script>
@endpush




