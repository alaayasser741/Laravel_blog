@extends('dashboard.layouts.master')
@section('title', 'Posts')
@section('posts', 'active')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Posts</h1>
        <p>Posts</p>
        <button class="btn btn-primary text end" onclick="window.location.href='{{route('dashboard.posts.create')}}'">Add New Post</button>
    </div>
@endsection
