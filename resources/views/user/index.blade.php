@extends('user.layouts.app')
@section('content')
    <!-- ================== HERO / SLIDER ================== -->
    <main id="home" class="hero section-anchor">
        <div class="hero-slider" id="heroSlider">

            <div class="hero-slide active"
                style="background-image:url('https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=2000&auto=format&fit=crop');">
            </div>

            <div class="hero-slide"
                style="background-image:url('https://images.unsplash.com/photo-1521618755572-156ae0cdd74d?q=80&w=2000&auto=format&fit=crop');">
            </div>

            <div class="hero-slide"
                style="background-image:url('https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?q=80&w=2000&auto=format&fit=crop');">
            </div>

            <div class="hero-overlay"></div>

            <div class="container hero-content reveal">
                <h1 id="heroTitle">Save Money. Save the<br />Planet.</h1>
                <p id="heroSubtitle">Reduce electricity bills with efficient solar systems.</p>

                <div class="hero-actions">
                    <a id="heroBtn" class="btn btn-lg" href="#services">Explore Services</a>
                </div>

                <div class="hero-dots" id="heroDots" aria-label="Slider dots">
                    <button class="dot active" aria-label="Slide 1"></button>
                    <button class="dot" aria-label="Slide 2"></button>
                    <button class="dot" aria-label="Slide 3"></button>
                </div>
            </div>
        </div>


    </main>

    <!-- ================== ABOUT ================== -->
    <section id="about" class="section section-anchor">
        <div class="container about-grid">

            <div class="about-left reveal">
                <div class="eyebrow">ABOUT US</div>
                <h2>About Energy Magic</h2>

                <p class="about-text">
                    Energy Magic provides reliable solar systems for residential and commercial customers,
                    combining expert installation, quality equipment, and long-term support. Our mission is
                    to make clean energy accessible to everyone while delivering exceptional service and
                    guaranteed performance.
                </p>

                <p class="about-text">
                    With over a decade of experience in the renewable energy sector, we've helped thousands
                    of customers transition to solar power, reducing their carbon footprint and saving
                    significantly on energy costs. Our certified team uses only the highest quality panels
                    and equipment, backed by comprehensive warranties and ongoing support.
                </p>

                <div class="about-cards">
                    <div class="small-card">
                        <div class="small-icon">✳</div>
                        <h4>Professional Installers</h4>
                        <p>Licensed professionals with years of expertise</p>
                    </div>

                    <div class="small-card">
                        <div class="small-icon">☀</div>
                        <h4>High-Efficiency Panels</h4>
                        <p>Premium equipment for maximum energy output</p>
                    </div>

                    <div class="small-card">
                        <div class="small-icon">🛠</div>
                        <h4>Monitoring & Maintenance</h4>
                        <p>24/7 system monitoring and expert support</p>
                    </div>
                </div>

                <a class="btn btn-outline pill-btn" href="#services">Learn
                    More</a><!--this link should point to about us page-->
            </div>

            <div class="about-right reveal">
                <div class="about-image-wrap">
                    <img src="https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=1600&auto=format&fit=crop"
                        alt="Solar panel installation" />

                    <!-- TOP RIGHT badge -->
                    <div class="badge badge-top">
                        <div>
                            <div class="badge-big"><span class="count" data-count="1111">0</span>+</div>
                            <div class="badge-sub">Happy Customers</div>
                        </div>
                    </div>

                    <!-- BOTTOM LEFT badge -->
                    <div class="badge badge-bottom">

                        <div>
                            <div class="badge-big"><span class="count" data-count="20">0</span>+</div>
                            <div class="badge-sub">Years Experience</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Red Stats Band -->
        <div class="stats-band reveal">
            <div class="container stats-grid">
                <div class="stat">
                    <div class="stat-num"><span class="count" data-count="1111">0</span>+</div>
                    <div class="stat-label">Installations</div>
                </div>
                <div class="stat">
                    <div class="stat-num"><span class="count" data-count="2000">0</span>KWP</div>
                    <div class="stat-label">Energy Generated For Home Installations</div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================== CLIENTS ================== -->
    <section id="clients" class="section section-anchor">
        <div class="container center reveal">
            <div class="eyebrow">OUR CLIENTS</div>
            <h2>Trusted by Our Clients</h2>
            <p class="subtext">
                Join thousands of satisfied customers who have made the switch to clean, renewable solar energy.
            </p>
        </div>

        <div class="container reveal">
            <div class="partners-card">
                <h3>Our Trusted Partners</h3>
                <div class="partners-row">
                    <span class="partner">وزارة الأوقاف</span>
                    <span class="partner">وزارة التربية والتعليم</span>
                    <span class="partner">جامعة الإسراء</span>
                    <span class="partner">سلسلة محامص كابولي</span>
                    <span class="partner">مجلس الأعيان</span>
                    <span class="partner">LE VENDOME HOTEL</span>
                    <span class="partner">CROWN ACADEMY</span>
                    <span class="partner">BVLGARI</span>
                </div>
            </div>
        </div>
    </section>


    <!-- ================== FINAL CTA ================== -->
    <section class="final-cta reveal">
        <div class="final-pattern"></div>

        <div class="container final-inner">
            <h2>Start Your Solar Journey Today</h2>
            <p>
                Join thousands of satisfied customers who are saving money and helping the planet.
                Get your free consultation and custom quote today.
            </p>

            <div class="final-actions">
                <a class="btn btn-outline-white btn-lg" href="tel:+15551234567">Call (06) 4163824</a>
            </div>

            <div class="final-metrics">
                <div class="final-metric">
                    <div class="final-num">$0</div>
                    <div class="final-label">Placeholder</div>
                </div>
                <div class="final-metric">
                    <div class="final-num"><span class="count" data-count="30">0</span>%</div>
                    <div class="final-label">Placeholder</div>
                </div>
                <div class="final-metric">
                    <div class="final-num"><span class="count" data-count="30">0</span> Years</div>
                    <div class="final-label">Panel Warranty</div>
                </div>
            </div>
        </div>
    </section>
@endsection
