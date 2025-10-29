<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Show all services (for customers)
    public function index()
    {
        $services = Service::with('user')->active()->latest()->get();
        return view('services.index', compact('services'));
    }

    // Show create form (for sellers)
    public function create()
    {
        return view('seller.services.create');
    }

    // Store new service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'contact_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('services', 'public');
            $validated['photo'] = $photoPath;
        }

        // Add user_id
        $validated['user_id'] = auth()->id();

        Service::create($validated);

        return redirect()->route('services.manage')
            ->with('success', 'Service added successfully!');
    }

    // Manage services (for sellers)
    public function manage()
    {
        $services = Service::where('user_id', auth()->id())->latest()->get();
        return view('seller.services.manage', compact('services'));
    }

    // Show edit form
    public function edit($id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id);
        return view('seller.services.edit', compact('service'));
    }

    // Show service details
      public function show($id)
      {   
        $service = Service::where('status', 'active')->findOrFail($id);
        return view('service.show', compact('service'));
      }
    // Update service
    public function update(Request $request, $id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'contact_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        // Handle photo upload if new photo provided
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($service->photo) {
                Storage::disk('public')->delete($service->photo);
            }
            $photoPath = $request->file('photo')->store('services', 'public');
            $validated['photo'] = $photoPath;
        }

        $service->update($validated);

        return redirect()->route('services.manage')
            ->with('success', 'Service updated successfully!');
    }

    // Delete service
    public function destroy($id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id);
        
        // Delete photo
        if ($service->photo) {
            Storage::disk('public')->delete($service->photo);
        }

        $service->delete();

        return redirect()->route('services.manage')
            ->with('success', 'Service deleted successfully!');
    }
}