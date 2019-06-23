@extends('layouts.default-container')

@section('content')

    <div class="admin-data-overview">

        <table>
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>User</th>
                    <th>Address</th>
                    <th>Products</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>

            @foreach($Orders as $order)
                @php
                    $products = json_decode($order->products);
                @endphp

                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->address}}</td>
                    <td>
                        <ul>
                            @foreach($products as $product)
                                <li>{{$product->amount}}x - {{$product->title}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>${{$order->price}}</td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

@endsection