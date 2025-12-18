@extends('admin.layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h2>Edit Post</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected':'' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <!-- Remove required, CKEditor will handle validation -->
                    <textarea name="content" class="form-control" rows="6">{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="Featured Image" width="150" class="mt-2">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="draft" {{ $post->status=='draft'?'selected':'' }}>Draft</option>
                        <option value="published" {{ $post->status=='published'?'selected':'' }}>Published</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">Update Post</button>
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

        // Optional: Push content back to textarea before submit so Laravel validation works
        document.querySelector('form').addEventListener('submit', function(e) {
            document.querySelector('textarea[name="content"]').value = editor.getData();
        });
    </script>
@endpush
