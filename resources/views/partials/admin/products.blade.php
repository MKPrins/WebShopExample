@extends('layouts.default-container')

@section('content')

    <div class="admin-data-overview">

        <a href="/Admin/ProductAdd">
            <button>
                <i class="fas fa-plus"></i>
               <span>
                   Add a new Product
               </span>
            </button>
        </a>

        <table>
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            @foreach($Products as $product)

                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="/storage/images/{{ $product->image->name ?? 'default+product.png' }}" alt="thumb" />
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ substr($product->description, 0, 100) . "..." }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>
                        <a href="/Admin/ProductEdit/{{ $product->id }}" >
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="/Admin/ProductDel/{{ $product->id }}" >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

@endsection
