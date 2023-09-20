<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">Dashboard</div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 @yield('dashboard')" href="{{route('dashboard.index')}}">Dashboard</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 @yield('categories')" href="{{route('dashboard.categories.index')}}">categories</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 @yield('posts')" href="{{route('dashboard.posts.index')}}">Posts</a>
    </div>
</div>
