@extends('user.layouts.app')
@section('content')

<!-- Page Header -->
    <header class="page-header">
        <div class="container text-center position-relative">
            <h1 class="display-4">Frequently Asked Questions</h1>
            <p class="lead mb-0">Find answers to common questions about our services, platform, and policies</p>

            <!-- Search Box -->
            <div class="search-box">
                <div class="d-flex align-items-center">
                    <i class="bi bi-search fs-5 me-2"></i>
                    <input type="text" id="searchInput" class="form-control-plaintext" placeholder="Search for questions...">
                </div>
            </div>
        </div>
    </header>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">

            <!-- General Questions Category -->
            <div class="faq-category" data-category="general">
                <h2 class="category-title">
                    <i class="bi bi-question-circle me-2"></i>General Questions
                </h2>

                <div class="accordion" id="accordionGeneral">
                    <div class="accordion-item" data-question="what is this platform about">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general1">
                                What is this platform about?
                            </button>
                        </h3>
                        <div id="general1" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Our platform is a comprehensive digital solution designed to help businesses streamline their operations, enhance productivity, and connect with their customers more effectively. We provide cutting-edge tools and services that integrate seamlessly with your existing workflows.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="how do i get started">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general2">
                                How do I get started?
                            </button>
                        </h3>
                        <div id="general2" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Getting started is simple! Click on the "Sign Up" button at the top of the page, fill in your basic information, and verify your email address. Once verified, you can explore our features through a guided onboarding process that will help you set up your account in minutes.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="is there a mobile app available">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general3">
                                Is there a mobile app available?
                            </button>
                        </h3>
                        <div id="general3" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Yes! We offer native mobile applications for both iOS and Android devices. You can download them from the App Store or Google Play Store. Our mobile apps provide full functionality, allowing you to manage your account and access all features on the go.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="what browsers are supported">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general4">
                                What browsers are supported?
                            </button>
                        </h3>
                        <div id="general4" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Our platform works best on the latest versions of Chrome, Firefox, Safari, and Edge. We recommend keeping your browser updated to ensure optimal performance and security. Internet Explorer is not supported.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account & Registration Category -->
            <div class="faq-category" data-category="account">
                <h2 class="category-title">
                    <i class="bi bi-person-circle me-2"></i>Account & Registration
                </h2>

                <div class="accordion" id="accordionAccount">
                    <div class="accordion-item" data-question="how do i create an account">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account1">
                                How do I create an account?
                            </button>
                        </h3>
                        <div id="account1" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                            <div class="accordion-body">
                                To create an account, click the "Sign Up" button and provide your name, email address, and create a secure password. You'll receive a verification email to confirm your account. Follow the link in the email to complete the registration process.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="forgot password reset">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account2">
                                I forgot my password. How can I reset it?
                            </button>
                        </h3>
                        <div id="account2" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                            <div class="accordion-body">
                                Click on the "Forgot Password" link on the login page. Enter your registered email address, and we'll send you instructions to reset your password. The reset link is valid for 24 hours for security purposes.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="change email address">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account3">
                                Can I change my email address?
                            </button>
                        </h3>
                        <div id="account3" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                            <div class="accordion-body">
                                Yes, you can update your email address from your account settings. Go to Settings → Profile → Email Address. You'll need to verify the new email address before the change takes effect. This helps ensure the security of your account.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="delete deactivate account">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account4">
                                How do I delete or deactivate my account?
                            </button>
                        </h3>
                        <div id="account4" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                            <div class="accordion-body">
                                To delete or deactivate your account, go to Settings → Account → Delete Account. Please note that deleting your account is permanent and all your data will be removed. We recommend downloading your data before proceeding with deletion.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services & Products Category -->
            <div class="faq-category" data-category="services">
                <h2 class="category-title">
                    <i class="bi bi-briefcase me-2"></i>Services & Products
                </h2>

                <div class="accordion" id="accordionServices">
                    <div class="accordion-item" data-question="what services do you offer">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#services1">
                                What services do you offer?
                            </button>
                        </h3>
                        <div id="services1" class="accordion-collapse collapse" data-bs-parent="#accordionServices">
                            <div class="accordion-body">
                                We offer a comprehensive suite of digital services including cloud-based solutions, business automation tools, data analytics, customer relationship management, and integration services. Each service is designed to scale with your business needs.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="how to book or purchase">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#services2">
                                How do I book or purchase services?
                            </button>
                        </h3>
                        <div id="services2" class="accordion-collapse collapse" data-bs-parent="#accordionServices">
                            <div class="accordion-body">
                                Browse our services catalog, select the service you need, and click "Add to Cart" or "Book Now". Follow the checkout process, select your preferred payment method, and confirm your order. You'll receive a confirmation email with all the details.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="cancel modify booking">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#services3">
                                Can I cancel or modify my booking?
                            </button>
                        </h3>
                        <div id="services3" class="accordion-collapse collapse" data-bs-parent="#accordionServices">
                            <div class="accordion-body">
                                Yes, you can cancel or modify your booking up to 48 hours before the scheduled service date without any fees. To make changes, go to "My Bookings" in your account dashboard. Cancellations within 48 hours may incur a small fee.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="refund policy">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#services4">
                                What is your refund policy?
                            </button>
                        </h3>
                        <div id="services4" class="accordion-collapse collapse" data-bs-parent="#accordionServices">
                            <div class="accordion-body">
                                We offer a 30-day money-back guarantee on most of our services. If you're not satisfied, contact our support team within 30 days of purchase to request a refund. Certain services and custom solutions may have different refund terms.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments & Security Category -->
            <div class="faq-category" data-category="payments">
                <h2 class="category-title">
                    <i class="bi bi-credit-card me-2"></i>Payments & Security
                </h2>

                <div class="accordion" id="accordionPayments">
                    <div class="accordion-item" data-question="payment methods accepted">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payments1">
                                What payment methods do you accept?
                            </button>
                        </h3>
                        <div id="payments1" class="accordion-collapse collapse" data-bs-parent="#accordionPayments">
                            <div class="accordion-body">
                                We accept all major credit and debit cards (Visa, MasterCard, American Express), PayPal, bank transfers, and digital wallets. All payments are processed securely through our encrypted payment gateway.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="is payment information secure">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payments2">
                                Is my payment information secure?
                            </button>
                        </h3>
                        <div id="payments2" class="accordion-collapse collapse" data-bs-parent="#accordionPayments">
                            <div class="accordion-body">
                                Absolutely. We use industry-standard SSL encryption and are PCI-DSS compliant. Your payment information is never stored on our servers. All transactions are processed through secure, certified payment processors.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="invoice receipt">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payments3">
                                How do I get an invoice or receipt?
                            </button>
                        </h3>
                        <div id="payments3" class="accordion-collapse collapse" data-bs-parent="#accordionPayments">
                            <div class="accordion-body">
                                After each transaction, an invoice is automatically sent to your registered email address. You can also download invoices anytime from your account dashboard under "Billing & Invoices". Invoices include all transaction details for your records.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-question="subscription billing">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payments4">
                                How does subscription billing work?
                            </button>
                        </h3>
                        <div id="payments4" class="accordion-collapse collapse" data-bs-parent="#accordionPayments">
                            <div class="accordion-body">
                                Subscriptions are billed automatically based on your chosen plan (monthly or annually). You'll be charged on the same date each billing cycle. You can cancel anytime, and you'll retain access until the end of your current billing period.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- No Results Message (hidden by default) -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="bi bi-search"></i>
                <h4>No matching questions found</h4>
                <p>Try different keywords or browse the categories above</p>
            </div>

        </div>
    </section>

    <!-- Contact Support Section -->
    <section class="contact-support">
        <div class="container">
            <div class="text-center">
                <div class="support-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <h2 class="fw-bold mb-3" style="color: var(--secondary-color);">Still have questions?</h2>
                <p class="lead mb-4" style="color: var(--secondary-color); opacity: 0.8;">
                    Can't find the answer you're looking for? Our support team is here to help you.
                </p>
                <a href="#contact" class="btn btn-primary-custom">
                    <i class="bi bi-envelope me-2"></i>Contact Support
                </a>
            </div>
        </div>
    </section>

@endsection

@section('style_faq')
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
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .search-box {
            background: var(--light-color);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 2rem auto 0;
        }

        .search-box input {
            border: none;
            outline: none;
            padding: 0.5rem;
            width: 100%;
        }

        .search-box i {
            color: var(--primary-color);
        }

        .faq-category {
            margin-bottom: 3rem;
        }

        .category-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid var(--primary-color);
            display: inline-block;
        }

        .accordion-item {
            border: none;
            margin-bottom: 1rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .accordion-item:hover {
            box-shadow: 0 5px 20px rgba(197, 44, 38, 0.1);
            transform: translateY(-2px);
        }

        .accordion-button {
            background-color: var(--light-color);
            color: var(--secondary-color);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
            font-size: 1.05rem;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--primary-color);
            color: var(--light-color);
            box-shadow: none;
        }

        .accordion-button:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(197, 44, 38, 0.25);
        }

        .accordion-button::after {
            filter: brightness(0) saturate(100%);
        }

        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) saturate(100%) invert(100%);
        }

        .accordion-body {
            padding: 1.5rem;
            background-color: var(--light-color);
            color: var(--secondary-color);
            line-height: 1.7;
        }

        .contact-support {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 3rem 0;
            margin-top: 3rem;
            border-radius: 15px;
        }

        .support-icon {
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

        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--light-color);
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #a32420;
            border-color: #a32420;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(197, 44, 38, 0.3);
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: var(--secondary-color);
            opacity: 0.6;
        }

        .no-results i {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
</style>
@endsection

@section('script_faq')
<!-- Search Functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const faqItems = document.querySelectorAll('.accordion-item');
            const categories = document.querySelectorAll('.faq-category');
            const noResults = document.getElementById('noResults');
            let hasResults = false;

            faqItems.forEach(function(item) {
                const questionText = item.getAttribute('data-question');
                const accordionButton = item.querySelector('.accordion-button');
                const accordionBody = item.querySelector('.accordion-body');
                const fullText = (questionText + ' ' + accordionButton.textContent + ' ' + accordionBody.textContent).toLowerCase();

                if (fullText.includes(searchTerm)) {
                    item.style.display = 'block';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide categories based on visible items
            categories.forEach(function(category) {
                const visibleItems = category.querySelectorAll('.accordion-item[style="display: block"]');
                if (visibleItems.length > 0) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (searchTerm !== '' && !hasResults) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        });
    </script>
@endsection
