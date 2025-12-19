@extends('admin.layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h2>{{ $post->title }}</h2>
            <p><strong>Category:</strong> {{ $post->category->name ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($post->status) }}</p>

            <div>{!! $post->content !!}</div>

            <div>
            @php($url = $post->getFirstMediaUrl('featured_images', 'thumb') ?: $post->getFirstMediaUrl('featured_images'))
            @if($url)
                <img src="{{ $url }}" class="img-fluid mb-3" alt="{{ $post->title }}">
            @endif
            </div>

            <hr>


            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
        </div>
    </div>
@endsection
