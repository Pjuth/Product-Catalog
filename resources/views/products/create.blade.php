@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h2>Create product</h2>
            <form action="{{ route('products.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="pages">SKU:</label>
                    <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}" required>
                </div>
                {{--todo: status in create form--}}
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="checkbox" class="form-control" id="status" name="status" value="1"
                           required>
                </div>
                <div class="form-group">
                    <label for="basePrice">Base price:</label>
                    <input type="number" class="form-control" id="basePrice" name="basePrice"
                           value="{{ old('basePrice') }}" required>
                </div>
                <div class="form-group">
                    <label for="specialPrice">Special price:</label>
                    <input type="number" class="form-control" id="specialPrice" name="specialPrice"
                           value="{{ old('specialPrice') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
                    <script>tinymce.init({selector: 'textarea'});</script>
                    <div class="panel-body">
                    <textarea class="form-control" id="description"
                              name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Siųsti</button>
            </form>
        </div>
        @foreach($errors->all() as $error)
            <p style="background-color: red; width: fit-content; color: yellow;">{{$error}}</p>
        @endforeach
    </div>
@endsection
