<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $categoriesCount = Category::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Chart data: Products per category
        $productsPerCategory = Category::withCount('products')->get()->map(function($cat) {
            return [
                'name' => $cat->name,
                'count' => $cat->products_count,
            ];
        });

        // Orders by Status - Map status codes to readable labels
        $statusLabelsMap = [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            // Add more if you have other statuses
        ];

        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Map status codes to readable labels for chart
        $ordersByStatusLabels = $ordersByStatus->keys()->map(function($status) use ($statusLabelsMap) {
            return $statusLabelsMap[$status] ?? ucfirst($status);
        });
        $ordersByStatusData = $ordersByStatus->values();

        // User Registrations Over Time (last 14 days, by day)
        $userRegistrations = User::selectRaw("DATE(created_at) as day, COUNT(*) as count")
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count', 'day');
        $userRegistrationsLabels = $userRegistrations->keys();
        $userRegistrationsData = $userRegistrations->values();

        return view('dashboard', compact(
            'usersCount',
            'productsCount',
            'ordersCount',
            'categoriesCount',
            'recentOrders',
            'productsPerCategory',
            'ordersByStatusLabels',
            'ordersByStatusData',
            'userRegistrationsLabels',
            'userRegistrationsData'
        ));
    }
}