<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Service;
use App\Models\Appointment;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products from all sellers
        $products = Product::where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        // Get popular services from all sellers
        $services = Service::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('products', 'services'));
    }

    public function welcome()
    {
        // Get featured products from all sellers
        $products = Product::where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        // Get popular services from all sellers
        $services = Service::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('products', 'services'));
    }

    public function userDashboard()
    {
        return view('dashboard.user');
    }

    // Seller Dashboard with real data
    // Seller Dashboard with real data
public function sellerDashboard()
{
    $user = Auth::user();
    
    // Get real statistics from database
    $totalProducts = $user->products()->count();
    $totalServices = $user->services()->count();
    
    // Get appointment statistics
    $pendingAppointments = $user->appointments()
        ->where('status', 'pending')
        ->count();
    
    $completedAppointments = $user->appointments()
        ->where('status', 'completed')
        ->count();
    
    $recentAppointments = $user->appointments()
        ->with('service')
        ->latest()
        ->take(5)
        ->get();

    return view('seller.dashboard', compact(
        'totalProducts',
        'totalServices',
        'pendingAppointments',
        'completedAppointments',
        'recentAppointments'
    ));
}
   

      //Handle search functionality
     
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        // Search products
        $products = Product::where('status', 'active')
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->get();

        // Search services
        $services = Service::where('status', 'active')
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->get();

        return view('search-results', compact('products', 'services', 'query'));
    }

}