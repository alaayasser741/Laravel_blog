@extends('layouts.master')
@section('title', 'Create Post')
@section('content')
    <form class="p-4" style="min-height: 80vh" action="{{ route('posts.store') }}" method="POST"
        enctype="multipart/form-data">
        <h2 class="text-bold">Add New Post</h2>
        @csrf
        <div class="form-group mb-4">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="content">Content</label>
            <textarea type="text" name="content" class="form-control" id="content">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        @foreach ($categories as $category)
            <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="{{ $category->id }}" {{in_array($category->id,old('categories') ?? []) ? 'checked' : ''}}>
            <label for="{{$category->id}}">{{$category->name}}</label>
            <br>
        @endforeach
        <div class="form-group mb-4">
            <label for="image">image</label>
            <input type="file" name="image" class="form-control" id="image" />
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Create">
        </div>
    </form>
@endsection
