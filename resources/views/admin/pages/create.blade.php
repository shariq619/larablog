@extends('admin.layouts.app')

@section('title', 'Add Page')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h2>Add New Page</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pages.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content"
                              class="form-control"
                              rows="6">{{ old('content') }}</textarea>
                </div>

                <hr>
                <h5 class="mt-4">SEO Settings</h5>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text"
                           name="meta_title"
                           class="form-control"
                           value="{{ old('meta_title') }}"
                           maxlength="255">
                    <small class="text-muted">Recommended: 50–60 characters</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description"
                              class="form-control"
                              rows="3"
                              maxlength="255">{{ old('meta_description') }}</textarea>
                    <small class="text-muted">Recommended: 150–160 characters</small>
                </div>

                <hr>
                <h5 class="mt-4">Menu Settings</h5>

                <div class="form-check mb-3">
                    <input class="form-check-input"
                           type="checkbox"
                           name="show_in_menu"
                           id="show_in_menu"
                        {{ old('show_in_menu') ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_in_menu">
                        Show in Navigation Menu
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Menu Order</label>
                    <input type="number"
                           name="menu_order"
                           class="form-control"
                           value="{{ old('menu_order', 0) }}"
                           min="0">
                    <small class="text-muted">Lower number appears first</small>
                </div>



                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="draft" {{ old('status')=='draft'?'selected':'' }}>Draft</option>
                        <option value="published" {{ old('status')=='published'?'selected':'' }}>Published</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Back</a>
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
            .then(newEditor => editor = newEditor)
            .catch(error => console.error(error));

        document.querySelector('form').addEventListener('submit', function(e) {
            if (!editor.getData().trim()) {
                e.preventDefault();
                alert('Content is required.');
                editor.editing.view.focus();
            }
        });
    </script>
@endpush
