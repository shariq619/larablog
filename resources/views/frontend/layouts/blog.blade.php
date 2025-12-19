<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>@yield('title', 'My CMS')</title>
    <meta name="description" content="@yield('meta_description', 'Laravel CMS Website')">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>

    @if(isset($post) && $url = $post->getFirstMediaUrl('featured_images', 'optimized'))
        <link rel="preload" as="image" href="{{ $url }}" fetchpriority="high">
    @endif

    @stack('styles')
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">MyCMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                @if(isset($menuPages) && $menuPages->count())
                    @foreach($menuPages as $page)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url($page->slug) }}">{{ $page->title }}</a>
                        </li>
                    @endforeach
                @endif
                <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
            </ul>

            <ul class="navbar-nav">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @if(Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

@php
    $heroImage = $post->getFirstMediaUrl('featured_images', 'optimized')
                 ?: asset('assets/img/home-bg.jpg');
    $webpImage = $post->getFirstMediaUrl('featured_images', 'webp');
@endphp

    <!-- Optimized Hero Section with Background Effect -->
<header class="masthead position-relative" style="min-height: 400px; height: 60vh; max-height: 600px; overflow: hidden; background-color: #f8f9fa;">
    <!-- Background Image Container -->
    <div class="position-absolute w-100 h-100" style="top:0; left:0; z-index: 0;">
        <picture>
            <!-- WebP for better performance -->
            @if($webpImage)
                <source srcset="{{ $webpImage }}" type="image/webp">
            @endif
            <img
                src="{{ $heroImage }}"
                alt="{{ $post->title }}"
                loading="eager"
                fetchpriority="high"
                width="1920"
                height="1080"
                style="width:100%; height:100%; object-fit:cover; display:block;"
            >
        </picture>
        <!-- Optional overlay for better text readability -->
        <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.3); top:0; left:0; z-index: 1;"></div>
    </div>

    <!-- Content Container -->
    <div class="container position-relative px-4 px-lg-5 h-100" style="z-index: 2;">
        <div class="row gx-4 gx-lg-5 justify-content-center align-items-center h-100">
            <div class="col-md-10 col-lg-8 col-xl-7 text-center text-white">
                <h1 class="display-5 fw-bold mb-3">{{ $post->title }}</h1>
                @if($post->excerpt)
                    <h2 class="subheading fs-4 fw-normal mb-4">{{ $post->excerpt }}</h2>
                @endif
                <span class="meta fs-5">{{ $post->created_at->format('F d, Y') }}</span>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer class="border-top mt-5">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 text-center">
                <ul class="list-inline mb-3">
                    <li class="list-inline-item"><a href="#!"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#!"><i class="fab fa-github"></i></a></li>
                </ul>
                <div class="small text-muted fst-italic">Copyright &copy; Your Website {{ date('Y') }}</div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="{{ asset('js/scripts.js') }}" defer></script>

@stack('scripts')
</body>
</html>
