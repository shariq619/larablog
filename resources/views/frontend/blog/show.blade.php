@extends('frontend.layouts.blog')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description)

@section('content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">

                @if($headings->count())
                    <aside class="col-lg-3">
                        <div class="position-sticky" style="top: 90px;">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-0">
                                        @foreach($headings as $h)
                                            <li class="{{ $h['level'] > 2 ? 'ms-3' : '' }}">
                                                <a href="#{{ $h['id'] }}">{{ $h['text'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                @endif


                <div class="col-lg-9">

                    <h2>{{ $post->title }}</h2>

                    <div class="post-content">
                        {!! $content !!}
                    </div>

                    {{-- Gallery images (optional section) --}}
                    @if($post->getMedia('post_images')->count())
                        <hr class="my-4">
                        <div class="row g-2">
                            @foreach($post->getMedia('post_images') as $media)
                                <div class="col-6 col-md-4">
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        <img class="img-fluid rounded"
                                             src="{{ $media->getUrl('thumb') }}"
                                             alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <hr class="my-5">

                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
                        ← Back to Blog
                    </a>

                </div>
            </div>
        </div>
    </article>
@endsection

@push('styles')
    <style>
        .toc-link.active {
            font-weight: 600;
        }
    </style>
@endpush

