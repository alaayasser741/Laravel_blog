@extends('dashboard.layouts.master')
@section('title', 'Edit Categories')
@section('categories', 'active')
@section('content')
    <form class="p-4" action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-4">
            <h2>Edit {{ $category->name }} Category</h2>
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" value="{{ $category->name }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        {{-- <div class="form-group mb-4">
            <label for="formGroupExampleInput2">Content</label>
            <textarea type="text" name="content" class="form-control" id="formGroupExampleInput2"></textarea>
            @error('content')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div> --}}
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update">
        </div>
    </form>
@endsection
