@extends('frontend.layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">

                <h1 class="mb-4">{{ $page->title }}</h1>

                {{-- Page Content --}}
                <div class="content mb-5">
                    {!! $page->content !!}
                </div>

                {{-- Contact Form ONLY for contact page --}}
                @if($page->slug === 'contact')

                    <hr>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Send Message
                        </button>
                    </form>

                @endif

            </div>
        </div>
    </div>
@endsection
