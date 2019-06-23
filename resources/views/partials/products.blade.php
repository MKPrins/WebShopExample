@extends('layouts.default-container')

@push('scripts')
    <script src="{{ asset('js/ShoppingCart.js') }}"></script>
@endpush

@section('content')

    <div class="products-overview">

        <ul class="products-list">
            @if(count($Products))
                @each('partials.product', $Products, 'product')
            @else
                <h3>No products have been found</h3>
            @endif
        </ul>

    </div>

@endsection
