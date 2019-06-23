<header class="main-header" >

    <div class="header-brand" >
        <span>Webshop Example</span>
    </div>

    <div class="header-left" >
        <form method="POST" action="/Search" enctype="multipart/form-data" >
            @csrf
            <input type="text" name="search_query" placeholder="Search products..." />
            <input type="submit" name="submit" style="display: none">
        </form>
    </div>

    <div class="header-right">

        <div class="header-dropdown" data-dropdown="shopping_cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge">0</span>
            @include('partials.shopping_cart')
        </div>

        @if(Auth::user())
            <a href="/logout" >
                <button>Log out</button>
            </a>
        @else
            <a href="/login" >
                <button>Log in</button>
            </a>
        @endif

    </div>

</header>
