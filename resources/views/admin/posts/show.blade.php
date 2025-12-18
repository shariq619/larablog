@extends('admin.layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h2>{{ $post->title }}</h2>
            <p><strong>Category:</strong> {{ $post->category->name ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($post->status) }}</p>

            <div>{!! $post->content !!}</div>

            @if($post->getFirstMediaUrl('featured_images'))
                <img src="{{ $post->getFirstMediaUrl('featured_images') }}" alt="{{ $post->title }}" class="img-fluid mb-3">
            @endif


            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
        </div>
    </div>
@endsection
