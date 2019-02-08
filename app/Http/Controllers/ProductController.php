<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            return view('products/index', [
                'products' => Product::paginate(10),
            ]);
        } else {
            return view('products/index', [
                'products' => Product::where('status', true)->paginate(10),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('products/create', [
            'product' => $product,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'sku'         => 'required',
            'status'      => 'required',
            'basePrice'   => 'required',
            'description' => 'required',

        ]);
        Product::create([
            'name'         => $request->name,
            'sku'          => $request->sku,
            'status'       => $request->status,
            'basePrice'    => $request->basePrice,
            'specialPrice' => $request->specialPrice,
            'description'  => $request->description,
        ]);

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
           'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product             $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'sku'         => 'required',
            'status'      => 'required',
            'basePrice'   => 'required',
            'description' => 'required',

        ]);

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->basePrice = $request->basePrice;
        $product->specialPrice = $request->specialPrice;
        $product->description = $request->description;
        $product->save();
        return redirect('products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
