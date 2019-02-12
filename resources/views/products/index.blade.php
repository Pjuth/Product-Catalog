@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <form action="{{ route('multipleDelete') }}" method="post">
                @csrf
                {{ method_field('POST') }}
                @endauth
                <table class="table thead-dark">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        @auth
                            <th scope="col">Actions</th>
                            <th scope="col">
                                <button type="submit" class="btn btn-outline-danger">Delete multiple</button>
                            </th>
                        @endauth
                    </tr>
                    </thead>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="media">
                                    <a href="{{ route('products.show', $product) }}" class="thumbnail pull-left">
                                        <img class="media-object"
                                             src="{{ $product->image ? asset("images/$product->image") : "http://lorempixel.com/100/100/cats/Placeholder" }}"
                                             style="width: 100px; height: 100px;"></a>
                                    <div class="media-body ml-4">
                                        <h4 class="media-heading"><a
                                                    href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                            @if(Auth::user() && !$product->status)
                                                <span class="text-danger">Hidden</span>
                                            @endif
                                        </h4>
                                        <p>SKU: {{ $product->sku }}</p>
                                        <p>{{ str_limit(strip_tags(preg_replace("/\s|&nbsp;/",' ',$product->description)), $limit = 100, $end = '...') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->specialPrice)
                                    <h4 class="text-success">{{ $product->specialPrice }} €</h4>
                                    <p><strike>{{ $product->basePrice }} €</strike></p>
                                @else
                                    <h4>{{ $product->basePrice }} €</h4>
                                @endif
                            </td>
                            @auth
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="products[]" value="{{ $product->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </table>
                @auth
            </form>
        @endauth
        <div>{{ $products->links() }}</div>
    </div>
@endsection
