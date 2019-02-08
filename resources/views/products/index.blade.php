@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table thead-dark">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                @auth
                    <th scope="col">Actions</th>
                @endauth
            </tr>
            </thead>
            @foreach($products as $product)
                <tr>
                    <td>
                        <div class="media">
                            <a href="{{ route('products.show', $product) }}" class="thumbnail pull-left"><img class="media-object"
                                                                         src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png"
                                                                         style="width: 72px; height: 72px;"></a>
                            <div class="media-body ml-4">
                                <h4 class="media-heading"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    @if(Auth::user() && !$product->status)
                                        <span class="text-danger">Hidden</span>
                                    @endif
                                </h4>
                                <p>SKU: {{ $product->sku }}</p>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($product->specialPrice)
                            <h4 class="text-success">{{ $product->specialPrice }}</h4>
                            <p><strike>{{ $product->basePrice }}</strike></p>
                        @else
                            <h4>{{ $product->basePrice }}</h4>
                        @endif
                    </td>
                    @auth
                        <td>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>
        <div>{{ $products->links() }}</div>
    </div>
@endsection
