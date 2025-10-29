<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show all products (for customers)
    public function index()
    {
        $products = Product::with('user')->active()->latest()->get();
        
        // DEBUG: Check what's happening
        \Log::info('Products index called. Products count: ' . $products->count());
        \Log::info('View path: products.index');
        
        // Check if view exists
        if (!view()->exists('products.index')) {
            \Log::error('View products.index does not exist!');
            
            // Debug: List all files in products directory
            $files = scandir(resource_path('views/products'));
            \Log::error('Files in products directory: ' . implode(', ', $files));
            
            dd(
                'DEBUG: View products.index not found!',
                'Looking for: resources/views/products/index.blade.php',
                'Files found in products directory:',
                $files,
                'Current working directory: ' . getcwd(),
                'Resource path: ' . resource_path('views/products')
            );
        }
        
        return view('products.index', compact('products'));
    }

        /**
        * Show product details
       */
      public function show($id)
        {
          $product = Product::where('status', 'active')->findOrFail($id);
         return view('products.show', compact('product'));
        }
    // Show products by category
    public function byCategory($category)
    {
        $products = Product::with('user')
            ->active()
            ->where('category', $category)
            ->latest()
            ->get();
        return view('products.index', compact('products', 'category'));
    }

    // Show create form (for sellers)
    public function create()
    {
        return view('seller.products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'contact_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('products', 'public');
            $validated['photo'] = $photoPath;
        }

        // Add user_id
        $validated['user_id'] = auth()->id();

        Product::create($validated);

        return redirect()->route('products.manage')
            ->with('success', 'Product added successfully!');
    }

    // Manage products (for sellers)
    public function manage()
    {
        $products = Product::where('user_id', auth()->id())->latest()->get();
        return view('seller.products.manage', compact('products'));
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        return view('seller.products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'contact_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        // Handle photo upload if new photo provided
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $photoPath = $request->file('photo')->store('products', 'public');
            $validated['photo'] = $photoPath;
        }

        $product->update($validated);

        return redirect()->route('products.manage')
            ->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        
        // Delete photo
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('products.manage')
            ->with('success', 'Product deleted successfully!');
    }
}