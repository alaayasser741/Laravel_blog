@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Profile!</h1>
                <p class="lead mb-2">Show all world in one page</p>
                @if (auth()->check())
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg">Create New Post</a>
                @endif
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    @if (count($posts))
                        @foreach ($posts as $post)
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4 position-relative">
                                    <a href="#"
                                        onclick="event.preventDefault();
                                    document.getElementById('delete-post-{{ $post->id }}').submit();"
                                        class="btn btn-danger position-absolute top-0 end-0">X</a>
                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}"
                                        id="delete-post-{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    @if (auth()->id() && auth()->id() == $post->user_id)
                                        <a href="{{ route('posts.edit', $post->id) }}"><img class="card-img-top"
                                                src="{{ asset($post->image_path) }}" alt="..." /></a>
                                    @else
                                        <img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." />
                                    @endif

                                    <div class="card-body">
                                        <div class="small text-muted">{{ $post->created_at->diffforhumans() }}</div>
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                        <p class="card-text">{{ substr($post->content, 20) }}..</p>
                                        <small class="d-block my-2 text-secondary">Created by :
                                            {{ $post->user->name }}</small>
                                        <a class="btn btn-primary" href="#!">Read more →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2 class="text-center text-capitalize">There is no posts yet</h2>
                    @endif
                    {{-- {{ $posts->links() }} --}}
                </div>
                <!-- Pagination-->
            </div>
            <!-- Side widgets-->
            {{-- <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
