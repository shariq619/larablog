@extends('frontend.layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="container py-5">

        <h1 class="mb-4">Blog</h1>

        {{-- Loop posts --}}
        <div class="row g-4">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">

                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif

                        <div class="card-body">
                            <small class="text-muted">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </small>

                            <h5 class="card-title mt-2">
                                {{ $post->title }}
                            </h5>

                            <p class="card-text text-muted">
                                {!! Str::limit(strip_tags($post->content), 120) !!}
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No posts found.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>
@endsection
