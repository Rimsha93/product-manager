@extends('layouts.app')
@section('title', 'Edit Product')
@section('page-title', '✏️ Edit Product')

@section('content')
<div class="card p-4" style="max-width:650px">
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Category</label>
                <input type="text" name="category" class="form-control" value="{{ $product->category }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Price (Rs.)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection