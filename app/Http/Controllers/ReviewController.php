<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * ProductController constructor.
     */
    function __construct()
    {
        $this->middleware('auth', ['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name'    => 'required|max:40',
            'message' => 'required|max:255',
            'rating'  => 'required|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $review = new Review();
        $review->name = $request->name;
        $review->message = $request->message;
        $review->rating = $request->rating;
        $review->product_id = $request->product;
        $review->save();

        return response()->json(['success' => ['Record is successfully added']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review $review
     *
     * @param Product      $product
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Review $review)
    {
        $review->delete();
    }

    public function updateReviews(Product $product)
    {
        return view('products.reviews', [
            'product' => $product,
            'reviews' => $product->review()->orderBy('id', 'desc')->get(),
        ]);
    }
}
