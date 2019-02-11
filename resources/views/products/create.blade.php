@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-wrapper">
                    <h2>Create product</h2>
                    <form action="{{ route('products.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-5">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       required>
                            </div>

                            <div class="form-group col-lg-1">
                                <label for="pages">SKU:</label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}"
                                       required>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="status">State</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="1" selected>Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="basePrice">Base price:</label>
                                <input type="number" class="form-control" id="basePrice" name="basePrice"
                                       value="{{ old('basePrice') }}" required>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="specialPrice">Special price:</label>
                                <input type="number" class="form-control" id="specialPrice" name="specialPrice"
                                       value="{{ old('specialPrice') }}">
                            </div>
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
            </div>
        </div>
        @foreach($errors->all() as $error)
            <p style="background-color: red; width: fit-content; color: yellow;">{{$error}}</p>
        @endforeach
    </div>
@endsection
