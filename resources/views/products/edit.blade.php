@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h2>Edit product</h2>
            <form action="{{ route('products.update', $product->id) }}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-row">
                    <div class="form-group col-lg-5">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name') ? old('name') : $product->name }}"
                               required>
                    </div>
                    <div class="form-group col-lg-1">
                        <label for="pages">SKU:</label>
                        <input type="text" class="form-control" id="sku" name="sku"
                               value="{{ old('sku') ? old('sku') : $product->sku }}"
                               required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="status">State</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="basePrice">Price (€):</label>
                        <input type="text" class="form-control" id="basePrice" name="basePrice"
                               value="{{ old('basePrice') ? old('basePrice') : $product->basePrice }}">
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="specialPrice">Special discount (%):</label>
                        <input type="text" class="form-control" id="specialPrice" name="specialPrice"
                               value="{{ old('specialPrice') ? old('specialPrice') : $product->specialPrice }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Replace Image:</label>
                    <img class="media-object ml-3"
                         src="{{ $product->image ? asset("images/$product->image") : "http://lorempixel.com/100/100/cats/Placeholder" }}"
                         style="width: 100px; height: 100px;"></a>
                    <input type="file" class="form-control-file mt-3" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
                    <script>tinymce.init({selector: 'textarea'});</script>
                    <div class="panel-body">
                    <textarea class="form-control" id="description"
                              name="description">{{ old('description') ? old('description') : $product->description }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        @foreach($errors->all() as $error)
            <p style="background-color: red; width: fit-content; color: yellow;">{{$error}}</p>
        @endforeach

    </div>
@endsection
