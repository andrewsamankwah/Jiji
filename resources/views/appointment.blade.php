<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment - Jiji Beauty</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #f8f9fa;
        }
        .booking-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #5a6fd8;
        }
        .service-option {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .service-option.selected {
            border-color: #667eea;
            background: #f0f4ff;
        }
        .price {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="booking-form">
        <h1>📅 Book Your Appointment</h1>
        <p>Schedule your beauty service with Jiji Beauty</p>

        <form id="bookingForm">
            <!-- Service Selection -->
            <div class="form-group">
                <label>Choose a Service:</label>
                @foreach($services as $service)
                <div class="service-option" onclick="selectService({{ $service['id'] }})">
                    <strong>{{ $service['name'] }}</strong>
                    <div class="price">${{ $service['price'] }}</div>
                    <small>{{ $service['duration'] }} minutes • {{ $service['category'] }}</small>
                </div>
                @endforeach
                <input type="hidden" name="service_id" id="service_id" required>
            </div>

            <!-- Customer Information -->
            <div class="form-group">
                <label>Your Name:</label>
                <input type="text" name="customer_name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="customer_email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Phone Number:</label>
                <input type="tel" name="customer_phone" placeholder="Enter your phone number" required>
            </div>

            <!-- Appointment Date & Time -->
            <div class="form-group">
                <label>Preferred Date:</label>
                <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Preferred Time:</label>
                <select name="appointment_time" required>
                    <option value="">Select a time</option>
                    <option value="09:00">9:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                </select>
            </div>

            <!-- Special Requests -->
            <div class="form-group">
                <label>Special Requests or Notes:</label>
                <textarea name="notes" rows="3" placeholder="Any special requirements or preferences..."></textarea>
            </div>

            <button type="submit">Book Appointment</button>
        </form>
    </div>

    <script>
        function selectService(serviceId) {
            // Remove selected class from all services
            document.querySelectorAll('.service-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked service
            event.currentTarget.classList.add('selected');
            
            // Set the hidden input value
            document.getElementById('service_id').value = serviceId;
        }

        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Appointment booking functionality will be implemented next! For now, your details are captured.');
            // In the next step, we'll send this to the server
        });
    </script>
</body>
</html>