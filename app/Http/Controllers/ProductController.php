<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'create', 'store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()) {
            $products = Product::orderBy('id', 'desc')->paginate(10);
        } else {
            $products = Product::where('status', true)->orderBy('id', 'desc')->paginate(10);
        }

        return view('products/index', [
            'products' => $products,
        ]);
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
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'sku'          => 'required',
            'status'       => 'required',
            'basePrice'    => 'required|numeric|max:1000000',
            'specialPrice' => 'numeric|max:99|nullable',
            'image'        => 'mimes:jpeg,jpg,png|max:3000',
            'description'  => 'required',

        ]);

        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = null;
        }
        Product::create([
            'name'         => $request->name,
            'sku'          => $request->sku,
            'status'       => $request->status,
            'basePrice'    => $request->basePrice,
            'specialPrice' => $request->specialPrice,
            'image'        => $imageName,
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
            'product' => $product,
            'reviews' => $product->review()->orderBy('id', 'desc')->get(),
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
            'product' => $product,
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
            'name'         => 'required',
            'sku'          => 'required',
            'status'       => 'required',
            'basePrice'    => 'required|numeric|max:1000000',
            'specialPrice' => 'numeric|max:99|nullable',
            'image'        => 'mimes:jpeg,jpg,png|max:3000',
            'description'  => 'required',

        ]);

        $image = $request->file('image');
        if ($image) {
            if ($product->image) {
                File::delete("images/$product->image");
            }
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        } else {
            if ($product->image) {
                $imageName = $product->image;
            } else {
                $imageName = null;
            }
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->basePrice = $request->basePrice;
        $product->specialPrice = $request->specialPrice;
        $product->image = $imageName;
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
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->review()->delete();
        File::delete("images/$product->image");
        $product->delete();

        return redirect('products');
    }

    public function multipleDelete(Request $request)
    {

        foreach ($request->products as $id) {
            $product = Product::findOrFail($id);
            $product->review()->delete();
            File::delete("images/$product->image");
            $product->delete();
        }

        return redirect('products');
    }
}
