@php
    $Categories = \App\Http\Controllers\CategoryController::getCategories();
@endphp

<ul class="main-menu">

    <li class="active">
        <a href="{{route('all_products')}}">Alle producten</a>
    </li>

    @foreach($Categories as $category)
        <li>
            <a href="{{route('category', $category->id)}}">{{ $category->name }}</a>
        </li>
    @endforeach

    @if(Auth::user() && Auth::user()->role === 'admin')
        <li class="divider">
            <i class="fas fa-cog"></i>
            Admin
        </li>

        <li>
            <a href="{{route('admin_products')}}">Products</a>
        </li>

        <li>
            <a href="{{route('admin_orders')}}">Orders</a>
        </li>

        <li>
            <a href="{{route('admin_users')}}">Users</a>
        </li>
    @endif

</ul>
