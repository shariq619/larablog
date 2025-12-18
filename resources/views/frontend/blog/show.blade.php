@extends('frontend.layouts.blog')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description)

@section('content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

                    {!! $post->content !!}

                    <hr class="my-5">

                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
                        ← Back to Blog
                    </a>

                </div>
            </div>
        </div>
    </article>
@endsection
