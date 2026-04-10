<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
         $search   = request('search');
    $products = Product::where('user_id', auth()->id())
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        })  ->latest()  ->paginate(8);

    return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'user_id'     => auth()->id(),
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        abort_if($product->user_id !== auth()->id(), 403);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        abort_if($product->user_id !== auth()->id(), 403);

        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        abort_if($product->user_id !== auth()->id(), 403);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}