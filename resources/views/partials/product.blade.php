<li class="product">

    <div class="product-thumbnail">
        <img src="{{env('APP_URL')}}/storage/images/{{ isset($product->image->name) ? 'thumb-'.$product->image->name : 'default-product.png' }}" alt="thumb" />
    </div>

    <div class="product-details">
        <a href="{{ route('product', $product->id) }}">
            <strong class="product-title">
                {{ $product->title }}
            </strong>
        </a>
        <br />
        <span>In {{ $product->category->name }}</span>

        <p class="product-info">
            {{ $product->description }}
        </p>
    </div>

    <div class="product-pricing">
        <div class="product-price">
            ${{ $product->price }}
        </div>

        <div class="product-add">
            <button data-product-id="{{ $product->id }}">
                <i class="fas fa-plus"></i>
                Add to shopping cart
            </button>
        </div>
    </div>

</li>
