<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Reviews</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="list-group">
            @foreach($reviews as $review)
                <div class="list-group-item mb-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="list-group-item-heading text-md-left text-center">{{ $review->name }}</h4>
                            <p class="list-group-item-text">{{ $review->message }}</p>
                        </div>
                        <div class="col-md-1 text-md-right text-center display-4">{{ $review->rating }}</div>
                    </div>
                    @auth
                        <div class="row float-right">
                            <button class="btn btn-outline-danger" onclick="deleteReview({{$review->id}})" id="ajaxDelete">Delete</button>
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
</div>