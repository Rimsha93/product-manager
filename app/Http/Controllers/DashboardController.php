<?php
namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalProducts    = Product::where('user_id', $userId)->count();
        $totalValue       = Product::where('user_id', $userId)->sum(\DB::raw('price * quantity'));
        $recentProducts   = Product::where('user_id', $userId)->latest()->take(5)->get();
        $outOfStock       = Product::where('user_id', $userId)->where('quantity', 0)->count();
        $lowStock         = Product::where('user_id', $userId)->where('quantity', '>', 0)->where('quantity', '<', 5)->get();
        $mostExpensive    = Product::where('user_id', $userId)->orderBy('price', 'desc')->first();

        return view('dashboard', compact(
            'totalProducts', 'totalValue', 'recentProducts',
            'outOfStock', 'lowStock', 'mostExpensive'
        ));
    }
}