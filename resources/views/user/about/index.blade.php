@extends('user.layouts.app')

@section('content')
<style>
        :root {
            --primary-color: #c52c26;
            --secondary-color: #555555;
            --light-color: #fff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--secondary-color);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--secondary-color);
            opacity: 0.8;
            margin-bottom: 2rem;
        }

        .bg-primary-custom {
            background-color: var(--primary-color);
        }

        .text-primary-custom {
            color: var(--primary-color);
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--light-color);
        }

        .btn-primary-custom:hover {
            background-color: #a32420;
            border-color: #a32420;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }

        .goal-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .goal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(197, 44, 38, 0.15);
        }

        .team-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .team-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            margin-bottom: 1rem;
        }

        .vision-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, #a32420 100%);
            color: var(--light-color);
            border-radius: 15px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .vision-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
</style>
<!-- Who We Are Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="icon-box">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h2 class="section-title display-5">Who We Are</h2>
                    <p class="section-subtitle fs-5">Innovating the Future of Technology</p>
                </div>
                <div class="col-lg-6">
                    <p class="lead mb-3">
                        We are a cutting-edge technology platform dedicated to transforming the way businesses operate in the digital age. Our team of passionate innovators combines expertise in software development, design, and strategy to deliver solutions that matter.
                    </p>
                    <p class="mb-0">
                        Founded with a mission to bridge the gap between traditional business practices and modern technology, we empower organizations to achieve their full potential through intelligent automation, seamless integration, and user-centric design. Our commitment to excellence drives every project we undertake.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Vision Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="vision-box shadow-lg">
                        <div class="text-center position-relative">
                            <i class="bi bi-lightbulb display-1 mb-3 opacity-75"></i>
                            <h2 class="display-5 fw-bold mb-4">Our Vision</h2>
                            <p class="lead mb-4 fs-4">
                                To become the world's most trusted technology partner, empowering businesses and individuals to unlock their full potential through innovative, scalable, and sustainable digital solutions.
                            </p>
                            <p class="fs-5 mb-0 opacity-90">
                                We envision a future where technology seamlessly integrates into every aspect of life, making it simpler, more efficient, and more meaningful. Our goal is to be at the forefront of this transformation, leading with integrity, creativity, and unwavering commitment to our clients' success.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Goals Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">Our Goals</h2>
                <p class="section-subtitle fs-5">What We Strive to Achieve</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card goal-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-3">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <h5 class="card-title text-primary-custom fw-bold mb-3">Excellence</h5>
                            <p class="card-text">Deliver the highest quality solutions that exceed expectations and set industry standards.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card goal-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5 class="card-title text-primary-custom fw-bold mb-3">Collaboration</h5>
                            <p class="card-text">Foster strong partnerships with clients, working together to achieve shared success.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card goal-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-3">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <h5 class="card-title text-primary-custom fw-bold mb-3">Growth</h5>
                            <p class="card-text">Drive continuous innovation and growth for our clients and our organization.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card goal-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-3">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h5 class="card-title text-primary-custom fw-bold mb-3">Integrity</h5>
                            <p class="card-text">Maintain transparency, honesty, and ethical practices in everything we do.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet Our Team Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">Meet Our Team</h2>
                <p class="section-subtitle fs-5">The Brilliant Minds Behind Our Success</p>
            </div>

            <div class="row g-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card team-card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&size=150&background=c52c26&color=fff&bold=true" alt="Sarah Johnson" class="team-img">
                            <h5 class="card-title fw-bold text-primary-custom mb-1">Sarah Johnson</h5>
                            <p class="text-muted mb-3 fw-semibold">CEO & Founder</p>
                            <p class="card-text small">Visionary leader with 15+ years in tech innovation, driving our mission to transform digital experiences.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card team-card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://ui-avatars.com/api/?name=Michael+Chen&size=150&background=c52c26&color=fff&bold=true" alt="Michael Chen" class="team-img">
                            <h5 class="card-title fw-bold text-primary-custom mb-1">Michael Chen</h5>
                            <p class="text-muted mb-3 fw-semibold">CTO</p>
                            <p class="card-text small">Technology expert leading our engineering team with cutting-edge solutions and architectural excellence.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card team-card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://ui-avatars.com/api/?name=Emily+Rodriguez&size=150&background=c52c26&color=fff&bold=true" alt="Emily Rodriguez" class="team-img">
                            <h5 class="card-title fw-bold text-primary-custom mb-1">Emily Rodriguez</h5>
                            <p class="text-muted mb-3 fw-semibold">Head of Design</p>
                            <p class="card-text small">Creative genius crafting beautiful, user-centered experiences that delight and inspire our clients.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card team-card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://ui-avatars.com/api/?name=David+Kumar&size=150&background=c52c26&color=fff&bold=true" alt="David Kumar" class="team-img">
                            <h5 class="card-title fw-bold text-primary-custom mb-1">David Kumar</h5>
                            <p class="text-muted mb-3 fw-semibold">Operations Director</p>
                            <p class="card-text small">Operations mastermind ensuring seamless delivery and exceptional client satisfaction across all projects.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
