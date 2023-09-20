@extends('dashboard.layouts.master')
@section('title', 'Categories')
@section('categories', 'active')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Categories</h1>
        <p>Categories</p>
        <button class="btn btn-primary text end"
            onclick="window.location.href='{{ route('dashboard.categories.create') }}'">Create New Category</button>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @if (count($categories))
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $category->name }}</td>
                            <td><a class="bg-success py-1 px-3 rounded-4 text-decoration-none text-white"
                                    href="{{ route('dashboard.categories.edit', $category->id) }}">Edit
                                    <svg width="20" height="20" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415zM16 5l3 3" />
                                        </g>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                {{-- <a class="bg-danger py-1 px-3 rounded-4 text-decoration-none text-white "
                                href="{{ route('dashboard.categories.destroy', $category->id) }}">Delete
                                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#ffffff"
                                        d="M8.5 4h3a1.5 1.5 0 0 0-3 0Zm-1 0a2.5 2.5 0 0 1 5 0h5a.5.5 0 0 1 0 1h-1.054l-1.194 10.344A3 3 0 0 1 12.272 18H7.728a3 3 0 0 1-2.98-2.656L3.554 5H2.5a.5.5 0 0 1 0-1h5ZM9 8a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V8Zm2.5-.5a.5.5 0 0 0-.5.5v6a.5.5 0 0 0 1 0V8a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                            </a> --}}
                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-danger border-0 py-1 px-3 rounded-4 text-decoration-none text-white "
                                        type="submit">
                                        Delete
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="#ffffff"
                                                d="M8.5 4h3a1.5 1.5 0 0 0-3 0Zm-1 0a2.5 2.5 0 0 1 5 0h5a.5.5 0 0 1 0 1h-1.054l-1.194 10.344A3 3 0 0 1 12.272 18H7.728a3 3 0 0 1-2.98-2.656L3.554 5H2.5a.5.5 0 0 1 0-1h5ZM9 8a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V8Zm2.5-.5a.5.5 0 0 0-.5.5v6a.5.5 0 0 0 1 0V8a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">There is no Category</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
