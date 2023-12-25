<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

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
                $path = $request->file('image')->store('product', 'public');
            }

            $product = Product::create([
                'name' => $payload['name'],
                'price' => $payload['price'],
                'description' => $payload['description'],
                'image_path' => $path,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        return redirect()->route('products.index');
    }

    // public function store(Request $request)
    // {
    //     dd($request);

    //     $payload = $request->validated();

    //     dd($payload);
    // }


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
