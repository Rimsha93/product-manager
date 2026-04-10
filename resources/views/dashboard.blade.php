@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', '📊 Dashboard')

@section('content')

{{-- Low Stock Alert Banner --}}
@if($lowStock->count() > 0)
<div class="alert alert-warning d-flex align-items-start gap-2 mb-4">
    <i class="bi bi-exclamation-triangle-fill text-warning mt-1" style="font-size:1.1rem;"></i>
    <div>
        <strong>Low Stock Alert!</strong>
        <span class="text-muted ms-1" style="font-size:0.9rem;">
            {{ $lowStock->count() }} product(s) mein stock kam hai:
        </span>
        <div class="mt-1 d-flex flex-wrap gap-2">
            @foreach($lowStock as $item)
                <span class="badge" style="background:#fff3cd; color:#856404; border:1px solid #ffc107; border-radius:20px; padding:4px 10px; font-size:0.8rem;">
                    {{ $item->name }} — {{ $item->quantity }} left
                </span>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card red p-4">
            <div style="font-size:2rem; font-weight:700;">{{ $totalProducts }}</div>
            <div style="opacity:.85; font-size:0.9rem;">Total Products</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card blue p-4">
            <div style="font-size:1.5rem; font-weight:700;">Rs. {{ number_format($totalValue, 2) }}</div>
            <div style="opacity:.85; font-size:0.9rem;">Inventory Value</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card orange p-4">
            <div style="font-size:2rem; font-weight:700;">{{ $outOfStock }}</div>
            <div style="opacity:.85; font-size:0.9rem;">Out of Stock</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card green p-4">
            @if($mostExpensive)
                <div style="font-size:1.3rem; font-weight:700;">Rs. {{ number_format($mostExpensive->price, 2) }}</div>
                <div style="opacity:.85; font-size:0.85rem;">{{ Str::limit($mostExpensive->name, 20) }}</div>
                <div style="opacity:.7; font-size:0.75rem; margin-top:2px;">Most Expensive</div>
            @else
                <div style="font-size:1.1rem;">No products yet</div>
            @endif
        </div>
    </div>
</div>

{{-- Recent Products Table --}}
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Recent Products</h6>
        <a href="{{ route('products.index') }}" style="color:#e94560; font-size:0.85rem; text-decoration:none;">
            View All <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th><th>Category</th><th>Price</th><th>Qty</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentProducts as $product)
            <tr>
                <td class="fw-semibold">{{ $product->name }}</td>
                <td><span class="badge-category">{{ $product->category }}</span></td>
                <td>Rs. {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    @if($product->quantity == 0)
                        <span class="badge bg-danger rounded-pill">Out of Stock</span>
                    @elseif($product->quantity < 5)
                        <span class="badge bg-warning text-dark rounded-pill">Low Stock</span>
                    @else
                        <span class="badge bg-success rounded-pill">In Stock</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    Koi product nahi mila. <a href="{{ route('products.create') }}" style="color:#e94560;">Add karo!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection