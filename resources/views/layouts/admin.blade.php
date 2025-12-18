<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Breeze requires Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<!-- TOP NAV (BREEZE STYLE) -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            CMS Admin
        </a>

        <div class="ms-auto d-flex align-items-center">

            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>

<!-- LAYOUT -->
<div class="d-flex">

    <!-- SIDEBAR -->
    <aside class="bg-dark text-white p-3" style="width:260px; min-height:100vh;">
        <ul class="nav flex-column gap-1">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-secondary' : '' }}">
                    Dashboard
                </a>
            </li>

            <li class="nav-item mt-2 text-uppercase small text-muted">
                Content
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pages.index') }}"
                   class="nav-link text-white {{ request()->is('admin/pages*') ? 'active bg-secondary' : '' }}">
                    Pages
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}"
                   class="nav-link text-white {{ request()->is('admin/posts*') ? 'active bg-secondary' : '' }}">
                    Blog Posts
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                   class="nav-link text-white {{ request()->is('admin/categories*') ? 'active bg-secondary' : '' }}">
                    Categories
                </a>
            </li>

            <li class="nav-item mt-3 text-uppercase small text-muted">
                Frontend
            </li>

            <li class="nav-item">
                <a href="{{ url('/') }}" target="_blank" class="nav-link text-white">
                    View Website
                </a>
            </li>

        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-fill p-4">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '.editor',
        height: 350,
        menubar: false,
        plugins: 'link lists image code',
        toolbar: 'undo redo | bold italic | bullist numlist | link | code'
    });
</script>

</body>
</html>
