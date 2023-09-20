@extends('layouts.master')
@section('title', 'HomePage')
@section('content')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">@lang('translate.Welcome')!</h1>
                <p class="lead mb-2">@lang('translate.Show')</p>
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
                    @foreach ($posts as $post)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}"
                                        alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $post->created_at->diffforhumans() }}</div>
                                    {{-- <div class="small text-muted">{{$post->created_at->format('d M Y')}}</div> --}}
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">{{ substr($post->content, 20) }}..</p>
                                    @if (count($post->categories) > 0)
                                        <div>
                                            @foreach ($post->categories as $category)
                                                <span
                                                    class="badge bg-secondary text-white mb-2 text-capitalize">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <small class="d-block my-2 text-secondary">Created by : {{ $post->user->name }}</small>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
                <!-- Pagination-->
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <form action="{{ route('home') }}" method="GET">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Enter search term..." aria-label="Enter search term..."
                                    aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div style="width: 80%;">
                            <ul class="list-unstyled mb-0" style="column-count: 3;">
                                @foreach ($categories as $category)
                                    <li><a href="#!">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
