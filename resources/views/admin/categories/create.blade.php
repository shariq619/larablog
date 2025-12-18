@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h2>Add New Category</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
