@extends('frontend.layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @forelse ($posts as $post)
            <!-- Post preview-->
            <div class="post-preview">
                <a href="{{ route('blog.show', $post->slug) }}">
                    <h2 class="post-title">  {{ $post->title }}</h2>
                    <h3 class="post-subtitle"> {!! Str::limit(strip_tags($post->content), 120) !!}</h3>
                </a>
                <p class="post-meta">
{{--                    <a href="{{ route('blog.show', $post->slug) }}">Start Bootstrap</a>--}}
                     {{ $post->created_at->format('F d, Y') }}
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
            @empty
                <p class="text-muted">No posts found.</p>
            @endforelse

        </div>
    </div>

    <div class="d-flex justify-content-between mb-4">
        @if ($posts->onFirstPage())
            <span></span>
        @else
            <a class="btn btn-outline-primary text-uppercase"
               href="{{ $posts->previousPageUrl() }}">
                ← Newer Posts
            </a>
        @endif

        @if ($posts->hasMorePages())
            <a class="btn btn-primary text-uppercase"
               href="{{ $posts->nextPageUrl() }}">
                Older Posts →
            </a>
        @endif
    </div>

@endsection
