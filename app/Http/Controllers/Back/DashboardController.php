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
    public function index(Request $request)
    {
        $section = $request->path(); 

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

        // Commandes
        $total_order = Order::whereMonth('created_at', $current_month->month)
            ->whereYear('created_at', $current_month->year)
            ->count();

        $last_month_total_order = Order::whereMonth('created_at', $previous_month->month)
            ->whereYear('created_at', $previous_month->year)
            ->count();
        $increase_order = $total_order - $last_month_total_order;

        // Produits
        $stock_product = Product::where('stock', '>', 0)->count();
        $out_of_stock_product = Product::where('stock', 0)->count();

        // Utilisateurs
        $total_user = User::whereMonth('created_at', $current_month->month)
            ->whereYear('created_at', $current_month->year)
            ->count();

        $last_month_total_user = User::whereMonth('created_at', $previous_month->month)
            ->whereYear('created_at', $previous_month->year)
            ->count();

        $increase_user = $total_user - $last_month_total_user;

        // Données de base pour le dashboard
        $all_details = Detail::with('product')
            ->whereMonth('created_at', $current_month->month)
            ->get();

        $details = $all_details->sortByDesc(function($detail){
            return $detail->quantity * $detail->product->price;
        })->take(4);

        $view = 'admin.tableau_bord';
        $data = [
            'section' => $section,
            'total_amount' => $total_amount,
            'increase_percent' => round($increase_percent, 1),
            'total_order' => $total_order,
            'increase_order' => $increase_order,
            'stock_product' => $stock_product,
            'out_of_stock_product' => $out_of_stock_product,
            'total_user' => $total_user,
            'increase_user' => $increase_user,
            'details' => $details,
        ];

        // La vue et les données selon la section
        if (str_contains($section, 'product')) {
            $view = 'admin.product';
            $data['products'] = Product::with('categories', 'contents')->get();
            $data['categories'] = Category::all();
            
        } elseif (str_contains($section, 'category')) {
            $view = 'admin.category';
            $data['categories'] = Category::all();
            
        } elseif (str_contains($section, 'transaction')) {
            $view = 'admin.transaction';
            $data['orders'] = Order::with(['client', 'payment'])->get(); 
            
        }  elseif (str_contains($section, 'user')) {
            $view = 'admin.user';
            $data['users'] = User::with('orders')->get();
            
        }  elseif (str_contains($section, 'setting')) {
            $view = 'admin.setting';
            $data['admin'] = Auth::user();
            
        } else {
            // Dashboard par défaut
            $view = 'admin.tableau_bord';
            $data['orders'] = Order::with(['client', 'payment'])->latest()->take(5)->get();
        }
        $data['view']=$view;
        
        return view('admin.admin_page', $data);
    }

    public function salesData()
    {
        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        
        $salesData = Order::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $data = array_fill(0, 12, 0);
        
        foreach ($salesData as $sale) {
            $data[$sale->month - 1] = $sale->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}