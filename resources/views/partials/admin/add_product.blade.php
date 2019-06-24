@extends('layouts.default-container')

@push('scripts')
    <script src="{{ asset('js/ImagePreviewer.js') }}"></script>
@endpush

@php
    $Categories = \App\Http\Controllers\CategoryController::getCategories();
@endphp

@section('content')

    <div class="product-add-form">

        <form id="product-form" method="POST" action="{{route('product_add_post')}}" enctype="multipart/form-data" >
            @csrf

            <div class="product-img">
                <img src="{{env('APP_URL')}}/storage/images/{{ $Product->image->name ?? 'default-product.png' }}" class="product-image-preview"/>
                <input name="image" type="file" class="product-image-input"/>
            </div>

            <table>
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input name="title" value="{{ $Product->title ?? '' }}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                @foreach($Categories as $category)
                                    <option value="{{$category->id}}" {{isset($Product) && $Product->category_id === $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            $ <input name="price" value="{{ $Product->price ?? '' }}" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Description</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="description">{{ $Product->description ?? '' }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if(isset($Product))
                <input type="hidden" name="id" value="{{ $Product->id }}">
            @endif
            <button type="submit">Submit</button>

        </form>

    </div>

@endsection
