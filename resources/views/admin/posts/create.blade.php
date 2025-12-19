@extends('admin.layouts.app')

@section('title', 'Add Post')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add New Post</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Post Information</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title"
                                               value="{{ old('title') }}"
                                               placeholder="Enter post title" required>
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('content') is-invalid @enderror"
                                                  id="content" name="content"
                                                  placeholder="Write your post content here" >{{ old('content') }}</textarea>
                                        @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="excerpt" class="form-label">Excerpt</label>
                                        <textarea class="form-control" id="excerpt" name="excerpt"
                                                  rows="3" placeholder="Brief summary of the post">{{ old('excerpt') }}</textarea>
                                        <div class="form-text">A short summary that will appear in post listings.</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Post Settings</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                                <select class="form-select @error('category_id') is-invalid @enderror"
                                                        id="category_id" name="category_id" required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                                <select class="form-select @error('status') is-invalid @enderror"
                                                        id="status" name="status" required>
                                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="featured_image" class="form-label">Featured Image</label>
                                                <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                                       id="featured_image" name="featured_image"
                                                       accept="image/*">
                                                @error('featured_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Max size: 2MB. Supported formats: JPG, PNG, GIF, WebP</div>
                                            </div>

{{--                                            <div class="mb-3">--}}
{{--                                                <label for="gallery_images" class="form-label">Gallery Images</label>--}}
{{--                                                <input type="file" class="form-control @error('gallery_images.*') is-invalid @enderror"--}}
{{--                                                       id="gallery_images" name="gallery_images[]"--}}
{{--                                                       multiple accept="image/*">--}}
{{--                                                @error('gallery_images.*')--}}
{{--                                                <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                                @enderror--}}
{{--                                                <div class="form-text">You can select multiple images for the gallery.</div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line align-bottom me-1"></i> Create Post
                                </button>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-light">
                                    <i class="ri-arrow-left-line align-bottom me-1"></i> Back to List
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.querySelector('#content'), {

            // Set initial height
            height: '60px',

            // Enable auto-grow
            autogrow: {
                minHeight: 400,
                maxHeight: 1200
            },


            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'link',
                    'bulletedList', 'numberedList', '|',
                    'uploadImage', 'insertTable', '|', 'undo', 'redo'
                ]
            },

            simpleUpload: {
                uploadUrl: "{{ route('admin.posts.ckeditor.upload') }}",
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
            },

            removePlugins: [
                // Premium plugins requiring license
                'PasteFromOfficeEnhanced',

                // Other plugins to remove
                'DocumentOutline',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'ChemType',
                'SlashCommand',
                'Template',
                'FormatPainter',
                'TableOfContents',
                'ExportPdf',
                'ExportWord'
            ]
        })
            .then(editor => {
                window.editor = editor;

                // Update textarea before form submission for validation
                document.querySelector('form').addEventListener('submit', function(e) {
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(console.error);
    </script>
@endpush
@push('admin_css')
    <style>
        .ck.ck-editor {
            min-height: 120px;
        }

        .ck-editor__editable_inline {
            min-height: 120px;
        }
    </style>
@endpush
