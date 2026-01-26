@extends('user.layouts.app')
@section('content')
    <!-- Page Header -->
    <header class="page-header">
        <div class="container text-center position-relative">
            <h1 class="display-4">Contact Us</h1>
            <p class="lead mb-0">We'd love to hear from you! Reach out to us for any questions, feedback, or support.</p>
        </div>
    </header>

    <!-- Contact Information Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Address Card -->
                <div class="col-md-4">
                    <div class="card contact-card">
                        <div class="card-body">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <h5>Our Address</h5>
                            <p>
                                123 Business Street,<br>
                                Tech District, Suite 456<br>
                                Amman, Jordan 11953
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="col-md-4">
                    <div class="card contact-card">
                        <div class="card-body">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <h5>Email Us</h5>
                            <p>
                                <a href="mailto:info@company.com">info@company.com</a><br>
                                <a href="mailto:support@company.com">support@company.com</a><br>
                                Available 24/7
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phone Card -->
                <div class="col-md-4">
                    <div class="card contact-card">
                        <div class="card-body">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <h5>Call Us</h5>
                            <p>
                                <a href="tel:+96211234567">+962 1 123 4567</a><br>
                                <a href="tel:+96279876543">+962 79 876 543</a><br>
                                Mon-Fri: 9AM - 6PM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Success Alert (hidden by default) -->
                    <div id="successAlert" class="alert alert-custom alert-success-custom d-none mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Success!</strong> Your message has been sent successfully. We'll get back to you soon!
                    </div>

                    <!-- Error Alert (hidden by default) -->
                    <div id="errorAlert" class="alert alert-custom alert-error-custom d-none mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Error!</strong> Something went wrong. Please try again later.
                    </div>

                    <div class="card form-card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold" style="color: var(--primary-color);">Send Us a Message</h2>
                                <p class="text-muted">Fill out the form below and we'll respond as soon as possible</p>
                            </div>

                            <form id="contactForm">
                                <div class="row g-3">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John Doe" required>
                                        <div class="invalid-feedback">
                                            Please enter your full name.
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid email address.
                                        </div>
                                    </div>

                                    <!-- Phone (Optional) -->
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+962 79 123 4567">
                                    </div>

                                    <!-- Subject -->
                                    <div class="col-md-6">
                                        <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                        <select class="form-select" id="subject" name="subject" required>
                                            <option value="" selected disabled>Select a subject</option>
                                            <option value="general">General Inquiry</option>
                                            <option value="support">Technical Support</option>
                                            <option value="sales">Sales & Pricing</option>
                                            <option value="feedback">Feedback</option>
                                            <option value="partnership">Partnership</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a subject.
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-12">
                                        <label for="message" class="form-label">Your Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="message" name="message" rows="6" placeholder="Tell us how we can help you..." required></textarea>
                                        <div class="invalid-feedback">
                                            Please enter your message.
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                                            <span id="btnText">
                                                <i class="bi bi-send me-2"></i>Send Message
                                            </span>
                                            <span id="btnLoading" class="d-none">
                                                <span class="spinner-border spinner-border-sm-custom me-2" role="status" aria-hidden="true"></span>
                                                Sending...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-color);">Find Us on the Map</h2>
                <p class="text-muted">Visit our office or drop by for a coffee</p>
            </div>
            <div class="map-container">
                <!-- Google Maps Embed - Replace with your actual location -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54608.91515497911!2d35.86446983872712!3d31.956565844333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca1c83f171b89%3A0x9d4f185133e68bdd!2sAmman%2C%20Jordan!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="text-center">
                <div class="cta-icon">
                    <i class="bi bi-question-circle"></i>
                </div>
                <h2 class="fw-bold mb-3" style="color: var(--secondary-color);">Need Quick Answers?</h2>
                <p class="lead mb-4" style="color: var(--secondary-color); opacity: 0.8;">
                    Check out our FAQ page for instant answers to common questions
                </p>
                <a href="#faq" class="btn btn-primary-custom">
                    <i class="bi bi-question-octagon me-2"></i>Visit FAQ
                </a>
            </div>
        </div>
    </section>

@endsection
@section('contact_style')
    <style>
        :root {
            --primary-color: #c52c26;
            --secondary-color: #555555;
            --light-color: #fff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--secondary-color);
            background-color: #f8f9fa;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #a32420 100%);
            color: var(--light-color);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.95;
            position: relative;
        }

        /* Contact Info Cards */
        .contact-card {
            background: var(--light-color);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(197, 44, 38, 0.15);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #a32420 100%);
            color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 1.5rem;
        }

        .contact-card h5 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .contact-card p {
            color: var(--secondary-color);
            margin: 0;
            line-height: 1.8;
        }

        .contact-card a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-card a:hover {
            color: var(--primary-color);
        }

        /* Contact Form */
        .form-card {
            background: var(--light-color);
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(197, 44, 38, 0.15);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--light-color);
            padding: 0.875rem 3rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: #a32420;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(197, 44, 38, 0.3);
        }

        .btn-primary-custom:disabled {
            background-color: #d3d3d3;
            cursor: not-allowed;
        }

        /* Map Section */
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            height: 400px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 3rem 0;
            border-radius: 15px;
            margin-top: 4rem;
        }

        .cta-icon {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
        }

        /* Alert Messages */
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .alert-success-custom {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error-custom {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Loading Spinner */
        .spinner-border-sm-custom {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }
    </style>
@endsection
@section('contact_script')
    <!-- Form Validation & Submit Handler -->
    <script>
        // Form validation and submit handler
        (function() {
            'use strict';

            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();

                // Hide any existing alerts
                successAlert.classList.add('d-none');
                errorAlert.classList.add('d-none');

                if (form.checkValidity()) {
                    // Show loading state
                    submitBtn.disabled = true;
                    btnText.classList.add('d-none');
                    btnLoading.classList.remove('d-none');

                    // Simulate form submission (replace with actual AJAX call)
                    setTimeout(function() {
                        // Reset button state
                        submitBtn.disabled = false;
                        btnText.classList.remove('d-none');
                        btnLoading.classList.add('d-none');

                        // Show success message
                        successAlert.classList.remove('d-none');

                        // Scroll to success message
                        successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        // Reset form
                        form.reset();
                        form.classList.remove('was-validated');
                    }, 2000);
                } else {
                    form.classList.add('was-validated');
                }
            });

            // Real-time validation feedback
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });
            });
        })();
    </script>
@endsection
