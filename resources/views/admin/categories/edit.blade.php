@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h2>Edit Category</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
