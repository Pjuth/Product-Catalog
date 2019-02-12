@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h2>Configuration</h2>
            <form action="{{ route('saveConfiguration') }}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        <label for="tax_rate">Tax rate (%):</label>
                        <input type="text" class="form-control" id="tax_rate" name="tax_rate"
                               value="{{ old('tax_rate') ? old('tax_rate') : $configuration->tax_rate }}">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="global_discount">Global discount (%):</label>
                        <input type="text" class="form-control" id="global_discount" name="global_discount"
                               value="{{ old('global_discount') ? old('global_discount') : $configuration->global_discount }}">
                    </div>
                </div>
                <label class="form-group col-lg-2 checkbox-wrapper">Include tax
                    <input id="tax_inclusion" type="checkbox" name="tax_inclusion"
                           value="1" {{ $configuration->tax_inclusion ? 'checked' : '' }}>
                    <span class="checkmark conf-check"></span>
                </label>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        @foreach($errors->all() as $error)
            <p style="background-color: red; width: fit-content; color: yellow;">{{$error}}</p>
        @endforeach
    </div>
@endsection
