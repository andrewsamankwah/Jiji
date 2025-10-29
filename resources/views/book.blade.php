<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment - Jiji Beauty</title>
    <!-- Add Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .booking-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        .booking-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .booking-title {
            color: #ff69b4;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .time-slots {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
        }
        .time-slot {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            background: white;
            transition: all 0.3s ease;
        }
        .time-slot.selected {
            background: #ff69b4;
            color: white;
            border-color: #ff69b4;
        }
        .time-slot.booked {
            background: #f0f0f0;
            color: #999;
            cursor: not-allowed;
            text-decoration: line-through;
        }
        .btn-book {
            background: #ff69b4;
            border-color: #ff69b4;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-book:hover {
            background: #ff1493;
            border-color: #ff1493;
        }
        .disabled-form {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('layouts.app')

    <div class="booking-container">
        <div class="booking-header">
            <h1 class="booking-title">📅 Book Your Beauty Appointment</h1>
            <p class="text-muted">Schedule your pampering session with Jiji Beauty</p>
        </div>
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>Please fix these errors:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @guest
            <div class="alert alert-info">
                <h4>🔐 Login Required</h4>
                <p>Please login or create an account to book an appointment.</p>
                <div class="mt-3">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register.user') }}" class="btn btn-outline-primary">Create Account</a>
                </div>
            </div>
            
            <!-- Show disabled form for guests -->
            <form method="POST" action="{{ route('appointments.store') }}" id="bookingForm" class="disabled-form">
        @else
            <!-- Show enabled form for logged-in users -->
            <form method="POST" action="{{ route('appointments.store') }}" id="bookingForm">
        @endguest
        
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Your Full Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" 
                           placeholder="Enter your full name" value="{{ old('customer_name', Auth::check() ? Auth::user()->name : '') }}" 
                           @guest disabled @endguest required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="customer_email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" 
                           placeholder="Enter your email" value="{{ old('customer_email', Auth::check() ? Auth::user()->email : '') }}" 
                           @guest disabled @endguest required>
                </div>
            </div>

            <div class="mb-3">
                <label for="customer_phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="customer_phone" name="customer_phone" 
                       placeholder="Enter your phone number" value="{{ old('customer_phone') }}" 
                       @guest disabled @endguest required>
            </div>
            
            <div class="mb-3">
                <label for="service_id" class="form-label">Choose Service</label>
                <select class="form-select" id="service_id" name="service_id" @guest disabled @endguest required>
                    <option value="">Select a service...</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ (old('service_id') == $service->id || (isset($selectedServiceId) && $selectedServiceId == $service->id)) ? 'selected' : '' }}>
                            {{ $service->name }} - {{ $service->user->name }} ({{ $service->location }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="appointment_date" class="form-label">Preferred Date</label>
                    <input type="date" class="form-control" id="appointment_date" name="appointment_date" 
                           value="{{ old('appointment_date') }}" min="{{ date('Y-m-d') }}" 
                           @guest disabled @endguest required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Available Time Slots</label>
                    <div id="timeSlots" class="time-slots">
                        <p class="text-muted">Please select a date first to see available times</p>
                    </div>
                    <input type="hidden" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="notes" class="form-label">Special Requests or Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="4" 
                          placeholder="Any special requirements or notes..." 
                          @guest disabled @endguest>{{ old('notes') }}</textarea>
            </div>
            
            @guest
                <button type="button" class="btn btn-secondary w-100" disabled>Please Login to Book</button>
            @else
                <button type="submit" class="btn btn-book w-100">Book My Appointment</button>
            @endguest
        </form>
        
        <div class="text-center mt-4">
            <p class="text-muted">
                Need help? Call us at (+233) 558484765
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Only enable time slot functionality for logged-in users
        @auth
        document.getElementById('appointment_date').addEventListener('change', function() {
            const selectedDate = this.value;
            const timeSlotsContainer = document.getElementById('timeSlots');
            const appointmentTimeInput = document.getElementById('appointment_time');
            
            if (!selectedDate) {
                timeSlotsContainer.innerHTML = '<p class="text-muted">Please select a date first to see available times</p>';
                appointmentTimeInput.value = '';
                return;
            }

            // Show loading
            timeSlotsContainer.innerHTML = '<p class="text-muted">Loading available time slots...</p>';

            // Fetch available time slots for the selected date
            fetch('{{ route("available.time.slots") }}?date=' + selectedDate)
                .then(response => response.json())
                .then(data => {
                    if (data.availableSlots.length === 0) {
                        timeSlotsContainer.innerHTML = '<p class="text-muted">No available time slots for this date. Please choose another date.</p>';
                        return;
                    }

                    let html = '';
                    data.availableSlots.forEach(slot => {
                        const displayTime = formatTime(slot);
                        html += `
                            <div class="time-slot ${slot.booked ? 'booked' : ''}" 
                                 data-time="${slot.time}" 
                                 onclick="${slot.booked ? '' : `selectTimeSlot('${slot.time}')`}">
                                ${displayTime}
                            </div>
                        `;
                    });
                    
                    timeSlotsContainer.innerHTML = html;
                    
                    // Re-select previously selected time if any
                    if (appointmentTimeInput.value) {
                        const previousSlot = document.querySelector(`[data-time="${appointmentTimeInput.value}"]`);
                        if (previousSlot) {
                            selectTimeSlot(appointmentTimeInput.value);
                        }
                    }
                })
                .catch(error => {
                    timeSlotsContainer.innerHTML = '<p class="text-muted">Error loading time slots. Please try again.</p>';
                    console.error('Error:', error);
                });
        });

        function selectTimeSlot(time) {
            // Remove selected class from all slots
            document.querySelectorAll('.time-slot').forEach(slot => {
                slot.classList.remove('selected');
            });
            
            // Add selected class to clicked slot
            const selectedSlot = document.querySelector(`[data-time="${time}"]`);
            if (selectedSlot) {
                selectedSlot.classList.add('selected');
                document.getElementById('appointment_time').value = time;
            }
        }

        function formatTime(slot) {
            const [hours, minutes] = slot.time.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const displayHour = hour % 12 || 12;
            return `${displayHour}:${minutes} ${ampm}`;
        }

        // Form validation
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            if (!document.getElementById('appointment_time').value) {
                e.preventDefault();
                alert('Please select a time slot');
            }
        });
        @endauth
    </script>
</body>
</html>