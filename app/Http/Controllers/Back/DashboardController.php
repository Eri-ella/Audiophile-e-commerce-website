<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Order;              
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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