@extends('layouts.default-container')

@push('scripts')
    <script src="{{ asset('js/ShoppingCart.js') }}"></script>
@endpush

@php
    $User = Auth::user();
@endphp

@section('content')

    <div class="order-form">

        <div class="shopping_cart">

            <h1>Shopping cart</h1>

            <table class="shopping_cart_dropdown">
                <tbody>

                @foreach($ShoppingCart->products as $product)
                    <tr>
                        <td>thumb</td>
                        <td>{{$product->title}}</td>
                        <td><input type="text" value="{{$product->amount}}" class="product-amount" size="2" data-product-id="{{$product->id}}" /></td>
                        <td>${{$product->price}}</td>
                        <td><i class="fas fa-trash product-remove" data-product-id="{{$product->id}}" ></i></td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3">Total</td>
                    <td>${{ $ShoppingCart->totalPrice }}</td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="order-info">
            <table>
                <tbody>
                    <tr>
                        <td colspan="2">Billing details</td>
                    </tr>
                    <tr>
                        <td>Naam:</td>
                        <td>{{ $User->name }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{ $User->email }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">Shipping</td>
                    </tr>
                </tbody>
            </table>

            <p>
                {{ $User->streetname . " " . $User->housenumber }}
                <br />
                {{ $User->zipcode . " " . $User->region }}
            </p>

            <a href="{{route('place_order')}}">
                <button>Checkout</button>
            </a>
        </div>

    </div>

@endsection