@extends('layouts.default-container')

@section('content')

    <div class="product-info">

        <div class="product-image">
            <img src='/storage/images/{{ $Product->image->name ?? 'default+product.png' }}' alt="image"/>
        </div>

        <div class="product-details">

            <h1>{{ $Product->title }}</h1>

            <p>
                {{ $Product->description }}
            </p>

        </div>

        <div class="product-pricing">
            <div class="product-price">
                ${{ $Product->price }}
            </div>

            <div class="product-add">
                <button data-product-id="{{ $Product->id }}">
                    <i class="fas fa-plus"></i>
                    Add to shopping cart
                </button>
            </div>
        </div>

    </div>

@endsection