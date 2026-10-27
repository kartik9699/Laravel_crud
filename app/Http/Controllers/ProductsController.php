<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Products=Products::all();
        return view('Products.list',["Products"=>$Products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB max
        ]);

        // Handle file upload
        $imagepath=null;
        if ($request->hasFile('image')) {
            // Stores the file in storage/app/public/products
            $imagename=time().'-'.$request->file('image')->getClientOriginalExtension();
            $imagepath = $request->file('image')->storeAs('products',$imagename, 'public');
        }

        $product=new Products();
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->image=$imagepath;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        return view('products.edit',['product'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB max
        ]);

        // Handle file upload
        $imagepath=null;
        if ($request->hasFile('image')) {
            // Stores the file in storage/app/public/products
            if ($products->image && storage::disk('public')->exists($products->image)) {
            storage::disk('public')->delete($products->image);
        }
            $imagename=time().'-'.$request->file('image')->getClientOriginalExtension();
            $imagepath = $request->file('image')->storeAs('products',$imagename, 'public');
        }

        $products->name=$request->input('name');
        $products->description=$request->input('description');
        $products->price=$request->input('price');
        $products->image=$imagepath;
        $products->save();

        return redirect()->route('products.index')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        if ($products->image && Storage::disk('public')->exists($products->image)) {
            Storage::disk('public')->delete($products->image);
        }
        $products->delete();
        return redirect()->route('products.index');
    }
}
