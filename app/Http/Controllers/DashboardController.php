<?php
namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::where('user_id', auth()->id())->count();
        $totalValue     = Product::where('user_id', auth()->id())->sum(\DB::raw('price * quantity'));
        $recentProducts = Product::where('user_id', auth()->id())->latest()->take(5)->get();

        return view('dashboard', compact('totalProducts', 'totalValue', 'recentProducts'));
    }
}