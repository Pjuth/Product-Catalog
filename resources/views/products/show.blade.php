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
                    <h4 class="text-success">{{ $product->specialPrice }} €</h4>
                    <p><strike>{{ $product->basePrice }} €</strike></p>
                @else
                    <h4>{{ $product->basePrice }} €</h4>
                @endif
                @auth
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                @endauth
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <p>{!! $product->description !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5 mb-4"><h3>Submit Review</h3></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form id="review-form">
                    <div class="form-row">
                        <div class="form-group col-lg-10">
                            <input type="text" id="name" class="form-control"
                                   placeholder="Enter Name">
                        </div>
                        <div class="form-group col-lg-2">
                            <select id="rating" name="rating" class="form-control">
                                <option disabled selected>Rating</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                        <textarea id="message" rows="5" placeholder="Enter Comment"
                                  class="form-control"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="ajaxSubmit">Submit</button>
                </form>
                <div id="comment-message"></div>
                <div id="display-comment"></div>
            </div>
            <div class="alert alert-danger mt-2" style="display:none"></div>
        </div>
        <div class="reviews">
            @include('products.reviews')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function () {

            jQuery('#ajaxSubmit').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('postReview', $product) }}",
                    method: 'POST',
                    data: {
                        name: $('#name').val(),
                        rating: $('#rating').val(),
                        message: $('#message').val(),
                    },
                    success: function(data){
                        jQuery('.alert-danger').empty();
                        jQuery.each(data.errors, function(key, value){
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
                        if (!data.errors){
                            jQuery('.alert-danger').hide();
                            document.getElementById('review-form').reset();
                            loadReviews();
                        }
                    }
                });
            });
        });

        function loadReviews() {
            $('div.reviews').fadeOut();
            jQuery.ajax({
                url: "{{ route('updateReviews', $product) }}",
                method: 'GET',
                success: function (response) {
                    $('div.reviews').html(response).fadeIn();
                }
            });
        }

        function deleteReview(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/review/destroy/" + id,
                method: 'DELETE',
            });
            loadReviews();
        }
    </script>
@endsection
