@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                img
            </div>
            <div class="col-md-8">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->sku }}</p>
                @if($product->specialPrice)
                    <h4 class="text-success">{{ $product->specialPrice }}</h4>
                    <p><strike>{{ $product->basePrice }}</strike></p>
                @else
                    <h4>{{ $product->basePrice }}</h4>
                @endif
                <p>{{ $product->description }}</p>
                @auth
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
