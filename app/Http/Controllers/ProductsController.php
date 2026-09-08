<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Inertia\Inertia;
use App\Enums\ProductType;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        foreach($products as $product){

            $product['type_name'] = 'Service';

            if($product->type == ProductType::TypeIsProduct->value)
            {
                $product['type_name'] = 'Product';
            }
        }
        return Inertia::render('products/index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('products/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'type' => $request->type,
            'unit_price' => $request->price * 100,
            'description' => $request->description,
        ];
        Product::create($data);

        return redirect()->route('products.index')->with('success','Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return Inertia::render('products/edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        $product->update([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'unit_price' => $request->price *100,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);

        return redirect()->route('products.index')->with('success','deleted successfully');
    }
}