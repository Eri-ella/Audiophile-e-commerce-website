<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;              
use App\Models\Product;              
use App\Models\User;              
use App\Models\Detail;              
use App\Models\Payment;              
use App\Models\Category;              

class DashboardController extends Controller
{
    // ** affichage du contenu du dashboard
    public function index() {
        //**
        // TABLEAU DE BORD
        //  */
        // ** activités **
        // ** revenu 
        $current_month = now();
        $previous_month = now()->subMonth();

        $total_amount = Order::whereMonth('created_at', $current_month->month)
            ->whereYear('created_at', $current_month->year)
            ->sum('amount');

        $last_month_total_amount = Order::whereMonth('created_at', $previous_month->month)
            ->whereYear('created_at', $previous_month->year)
            ->sum('amount');

        $increase_percent = $last_month_total_amount > 0 
            ? (($total_amount - $last_month_total_amount) / $last_month_total_amount) * 100 
            : ($total_amount > 0 ? 100 : 0);

        // ** commande
        $total_order = Order::whereMonth('created_at', $current_month->month)
            ->whereYear('created_at', $current_month->year)
            ->count();

        $last_month_total_order = Order::whereMonth('created_at', $previous_month->month)
            ->whereYear('created_at', $previous_month->year)
            ->count();
        $increase_order = $last_month_total_order - $total_order;

        // ** produit
        $stock_product = Product::where('stock', '>', 0)
            ->count();

        $out_of_stock_product = Product::where('stock', 0)
            ->count();

        // ** user
        $total_user = User::whereMonth('created_at', $current_month->month)
            ->whereYear('created_at', $current_month->year)
            ->count();

        $last_month_total_user = User::whereMonth('created_at', $previous_month->month)
            ->whereYear('created_at', $previous_month->year)
            ->count();

        $increase_user = $last_month_total_user - $total_user;

        // ** meilleurs ventes **
        $all_details = Detail::with('product')
            ->whereMonth('created_at', $current_month->month)
            ->get();

        $details = $all_details->sortByDesc(function($detail){
            return $detail->quantity * $detail->product->price;
        })->take(4);

        // ** transactions recentes **
        $orders = Order::with(['client', 'payment'])
            ->take(10)
            ->get();

        //**
        // PRODUIT
        //  */
        $products = Product::with('categories')
            ->get();

        //**
        // CATEGORIE
        //  */
        $categories = Category::all();

        //**
        // UTILISATEURS
        //  */
        $users = User::with('orders')->get();

        //**
        // PARAMETRE
        //  */
        $admin = Auth::user();

        return view('admin.admin_page',
            compact('total_amount',
                    'increase_percent',
                    'total_order',
                    'increase_order',
                    'stock_product',
                    'out_of_stock_product',
                    'total_user',
                    'increase_user',
                    'details',
                    'orders',
                    'products',
                    'categories',
                    'users',
                    'admin'));
    }

    // ** recuperation du contenu 
    public function store (Request $request) {

    }

    // ** graphe **
    // sales dates 
    public function salesData()
    {
        $sales = Order::query()
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month');


        return response()->json([
            'labels' => ['Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sep','Oct','Nov','Déc'],
        ]);
    }
}