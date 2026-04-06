@extends('layouts.app')
@section('title', 'Products')
@section('page-title', '📦 All Products')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add Product
    </a>
</div>

<div class="card p-4">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Category</th>
                <th>Price</th><th>Quantity</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $product->name }}</strong></td>
                <td><span class="badge-category">{{ $product->category }}</span></td>
                <td>Rs. {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this product?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-4">No products found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-2">{{ $products->links() }}</div>
</div>
@endsection