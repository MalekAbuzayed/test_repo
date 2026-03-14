@extends('user.layouts.app')

@section('styles')
    <style>
        .landing-page {
            background: #fff;
            color: #111;
        }

        .landing-page .section-anchor {
            scroll-margin-top: 110px;
        }

        .landing-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #111;
        }

        .landing-hero video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.58;
        }

        .landing-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.36), rgba(0, 0, 0, 0.76));
        }

        .landing-hero__content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            padding: 0 1.5rem;
            text-align: center;
            color: #fff;
        }

        .landing-eyebrow {
            display: inline-block;
            margin-bottom: 1rem;
            color: #c8102e;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.34em;
            text-transform: uppercase;
        }

        .landing-title {
            margin: 0;
            font-family: "Bebas Neue", sans-serif;
            font-size: clamp(4.6rem, 14vw, 11rem);
            line-height: 0.9;
            letter-spacing: 0.06em;
            text-shadow: 0 0 80px rgba(200, 16, 46, 0.28);
        }

        .landing-subtitle {
            margin-top: 1rem;
            font-size: clamp(1.08rem, 2.4vw, 1.55rem);
            font-weight: 300;
            color: rgba(255, 255, 255, 0.86);
        }

        .landing-desc {
            max-width: 620px;
            margin: 1rem auto 2.25rem;
            font-size: 1rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.68);
        }

        .landing-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2.4rem;
            background: #c8102e;
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: none;
            box-shadow: 0 10px 34px rgba(200, 16, 46, 0.35);
            transition: background .24s ease, transform .2s ease, box-shadow .24s ease;
        }

        .landing-btn:hover {
            color: #fff;
            background: #a00c24;
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(200, 16, 46, 0.42);
        }

        .scroll-indicator {
            position: absolute;
            z-index: 1;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 0.65rem;
        }

        .scroll-line {
            width: 2px;
            height: 48px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), transparent);
            animation: scrollPulse 2s ease-in-out infinite;
        }

        @keyframes scrollPulse {

            0%,
            100% {
                opacity: 0.4;
                transform: scaleY(1);
            }

            50% {
                opacity: 1;
                transform: scaleY(1.15);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .landing-section {
            padding: 8rem 0;
        }

        .landing-section--muted {
            background: #f5f5f3;
        }

        .section-inner {
            width: min(1280px, 92%);
            margin: 0 auto;
        }

        .section-tag {
            margin-bottom: 0.75rem;
            color: #c8102e;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3em;
            text-transform: uppercase;
        }

        .section-title {
            max-width: 720px;
            margin: 0;
            color: #111;
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 800;
            line-height: 1.15;
        }

        .about-grid-triss,
        .products-preview-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 3rem 5rem;
            align-items: center;
        }

        .about-copy p,
        .products-preview-copy p {
            margin: 0 0 1.15rem;
            color: #6b6b6b;
            line-height: 1.85;
            font-size: 1.02rem;
        }

        .about-link,
        .section-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #c8102e;
            font-weight: 700;
        }

        .about-link:hover,
        .section-link:hover {
            color: #a00c24;
        }

        .about-media {
            position: relative;
            min-height: 460px;
            overflow: hidden;
            background: linear-gradient(135deg, #e8e8e6, #d0d0cc);
        }

        .about-media::before,
        .news-card__image::before {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(45deg, transparent, transparent 8px, rgba(0, 0, 0, 0.025) 8px, rgba(0, 0, 0, 0.025) 9px);
        }

        .about-media__label {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(0, 0, 0, 0.3);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.24em;
            text-transform: uppercase;
        }

        .about-media__bar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60%;
            height: 3px;
            background: #c8102e;
        }

        .stats-grid-triss {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 2rem;
            padding-top: 3rem;
            margin-top: 4rem;
            border-top: 1px solid #ebebeb;
        }

        .stat-value {
            color: #c8102e;
            font-family: "Bebas Neue", sans-serif;
            font-size: 4rem;
            line-height: 1;
        }

        .stat-copy {
            color: #111;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .preview-cards {
            display: grid;
            gap: 1.25rem;
        }

        .preview-card {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1.25rem 1.4rem;
            background: #fff;
            border: 1px solid rgba(17, 17, 17, 0.08);
        }

        .preview-card__index {
            color: #c8102e;
            font-family: "Bebas Neue", sans-serif;
            font-size: 2rem;
            letter-spacing: 0.08em;
        }

        .preview-card h3 {
            margin: 0 0 0.25rem;
            font-size: 1.1rem;
        }

        .preview-card p {
            margin: 0;
            color: #6b6b6b;
            line-height: 1.7;
            font-size: 0.94rem;
        }

        .preview-card__cta {
            color: #c8102e;
            font-weight: 700;
        }

        .news-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .news-grid-triss {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
        }

        .news-card {
            display: flex;
            flex-direction: column;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .news-card__image {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(135deg, #e4e4e2, #d0d0cc);
        }

        .news-card__badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 1;
            padding: 0.34rem 0.7rem;
            background: #fff;
            color: #111;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .news-card__body {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 2rem;
        }

        .news-card time {
            margin-bottom: 0.75rem;
            color: #6b6b6b;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .news-card h3 {
            margin: 0 0 0.75rem;
            font-size: 1.1rem;
            line-height: 1.45;
        }

        .news-card p {
            flex: 1;
            margin: 0 0 1.15rem;
            color: #6b6b6b;
            font-size: 0.92rem;
            line-height: 1.75;
        }

        .news-card a {
            color: #c8102e;
            font-weight: 700;
        }

        .contact-band {
            padding: 2rem 0 0;
        }

        .contact-band__grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .contact-band__card {
            padding: 1.4rem 1.5rem;
            background: #fff;
            border: 1px solid rgba(17, 17, 17, 0.08);
        }

        .contact-band__label {
            display: block;
            margin-bottom: 0.45rem;
            color: #c8102e;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .contact-band__card a,
        .contact-band__card p {
            margin: 0;
            color: #111;
            line-height: 1.8;
        }

        @media (max-width: 980px) {

            .about-grid-triss,
            .products-preview-grid,
            .news-grid-triss,
            .contact-band__grid {
                grid-template-columns: 1fr;
            }

            .stats-grid-triss {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .landing-section {
                padding: 5.5rem 0;
            }

            .stats-grid-triss {
                grid-template-columns: 1fr;
            }

            .preview-card {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <main class="landing-page">
        <section class="landing-hero section-anchor" id="home">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('style_files/user/7mb-about-us.mp4') }}" type="video/mp4" />
            </video>

            <div class="landing-hero__content reveal">
                <p class="landing-eyebrow">Exclusive GoodWe Partner</p>
                <h1 class="landing-title">TRISS</h1>
                <p class="landing-subtitle">GoodWe exclusive agent in the Middle East</p>
                <p class="landing-desc">
                    Powering the future of solar energy across the region with premium inverter solutions, technical
                    support, and market expertise tailored to demanding conditions.
                </p>
                <a href="#products" class="landing-btn">Explore Our Solutions</a>
            </div>
            <a href="#about">
                <div class="scroll-indicator">
                    <span>Scroll</span>

                    <div class="scroll-line"></div>

                </div>
            </a>
        </section>

        <section class="landing-section section-anchor" id="about">
            <div class="section-inner">
                <div class="reveal">
                    <p class="section-tag">About Triss</p>
                    <h2 class="section-title">Accelerating the Middle East's transition to resilient solar energy.</h2>
                </div>

                <div class="about-grid-triss">
                    <div class="about-copy reveal">
                        <p>
                            As the exclusive GoodWe agent for the Middle East, Triss connects world-class inverter
                            technology with installers, developers, and energy teams that need dependable performance.
                        </p>
                        <p>
                            Our role goes beyond distribution. We support project planning, product selection, technical
                            onboarding, and after-sales guidance so systems deliver long-term value in the field.
                        </p>
                        <p>
                            With regional experience across residential, commercial, and utility-scale deployments, we
                            help partners build solar infrastructure that is efficient, serviceable, and ready for
                            growth.
                        </p>
                        <a class="about-link" href="{{ route('about') }}">Learn more about our company</a>
                    </div>

                    <div class="reveal">
                        <div class="about-media">
                            <div class="about-media__label">Regional Solar Deployment Network</div>
                            <div class="about-media__bar"></div>
                        </div>
                    </div>
                </div>

                <div class="stats-grid-triss">
                    <div class="reveal">
                        <div class="stat-value">10+</div>
                        <div class="stat-copy">Years of Experience</div>
                    </div>
                    <div class="reveal">
                        <div class="stat-value">15</div>
                        <div class="stat-copy">Countries Served</div>
                    </div>
                    <div class="reveal">
                        <div class="stat-value">5K+</div>
                        <div class="stat-copy">Installations Supported</div>
                    </div>
                    <div class="reveal">
                        <div class="stat-value">99%</div>
                        <div class="stat-copy">Partner Satisfaction</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section landing-section--muted section-anchor" id="products">
            <div class="section-inner">
                <div class="products-preview-grid">
                    <div class="products-preview-copy reveal">
                        <p class="section-tag">Solutions</p>
                        <h2 class="section-title">A focused product portfolio for projects that demand proven hardware.</h2>
                        <p>
                            Browse GoodWe inverter and storage solutions through a route-aware catalog built for
                            technical buyers, procurement teams, and installers.
                        </p>
                        <p>
                            The landing page keeps this section lightweight while the full products experience remains in
                            the existing catalog and product-detail flows.
                        </p>
                        <a class="section-link" href="{{ route('products') }}">Open the full products catalog</a>
                    </div>

                    <div class="preview-cards reveal">
                        <article class="preview-card">
                            <div class="preview-card__index">01</div>
                            <div>
                                <h3>Residential inverters</h3>
                                <p>Compact, efficient systems for homes that need stable output and smart monitoring.</p>
                            </div>
                            <a class="preview-card__cta" href="{{ route('products') }}">View</a>
                        </article>

                        <article class="preview-card">
                            <div class="preview-card__index">02</div>
                            <div>
                                <h3>Commercial and industrial</h3>
                                <p>Scalable solutions built for business continuity, site efficiency, and easier fleet
                                    management.</p>
                            </div>
                            <a class="preview-card__cta" href="{{ route('products') }}">View</a>
                        </article>

                        <article class="preview-card">
                            <div class="preview-card__index">03</div>
                            <div>
                                <h3>Storage and utility support</h3>
                                <p>Project-ready systems for larger installations, storage integration, and future
                                    expansion.</p>
                            </div>
                            <a class="preview-card__cta" href="{{ route('download.center') }}">Specs</a>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section landing-section--muted section-anchor" id="news">
            <div class="section-inner">
                <div class="news-header">
                    <div class="reveal">
                        <p class="section-tag">Insights</p>
                        <h2 class="section-title">Latest News</h2>
                    </div>
                    <div class="reveal">
                        <a class="section-link" href="{{ route('about') }}">More company information</a>
                    </div>
                </div>

                <div class="news-grid-triss">
                    <article class="news-card reveal">
                        <div class="news-card__image">
                            <span class="news-card__badge">Expansion</span>
                        </div>
                        <div class="news-card__body">
                            <time datetime="2026-01-15">January 15, 2026</time>
                            <h3>Triss expands GoodWe distribution support in Saudi Arabia</h3>
                            <p>
                                Regional warehousing and technical support capacity continue to grow to serve faster
                                project delivery across major GCC markets.
                            </p>
                            <a href="{{ route('contact_us') }}">Ask about regional support</a>
                        </div>
                    </article>

                    <article class="news-card reveal">
                        <div class="news-card__image">
                            <span class="news-card__badge">Product News</span>
                        </div>
                        <div class="news-card__body">
                            <time datetime="2026-02-03">February 3, 2026</time>
                            <h3>GoodWe HT series availability improves for commercial solar projects</h3>
                            <p>
                                Larger projects can now source more efficiently through a broader regional supply path
                                and coordinated technical onboarding.
                            </p>
                            <a href="{{ route('products') }}">Browse product lines</a>
                        </div>
                    </article>

                    <article class="news-card reveal">
                        <div class="news-card__image">
                            <span class="news-card__badge">Partnerships</span>
                        </div>
                        <div class="news-card__body">
                            <time datetime="2026-03-05">March 5, 2026</time>
                            <h3>Triss strengthens installer partnerships across the UAE</h3>
                            <p>
                                New collaboration efforts are focused on shortening deployment cycles and improving
                                post-installation service quality.
                            </p>
                            <a href="{{ route('contact_us') }}">Contact the partnerships team</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="contact-band section-anchor" id="contact">
            <div class="section-inner">
                <div class="contact-band__grid">
                    <div class="contact-band__card reveal">
                        <span class="contact-band__label">Call</span>
                        <a href="tel:+96264163824">06 4163824</a>
                    </div>
                    <div class="contact-band__card reveal">
                        <span class="contact-band__label">Email</span>
                        <a href="mailto:info@energymagic.net">info@energymagic.net</a>
                    </div>
                    <div class="contact-band__card reveal">
                        <span class="contact-band__label">Visit</span>
                        <p>Wasfi Al-Tall St., Al-Faysaliya Complex, 3rd floor, office 301</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
