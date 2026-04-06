@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', '📊 Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card stat-card p-4">
            <div style="font-size:2rem; font-weight:700;">{{ $totalProducts }}</div>
            <div style="opacity:.8;">Total Products</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card blue p-4">
            <div style="font-size:2rem; font-weight:700;">Rs. {{ number_format($totalValue, 2) }}</div>
            <div style="opacity:.8;">Total Inventory Value</div>
        </div>
    </div>
</div>

<div class="card p-4">
    <h6 class="fw-bold mb-3">Recent Products</h6>
    <table class="table table-hover">
        <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Qty</th></tr></thead>
        <tbody>
            @forelse($recentProducts as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td><span class="badge-category">{{ $product->category }}</span></td>
                <td>Rs. {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->quantity }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted">No products yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection