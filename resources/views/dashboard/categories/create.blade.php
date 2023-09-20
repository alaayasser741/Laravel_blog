@extends('dashboard.layouts.master')
@section('title', 'Create Categories')
@section('categories', 'active')
@section('content')
    <form class="p-4" action="{{ route('dashboard.categories.store') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <h2>Create New Categories</h2>
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" value="{{ old('name') }}">
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
            <input type="submit" class="btn btn-primary" value="Create">
        </div>
    </form>
@endsection
