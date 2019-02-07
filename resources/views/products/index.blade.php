@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table thead-dark">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">SKU</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Special Price</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->sku}}</td>
                    <td>{{$product->status}}</td>
                    <td>{{$product->basePrice}}</td>
                    <td>{{$product->specialPrice}}</td>
                    <td>{{$product->image}}</td>
                    <td>{{$product->description}}</td>
                </tr>
            @endforeach


        </table>
    </div>
@endsection
