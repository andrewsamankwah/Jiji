<footer style="background: linear-gradient(135deg, #2d3047 0%, #1a1c2b 100%); color: white; padding: 60px 0 30px; margin-top: 80px;">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 style="color: #ff69b4; font-weight: 700; margin-bottom: 20px;">Jiji Beauty</h5>
                <p style="color: #adb5bd; line-height: 1.6;">
                    Your one-stop destination for premium beauty products and professional services. 
                    Discover amazing beauty solutions and connect with trusted professionals.
                </p>
                <div class="social-links" style="display: flex; gap: 15px; margin-top: 20px;">
                    <a href="#" style="color: white; background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="color: white; background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="color: white; background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="color: white; background: rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 style="color: white; font-weight: 600; margin-bottom: 20px;">Quick Links</h6>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('welcome') }}" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Home</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('products.all') }}" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Products</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('services.index') }}" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Services</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('book') }}" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Book Appointment</a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 style="color: white; font-weight: 600; margin-bottom: 20px;">Categories</h6>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('search') }}?q=skincare" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Skincare</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('search') }}?q=makeup" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Makeup</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('search') }}?q=hair" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Hair Care</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('search') }}?q=perfumes" style="color: #adb5bd; text-decoration: none; transition: color 0.3s ease;">Perfumes</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 style="color: white; font-weight: 600; margin-bottom: 20px;">Contact Us</h6>
                <div style="color: #adb5bd;">
                    <p style="margin-bottom: 10px;">
                        <i class="fas fa-envelope" style="color: #ff69b4; margin-right: 10px;"></i>
                        hello@jijibeauty.com
                    </p>
                    <p style="margin-bottom: 10px;">
                        <i class="fas fa-phone" style="color: #ff69b4; margin-right: 10px;"></i>
                        +233 55 848 4765
                    </p>
                    <p style="margin-bottom: 10px;">
                        <i class="fas fa-map-marker-alt" style="color: #ff69b4; margin-right: 10px;"></i>
                        Accra, Ghana
                    </p>
                </div>
                
                <!-- Newsletter Signup -->
                <div style="margin-top: 20px;">
                    <h6 style="color: white; font-weight: 600; margin-bottom: 15px; font-size: 0.9rem;">NEWSLETTER</h6>
                    <div style="display: flex; gap: 10px;">
                        <input type="email" placeholder="Your email" style="flex: 1; padding: 10px 15px; border: none; border-radius: 5px; font-size: 0.9rem;">
                        <button style="background: #ff69b4; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; font-weight: 600; transition: background 0.3s ease;">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="row" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px; margin-top: 30px;">
            <div class="col-md-6">
                <p style="color: #adb5bd; margin: 0; font-size: 0.9rem;">
                    &copy; 2025 Jiji Beauty. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <div style="display: flex; gap: 20px; justify-content: flex-end;">
                    <a href="#" style="color: #adb5bd; text-decoration: none; font-size: 0.9rem; transition: color 0.3s ease;">Privacy Policy</a>
                    <a href="#" style="color: #adb5bd; text-decoration: none; font-size: 0.9rem; transition: color 0.3s ease;">Terms of Service</a>
                    <a href="#" style="color: #adb5bd; text-decoration: none; font-size: 0.9rem; transition: color 0.3s ease;">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .social-links a:hover {
        background: #ff69b4 !important;
        transform: translateY(-2px);
    }
    
    footer a:hover {
        color: #ff69b4 !important;
    }
    
    footer button:hover {
        background: #ff4d7a !important;
    }
</style>