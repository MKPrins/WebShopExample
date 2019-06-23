@php
    $Categories = \App\Http\Controllers\CategoryController::getCategories();
@endphp

<ul class="main-menu">

    <li class="active">
        <a href="/All">Alle producten</a>
    </li>

    @foreach($Categories as $category)
        <li>
            <a href="/Category/{{$category->id}}">{{ $category->name }}</a>
        </li>
    @endforeach

    @if(Auth::user() && Auth::user()->role === 'admin')
        <li class="divider">
            <i class="fas fa-cog"></i>
            Admin
        </li>

        <li>
            <a href="/Admin/Products">Products</a>
        </li>

        <li>
            <a href="/Admin/Orders">Orders</a>
        </li>

        <li>
            <a href="/Admin/Users">Users</a>
        </li>
    @endif

</ul>
