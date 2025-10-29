<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        // Get all active services from database
        $services = Service::with('user')->active()->latest()->get();
        
        // Get selected service from query parameter
        $selectedServiceId = $request->query('service_id');
        
        return view('book', compact('services', 'selectedServiceId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Combine date and time
        $appointmentDateTime = $validated['appointment_date'] . ' ' . $validated['appointment_time'];

        // Get the service to get price and seller info
        $service = Service::findOrFail($validated['service_id']);

        // Create appointment
        $appointment = Appointment::create([
            'user_id' => $service->user_id, // Seller ID
            'service_id' => $validated['service_id'],
            'appointment_date' => $appointmentDateTime,
            'duration' => 60, // Default 60 minutes
            'price' => 0, // You can add price field to services later
            'status' => 'pending',
            'notes' => $validated['notes'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
        ]);

        return redirect()->route('book')
            ->with('success', 'Appointment booked successfully! We will contact you to confirm.');
    }

    // For time slots API (used in your JavaScript)
    public function availableTimeSlots(Request $request)
    {
        $date = $request->query('date');
        
        // Generate time slots (8:00 AM to 8:00 PM)
        $timeSlots = [];
        for ($hour = 8; $hour <= 20; $hour++) {
            $time = sprintf('%02d:00', $hour);
            $timeSlots[] = [
                'time' => $time,
                'booked' => false // You can add logic to check existing appointments
            ];
        }

        return response()->json([
            'availableSlots' => $timeSlots
        ]);
    }

    // Manage appointments for sellers
    public function manage()
    {
        $appointments = Appointment::with(['service', 'user'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
            
        return view('seller.appointments.manage', compact('appointments'));
    }

    // Add these methods to your existing AppointmentController

/**
 * Show appointment details
 */
public function show($id)
{
    $appointment = Appointment::with('service')->findOrFail($id);
    
    // Ensure the appointment belongs to the current seller
    if ($appointment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    
    return view('seller.appointments.show', compact('appointment'));
}

/**
 * Update appointment status
 */
public function updateStatus(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    
    // Ensure the appointment belongs to the current seller
    if ($appointment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    
    $request->validate([
        'status' => 'required|in:pending,confirmed,completed,cancelled'
    ]);
    
    $appointment->update([
        'status' => $request->status
    ]);
    
    return redirect()->route('appointments.show', $appointment->id)
        ->with('success', 'Appointment status updated successfully!');
}
}