<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        try {
            $payload = $request->validated();

            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $payload['image'] = $request->file('image');
                $path = $request->file('image')->store('products', 'public');
            }

            $product = Product::create([
                'name' => $payload['name'],
                'price' => $payload['price'],
                'description' => $payload['description'],
                'image_path' => $path,
                'published_at' => Carbon::now(),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        return redirect()->route('products.index');
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
        $product = Product::where('id', $id)->firstOrFail();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {

            DB::beginTransaction();

            $payload = $request->validated();

            $product = Product::where('id', $id)->first();

            if (!$product) {
                return redirect()->back()->with('error', 'Product Not Found');
            }

            if ($request->hasFile('image')) {
                $payload['image'] = $request->file('image');
                $path = $request->file('image')->store('products', 'public');
            }

            $product->update([
                'name' => $payload['name'],
                'price' => $payload['price'],
                'description' => $payload['description'],
                'image_path' => $path ?? $product->image_path,
            ]);

            DB::commit();

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::info("Error Updating Product");
            Log::error($th);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found');
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
