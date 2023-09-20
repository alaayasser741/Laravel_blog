@extends('layouts.master')
@section('title', 'Edit Post')
@section('content')
    <form class="p-4" style="min-height: 80vh" action="{{ route('posts.update', $post->id) }}" method="POST"
        enctype="multipart/form-data">
        <h2 class="text-bold">Edit Post</h2>
        @csrf
        @method('PUT')
        <div class="form-group mb-4">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="content">Content</label>
            <textarea type="text" name="content" class="form-control" id="content">{{ $post->content }}</textarea>
            @error('content')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        @foreach ($categories as $category)
            <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="{{ $category->id }}"
                {{ in_array($category->id, $selectedCategories ?? []) ? 'checked' : '' }}>
            <label for="{{ $category->id }}">{{ $category->name }}</label>
            <br>
        @endforeach
        <div class="form-group mb-4 mt-4">
            <img width="170" height="auto" src="{{ asset($post->image_path) }}" alt="img">
            <br>
            <label for="image">image</label>
            <input type="file" name="image" class="form-control" id="image" />
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update">
        </div>
    </form>
@endsection
