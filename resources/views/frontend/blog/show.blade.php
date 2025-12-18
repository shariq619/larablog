@extends('frontend.layouts.app')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description)

@section('content')
    <div class="container py-5">

        <div class="row">
            <div class="col-lg-8 mx-auto">

                <h1 class="mb-3">{{ $post->title }}</h1>

                <div class="mb-3 text-muted">
                <span>
                    Category: {{ $post->category->name ?? 'Uncategorized' }}
                </span>
                    •
                    <span>
                    {{ $post->created_at->format('d M Y') }}
                </span>
                </div>

                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                         class="img-fluid rounded mb-4"
                         alt="{{ $post->title }}">
                @endif

                <div class="content">
                    {!! $post->content !!}
                </div>

                <hr class="my-5">

                <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
                    ← Back to Blog
                </a>

            </div>
        </div>

    </div>
@endsection
