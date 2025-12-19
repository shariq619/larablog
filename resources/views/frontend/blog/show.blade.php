@extends('frontend.layouts.blog')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description)

@section('content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">

                <aside class="col-lg-3 d-none d-lg-block">
                    <div class="position-sticky" style="top: 90px;">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2">Quick goto</h6>
                                <ul id="toc" class="list-unstyled small mb-0"></ul>
                            </div>
                        </div>
                    </div>
                </aside>


                <div class="col-lg-9">

                    <h2>{{ $post->title }}</h2>

                    <div id="post-content" class="post-content">
                        {!! $post->content !!}
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

@push('scripts')
    <script>
        (function () {
            const content = document.getElementById('post-content');
            const toc = document.getElementById('toc');
            if (!content || !toc) return;

            const headings = content.querySelectorAll('h2, h3');
            if (!headings.length) return;

            const slugify = (str) => str.toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            const used = new Set();

            headings.forEach(h => {
                let id = h.id || slugify(h.textContent || '');
                if (!id) return;

                // ensure unique id
                let unique = id, i = 2;
                while (used.has(unique) || document.getElementById(unique)) {
                    unique = `${id}-${i++}`;
                }
                used.add(unique);
                h.id = unique;

                const li = document.createElement('li');
                li.className = h.tagName === 'H3' ? 'ms-3' : '';

                const a = document.createElement('a');
                a.href = `#${unique}`;
                a.textContent = h.textContent;
                a.className = 'toc-link d-block py-1 text-decoration-none';

                li.appendChild(a);
                toc.appendChild(li);
            });

            // active link on scroll
            const links = toc.querySelectorAll('a');
            const observer = new IntersectionObserver((entries) => {
                const visible = entries.filter(e => e.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
                if (!visible) return;

                links.forEach(l => l.classList.remove('active'));
                const active = toc.querySelector(`a[href="#${visible.target.id}"]`);
                if (active) active.classList.add('active');
            }, {rootMargin: "0px 0px -70% 0px", threshold: [0.1, 0.2, 0.5]});

            headings.forEach(h => observer.observe(h));
        })();
    </script>
@endpush

@push('styles')
    <style>
        .toc-link.active {
            font-weight: 600;
        }
    </style>
@endpush

