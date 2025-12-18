@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

    {{-- HERO --}}
    <section class="bg-light py-5">
        <div class="container text-center">
            <h1 class="display-5 fw-bold">Welcome to My CMS</h1>
            <p class="lead text-muted mt-3">
                A simple Laravel CMS with Pages, Blog & Admin Panel
            </p>

            <a href="#" class="btn btn-primary btn-lg mt-3">View Blog</a>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pages</h5>
                            <p class="card-text text-muted">
                                Create About, Contact, Portfolio pages from admin.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Blog</h5>
                            <p class="card-text text-muted">
                                Categories, featured images & WYSIWYG editor.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Admin Panel</h5>
                            <p class="card-text text-muted">
                                Secure admin panel powered by Laravel Breeze.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LATEST POSTS (STATIC FOR NOW) --}}
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Latest Blog Posts</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://via.placeholder.com/600x350" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Sample Blog Post</h5>
                            <p class="card-text text-muted">
                                This will be dynamic once blog is wired.
                            </p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://via.placeholder.com/600x350" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Another Post</h5>
                            <p class="card-text text-muted">
                                SEO friendly SSR blog pages.
                            </p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://via.placeholder.com/600x350" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">CMS Ready</h5>
                            <p class="card-text text-muted">
                                Controlled fully from admin panel.
                            </p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
