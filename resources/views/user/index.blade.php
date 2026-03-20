@extends('user.layouts.app')

@section('styles')
    <style>
        .landing-page {
            background: #fff;
            color: #111
        }

        .landing-page .section-anchor {
            scroll-margin-top: 110px
        }

        .landing-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #111
        }

        .landing-hero video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: .58
        }

        .landing-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, .36), rgba(0, 0, 0, .76))
        }

        .landing-hero__content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            padding: 0 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff
        }

        .landing-eyebrow {
            display: inline-block;
            margin-bottom: 1rem;
            color: #c8102e;
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .34em;
            text-transform: uppercase
        }

        .landing-title {
            margin: 0;
            font-family: "Bebas Neue", sans-serif;
            font-size: clamp(4.6rem, 14vw, 11rem);
            line-height: .9;
            letter-spacing: .06em;
            text-shadow: 0 0 80px rgba(200, 16, 46, .28)
        }

        .landing-subtitle {
            margin-top: 1rem;
            font-size: clamp(1.08rem, 2.4vw, 1.55rem);
            font-weight: 300;
            color: rgba(255, 255, 255, .86)
        }

        .landing-desc {
            max-width: 620px;
            margin: 1rem auto 2.25rem;
            font-size: 1rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, .68)
        }

        .landing-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2.4rem;
            background: #c8102e;
            color: #fff;
            font-weight: 700;
            letter-spacing: .03em;
            box-shadow: 0 10px 34px rgba(200, 16, 46, .35);
            transition: background .24s ease, transform .2s ease, box-shadow .24s ease
        }

        .landing-btn:hover {
            color: #fff;
            background: #a00c24;
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(200, 16, 46, .42)
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
            gap: .5rem;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .2em;
            font-size: .65rem
        }

        .scroll-line {
            width: 2px;
            height: 48px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, .6), transparent);
            animation: scrollPulse 2s ease-in-out infinite
        }

        @keyframes scrollPulse {

            0%,
            100% {
                opacity: .4;
                transform: scaleY(1)
            }

            50% {
                opacity: 1;
                transform: scaleY(1.15)
            }
        }

        .landing-section {
            padding: 8rem 0
        }

        .landing-section--muted {
            background: #f5f5f3
        }

        .section-inner {
            width: min(1280px, 92%);
            margin: 0 auto
        }

        .section-tag {
            margin-bottom: .75rem;
            color: #c8102e;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .3em;
            text-transform: uppercase
        }

        .section-title {
            margin: 0;
            color: #111;
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 800;
            line-height: 1.15
        }

        .about {
            padding: 8rem 0;
            background: #fff
        }

        .about-header {
            margin-bottom: 5rem
        }

        .about-header .section-title {
            max-width: 700px
        }

        .about-grid,
        .products-preview-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 4rem 6rem;
            align-items: center
        }

        .about-text p,
        .products-preview-copy p {
            margin: 0 0 1.15rem;
            color: #6b6b6b;
            line-height: 1.85;
            font-size: 1.02rem
        }

        .about-link,
        .section-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: #c8102e;
            font-weight: 700;
            transition: color .2s ease, gap .2s ease
        }

        .about-link:hover,
        .section-link:hover {
            color: #a00c24;
            gap: .75rem
        }

        .about-image {
            position: relative;
            height: 480px;
            overflow: hidden;
            background: #111
        }

        .about-image::before {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(45deg, transparent, transparent 8px, rgba(0, 0, 0, .022) 8px, rgba(0, 0, 0, .022) 9px);
            z-index: 1;
            pointer-events: none
        }

        .about-img-track {
            display: flex;
            height: 100%;
            transition: transform .7s cubic-bezier(.25, .46, .45, .94);
            will-change: transform
        }

        .about-img-slide {
            position: relative;
            width: 100%;
            height: 100%;
            flex-shrink: 0;
            background: linear-gradient(145deg, #ddddd9 0%, #c4c4c0 100%)
        }

        .about-img-slide--placeholder:nth-child(2) {
            background: linear-gradient(145deg, #d0d8e0 0%, #b8c4cc 100%)
        }

        .about-img-slide--placeholder:nth-child(3) {
            background: linear-gradient(145deg, #d8d4d0 0%, #c0bbb8 100%)
        }

        .about-img-slide--placeholder:nth-child(4) {
            background: linear-gradient(145deg, #d4dcd4 0%, #bcc8bc 100%)
        }

        .about-img-slide img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .about-img-label {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 2rem;
            color: rgba(0, 0, 0, .28);
            font-size: .7rem;
            font-weight: 500;
            letter-spacing: .25em;
            text-align: center;
            text-transform: uppercase;
            z-index: 2
        }

        .about-img-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem 1.5rem 1rem;
            background: linear-gradient(to top, rgba(0, 0, 0, .55) 0%, transparent 100%);
            z-index: 5
        }

        .about-img-caption-text {
            font-size: .8rem;
            font-weight: 500;
            color: rgba(255, 255, 255, .85);
            letter-spacing: .08em
        }

        .about-img-caption-sub {
            margin-top: .1rem;
            font-size: .7rem;
            font-weight: 300;
            color: rgba(255, 255, 255, .5)
        }

        .about-image-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: #c8102e;
            z-index: 10;
            transition: width 4.8s linear
        }

        .about-img-arrows {
            position: absolute;
            top: 50%;
            right: 1rem;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: .4rem;
            transform: translateY(-50%)
        }

        .about-img-btn {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            transition: background .2s ease, border-color .2s ease
        }

        .about-img-btn:hover {
            background: #c8102e;
            border-color: #c8102e
        }

        .about-img-btn svg {
            width: 14px;
            height: 14px
        }

        .about-img-dots {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            display: flex;
            gap: .35rem;
            z-index: 10
        }

        .about-img-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .35);
            border: none;
            cursor: pointer;
            padding: 0;
            transition: background .25s ease, transform .25s ease
        }

        .about-img-dot.active {
            background: #c8102e;
            transform: scale(1.5)
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 2rem;
            padding-top: 3.5rem;
            margin-top: 3rem;
            border-top: 1px solid #ebebeb
        }

        .stat-value {
            color: #c8102e;
            font-family: "Bebas Neue", sans-serif;
            font-size: 4rem;
            line-height: 1;
            letter-spacing: .02em;
            margin-bottom: .4rem
        }

        .stat-label {
            color: #111;
            font-size: .8rem;
            font-weight: 500;
            letter-spacing: .1em;
            text-transform: uppercase
        }

        .preview-cards {
            display: grid;
            gap: 1.25rem
        }

        .preview-card {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1.25rem 1.4rem;
            background: #fff;
            border: 1px solid rgba(17, 17, 17, .08)
        }

        .preview-card__index {
            color: #c8102e;
            font-family: "Bebas Neue", sans-serif;
            font-size: 2rem;
            letter-spacing: .08em
        }

        .preview-card h3 {
            margin: 0 0 .25rem;
            font-size: 1.1rem
        }

        .preview-card p {
            margin: 0;
            color: #6b6b6b;
            line-height: 1.7;
            font-size: .94rem
        }

        .preview-card__cta {
            color: #c8102e;
            font-weight: 700
        }

        .news {
            padding: 8rem 0;
            background: #f5f5f3
        }

        .news-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 3rem
        }

        .news-controls {
            display: flex;
            align-items: center;
            gap: 1.5rem
        }

        .news-link {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            color: #111;
            font-weight: 500;
            text-decoration: none;
            font-size: .875rem;
            transition: color .2s ease, gap .2s ease;
            white-space: nowrap
        }

        .news-link:hover {
            color: #c8102e;
            gap: .65rem
        }

        .news-link svg {
            width: 15px;
            height: 15px
        }

        .slider-arrows {
            display: flex;
            gap: .5rem
        }

        .slider-btn {
            width: 40px;
            height: 40px;
            background: #fff;
            border: 1px solid #ebebeb;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease, color .2s ease;
            color: #111;
            flex-shrink: 0
        }

        .slider-btn:hover {
            background: #111;
            border-color: #111;
            color: #fff
        }

        .slider-btn.disabled {
            opacity: .3;
            pointer-events: none
        }

        .slider-btn svg {
            width: 16px;
            height: 16px
        }

        .slider-viewport {
            overflow: hidden
        }

        .slider-track {
            display: flex;
            gap: 1.5rem;
            transition: transform .5s cubic-bezier(.25, .46, .45, .94);
            will-change: transform
        }

        .slider-track .card {
            flex-shrink: 0;
            width: var(--slide-w, 380px)
        }

        .slider-dots {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-top: 2.5rem
        }

        .slider-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #e8e8e6;
            border: none;
            cursor: pointer;
            padding: 0;
            transition: background .25s ease, transform .25s ease
        }

        .slider-dot.active {
            background: #c8102e;
            transform: scale(1.4)
        }

        .card {
            background: #fff;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, .06);
            display: flex;
            flex-direction: column;
            transition: box-shadow .3s ease, transform .3s ease
        }

        .card:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, .1);
            transform: translateY(-4px)
        }

        .card-img {
            height: 200px;
            position: relative;
            background: linear-gradient(135deg, #e4e4e2, #d0d0cc);
            overflow: hidden;
            flex-shrink: 0
        }

        .card-img::before {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(0, 0, 0, .018) 10px, rgba(0, 0, 0, .018) 11px)
        }

        .card-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #fff;
            color: #111;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            padding: .3rem .65rem;
            z-index: 2
        }

        .card-body {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column
        }

        .card-date {
            font-size: .8rem;
            color: #6b6b6b;
            font-weight: 500;
            margin-bottom: .75rem
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111;
            margin-bottom: .75rem;
            line-height: 1.4;
            transition: color .2s ease
        }

        .card:hover .card-title {
            color: #c8102e
        }

        .card-excerpt {
            font-size: .9rem;
            color: #6b6b6b;
            font-weight: 300;
            line-height: 1.7;
            flex: 1;
            margin-bottom: 1.25rem
        }

        .card-read {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            color: #c8102e;
            font-weight: 500;
            font-size: .875rem;
            text-decoration: none;
            transition: gap .2s ease
        }

        .card-read:hover {
            gap: .65rem
        }

        .card-read svg {
            width: 15px;
            height: 15px
        }

        .contact-band {
            padding: 2rem 0 0
        }

        .contact-band__grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem
        }

        .contact-band__card {
            padding: 1.4rem 1.5rem;
            background: #fff;
            border: 1px solid rgba(17, 17, 17, .08)
        }

        .contact-band__label {
            display: block;
            margin-bottom: .45rem;
            color: #c8102e;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .15em;
            text-transform: uppercase
        }

        .contact-band__card a,
        .contact-band__card p {
            margin: 0;
            color: #111;
            line-height: 1.8
        }

        @media (max-width:980px) {

            .about-grid,
            .products-preview-grid,
            .contact-band__grid {
                grid-template-columns: 1fr
            }
        }

        @media (max-width:900px) {
            .news-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem
            }
        }

        @media (max-width:768px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (max-width:640px) {

            .landing-section,
            .about,
            .news {
                padding: 5.5rem 0
            }

            .stats-grid,
            .contact-band__grid {
                grid-template-columns: 1fr
            }

            .preview-card {
                grid-template-columns: 1fr
            }

            .news-controls {
                width: 100%;
                flex-direction: column;
                align-items: flex-start
            }
        }
    </style>
@endsection

@section('content')
    @php
        $fallbackAboutSlides = collect([
            [
                'label' => 'Solar Installation Facility',
                'title' => 'Solar Installation Facility',
                'subtitle' => 'UAE - Commercial Rooftop',
                'image' => null,
            ],
            [
                'label' => 'GoodWe Regional Warehouse',
                'title' => 'GoodWe Regional Warehouse',
                'subtitle' => 'Dubai Distribution Hub',
                'image' => null,
            ],
            [
                'label' => 'Technical Training Session',
                'title' => 'Installer Training Programme',
                'subtitle' => 'Triss Engineering Team - Dubai',
                'image' => null,
            ],
            [
                'label' => 'Utility Scale Project',
                'title' => 'Utility Scale Project',
                'subtitle' => '50 MW - Riyadh, Saudi Arabia',
                'image' => null,
            ],
        ]);

        $aboutSlides = ($aboutSliders ?? collect())
            ->map(function ($slider) {
                $imagePath = $slider->getRawOriginal('image');

                return [
                    'label' => $slider->title_en ?: 'Triss Project Visual',
                    'title' => $slider->title_en ?: 'Triss Project Visual',
                    'subtitle' => $slider->description_en ?: 'Exclusive GoodWe support across the region.',
                    'image' => $imagePath ? asset($imagePath) : null,
                ];
            })
            ->values();

        if ($aboutSlides->isEmpty()) {
            $aboutSlides = $fallbackAboutSlides;
        }

        $newsCards = [
            [
                'badge' => 'Expansion',
                'date_iso' => '2026-01-15',
                'date_display' => 'Jan 15, 2026',
                'title' => 'Triss Expands GoodWe Distribution to Saudi Arabia',
                'excerpt' =>
                    'Marking a significant milestone in our regional expansion strategy, Triss has officially opened its new distribution hub in Riyadh.',
                'href' => route('contact_us'),
            ],
            [
                'badge' => 'Product News',
                'date_iso' => '2026-02-03',
                'date_display' => 'Feb 03, 2026',
                'title' => 'New GoodWe HT Series Inverters Now Available',
                'excerpt' =>
                    'The highly anticipated HT series, designed specifically for utility-scale commercial projects, is now fully stocked in our UAE warehouse.',
                'href' => route('products'),
            ],
            [
                'badge' => 'Partnerships',
                'date_iso' => '2026-03-12',
                'date_display' => 'Mar 12, 2026',
                'title' => 'Triss Partners with Leading UAE Solar Installers',
                'excerpt' =>
                    'A new strategic alliance aims to streamline the supply chain for commercial solar projects across the Emirates.',
                'href' => route('contact_us'),
            ],
            [
                'badge' => 'Events',
                'date_iso' => '2026-03-18',
                'date_display' => 'Mar 18, 2026',
                'title' => 'Triss at Intersolar Middle East 2026',
                'excerpt' =>
                    'Visit us at Stand B14 at this year\'s Intersolar Middle East in Dubai to see the latest GoodWe product lineup and speak with our technical team.',
                'href' => route('about'),
            ],
            [
                'badge' => 'Training',
                'date_iso' => '2026-02-20',
                'date_display' => 'Feb 20, 2026',
                'title' => 'GoodWe Installer Certification Programme Now Open',
                'excerpt' =>
                    'Triss has launched its 2026 round of GoodWe installer training sessions across Dubai, Riyadh and Cairo. Registration is now open for all partner installers.',
                'href' => route('contact_us'),
            ],
        ];
    @endphp

    <main class="landing-page">
        <section class="landing-hero section-anchor" id="home">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('style_files/user/7mb-about-us.mp4') }}" type="video/mp4" />
            </video>

            <div class="landing-hero__content reveal">
                <p class="landing-eyebrow">Exclusive GoodWe Partner</p>
                <img src="{{ asset('style_files/user/logo.png') }}" alt=""
                    class = "landing-title "style="max-height: 25%; max-width: 25%">
                <p class="landing-subtitle">GoodWe exclusive agent in Jordan</p>
                <p class="landing-desc">
                    Powering the future of solar energy across the region with premium inverter solutions, technical
                    support, and market expertise tailored to demanding conditions.
                </p>
                <a href="#products" class="landing-btn">Explore Our Solutions</a>
            </div>

            <a href="#about" aria-label="Scroll to About section">
                <div class="scroll-indicator">
                    <span>Scroll</span>
                    <div class="scroll-line"></div>
                </div>
            </a>
        </section>

        <section class="about section-anchor" id="about">
            <div class="section-inner">
                <div class="about-header reveal">
                    <p class="section-tag">About Triss</p>
                    <h2 class="section-title">Accelerating the Middle East's transition to sustainable energy.</h2>
                </div>

                <div class="about-grid">
                    <div class="about-text reveal">
                        <p>As the exclusive agent for GoodWe in the Middle East, Triss represents the pinnacle of solar
                            inverter technology. We bridge the gap between world-class manufacturing and regional energy
                            needs.</p>
                        <p>Our mission goes beyond distribution. We provide comprehensive technical support, training, and
                            strategic guidance to ensure every solar installation maximizes its potential yield and
                            lifespan.</p>
                        <p>With a deep understanding of the region's unique climatic challenges and regulatory landscapes,
                            we deliver solutions that are not just efficient, but resilient and future-proof.</p>
                        <a class="about-link" href="{{ route('about') }}">
                            Learn more about our company
                        </a>
                    </div>

                    <div class="reveal">
                        <div class="about-image" id="aboutImgSlider">
                            <div class="about-img-track" id="aboutImgTrack">
                                @foreach ($aboutSlides as $slide)
                                    <div
                                        class="about-img-slide{{ $slide['image'] ? '' : ' about-img-slide--placeholder' }}">
                                        @if ($slide['image'])
                                            <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" loading="lazy">
                                        @endif
                                        <div class="about-img-label">{{ $slide['label'] }}</div>
                                        <div class="about-img-caption">
                                            <div class="about-img-caption-text">{{ $slide['title'] }}</div>
                                            <div class="about-img-caption-sub">{{ $slide['subtitle'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="about-image-bar" id="aboutImgBar"></div>
                            <div class="about-img-arrows">
                                <button class="about-img-btn" id="aboutImgPrev" aria-label="Previous image"><svg
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6" />
                                    </svg></button>
                                <button class="about-img-btn" id="aboutImgNext" aria-label="Next image"><svg
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6" />
                                    </svg></button>
                            </div>
                            <div class="about-img-dots" id="aboutImgDots"></div>
                        </div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="reveal">
                        <div class="stat-value">10+</div>
                        <div class="stat-label">Years of Experience</div>
                    </div>
                    <div class="reveal">
                        <div class="stat-value">15</div>
                        <div class="stat-label">Countries Served</div>
                    </div>
                    <div class="reveal">
                        <div class="stat-value">5K+</div>
                        <div class="stat-label">Installations Completed</div>
                    </div>
                    <div class="reveal">
                        <div class="stat-value">99%</div>
                        <div class="stat-label">Client Satisfaction</div>
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
                        <p>Browse GoodWe inverter and storage solutions through a route-aware catalog built for technical
                            buyers, procurement teams, and installers.</p>
                        <p>The landing page keeps this section lightweight while the full products experience remains in the
                            existing catalog and product-detail flows.</p>
                        <a class="section-link" href="{{ route('products') }}">Open the full products catalog</a>
                    </div>
                    <div class="preview-cards reveal">
                        <article class="preview-card">
                            <div class="preview-card__index">01</div>
                            <div>
                                <h3>Residential inverters</h3>
                                <p>Compact, efficient systems for homes that need stable output and smart monitoring.</p>
                            </div><a class="preview-card__cta" href="{{ route('products') }}">View</a>
                        </article>
                        <article class="preview-card">
                            <div class="preview-card__index">02</div>
                            <div>
                                <h3>Commercial and industrial</h3>
                                <p>Scalable solutions built for business continuity, site efficiency, and easier fleet
                                    management.</p>
                            </div><a class="preview-card__cta" href="{{ route('products') }}">View</a>
                        </article>
                        <article class="preview-card">
                            <div class="preview-card__index">03</div>
                            <div>
                                <h3>Storage and utility support</h3>
                                <p>Project-ready systems for larger installations, storage integration, and future
                                    expansion.</p>
                            </div><a class="preview-card__cta" href="{{ route('download.center') }}">Specs</a>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="news section-anchor" id="news">
            <div class="section-inner">
                <div class="news-header reveal">
                    <div class="news-header-left">
                        <p class="section-tag">Insights</p>
                        <h2 class="section-title" style="max-width:none">Latest News</h2>
                    </div>
                    <div class="news-controls">
                        <a href="{{ route('about') }}" class="news-link">
                            View all news
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                        <div class="slider-arrows">
                            <button class="slider-btn" id="slidePrev" aria-label="Previous"><svg viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6" />
                                </svg></button>
                            <button class="slider-btn" id="slideNext" aria-label="Next"><svg viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg></button>
                        </div>
                    </div>
                </div>
                <div class="slider-viewport" id="sliderViewport">
                    <div class="slider-track" id="sliderTrack">
                        @foreach ($newsCards as $card)
                            <article class="card">
                                <div class="card-img">
                                    <div class="card-badge">{{ $card['badge'] }}</div>
                                </div>
                                <div class="card-body">
                                    <time class="card-date"
                                        datetime="{{ $card['date_iso'] }}">{{ $card['date_display'] }}</time>
                                    <h3 class="card-title">{{ $card['title'] }}</h3>
                                    <p class="card-excerpt">{{ $card['excerpt'] }}</p>
                                    <a href="{{ $card['href'] }}" class="card-read">
                                        Read More
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="slider-dots" id="sliderDots"></div>
            </div>
        </section>

        <section class="contact-band section-anchor" id="contact">
            <div class="section-inner">
                <div class="contact-band__grid">
                    <div class="contact-band__card reveal"><span class="contact-band__label">Call</span><a
                            href="tel:+96264163824">06 4163824</a></div>
                    <div class="contact-band__card reveal"><span class="contact-band__label">Email</span><a
                            href="mailto:info@energymagic.net">info@energymagic.net</a></div>
                    <div class="contact-band__card reveal"><span class="contact-band__label">Visit</span>
                        <p>Wasfi Al-Tall St., Al-Faysaliya Complex, 3rd floor, office 301</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        (function() {
            const track = document.getElementById('aboutImgTrack');
            const bar = document.getElementById('aboutImgBar');
            const btnPrev = document.getElementById('aboutImgPrev');
            const btnNext = document.getElementById('aboutImgNext');
            const dotsWrap = document.getElementById('aboutImgDots');
            const slider = document.getElementById('aboutImgSlider');
            if (!track || !bar || !btnPrev || !btnNext || !dotsWrap || !slider) {
                return
            }
            const slides = Array.from(track.children);
            const total = slides.length;
            const duration = 4800;
            let current = 0;
            let timer = null;
            if (!total) {
                return
            }
            track.style.width = `${total*100}%`;
            slides.forEach((slide) => {
                slide.style.width = `${100/total}%`
            });
            slides.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.className = 'about-img-dot';
                dot.setAttribute('aria-label', `Image ${index+1}`);
                dot.addEventListener('click', () => {
                    goTo(index);
                    resetAuto()
                });
                dotsWrap.appendChild(dot)
            });

            function updateDots() {
                Array.from(dotsWrap.children).forEach((dot, index) => {
                    dot.classList.toggle('active', index === current)
                })
            }

            function animateBar() {
                bar.style.transition = 'none';
                bar.style.width = '0%';
                void bar.offsetWidth;
                bar.style.transition = `width ${duration}ms linear`;
                bar.style.width = '100%'
            }

            function goTo(index) {
                current = (index + total) % total;
                track.style.transform = `translateX(-${current*(100/total)}%)`;
                updateDots();
                animateBar()
            }

            function startAuto() {
                clearInterval(timer);
                timer = setInterval(() => goTo(current + 1), duration)
            }

            function resetAuto() {
                startAuto()
            }
            btnPrev.addEventListener('click', () => {
                goTo(current - 1);
                resetAuto()
            });
            btnNext.addEventListener('click', () => {
                goTo(current + 1);
                resetAuto()
            });
            slider.addEventListener('mouseenter', () => {
                clearInterval(timer);
                const computedWidth = parseFloat(getComputedStyle(bar).width);
                const sliderWidth = slider.offsetWidth || 1;
                bar.style.transition = 'none';
                bar.style.width = `${computedWidth/sliderWidth*100}%`
            });
            slider.addEventListener('mouseleave', resetAuto);
            let touchStart = null;
            slider.addEventListener('touchstart', (event) => {
                touchStart = event.touches[0].clientX
            }, {
                passive: true
            });
            slider.addEventListener('touchend', (event) => {
                if (touchStart === null) {
                    return
                }
                const diff = touchStart - event.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) {
                    goTo(diff > 0 ? current + 1 : current - 1);
                    resetAuto()
                }
                touchStart = null
            });
            goTo(0);
            startAuto()
        })();
        (function() {
            const track = document.getElementById('sliderTrack');
            const viewport = document.getElementById('sliderViewport');
            const btnPrev = document.getElementById('slidePrev');
            const btnNext = document.getElementById('slideNext');
            const dotsWrap = document.getElementById('sliderDots');
            if (!track || !viewport || !btnPrev || !btnNext || !dotsWrap) {
                return
            }
            const GAP = 24;
            let current = 0;
            let perView = 3;
            let slideW = 0;
            const total = track.children.length;
            let autoplayTimer = null;

            function calcSizes() {
                const vw = viewport.offsetWidth;
                perView = vw >= 900 ? 3 : vw >= 580 ? 2 : 1;
                slideW = Math.floor((vw - GAP * (perView - 1)) / perView);
                track.style.setProperty('--slide-w', `${slideW}px`);
                Array.from(track.children).forEach((card) => {
                    card.style.width = `${slideW}px`
                })
            }

            function maxIndex() {
                return Math.max(0, total - perView)
            }

            function goTo(index) {
                current = Math.max(0, Math.min(index, maxIndex()));
                const offset = current * (slideW + GAP);
                track.style.transform = `translateX(-${offset}px)`;
                updateUI()
            }

            function updateUI() {
                btnPrev.classList.toggle('disabled', current === 0);
                btnNext.classList.toggle('disabled', current >= maxIndex());
                const pages = maxIndex() + 1;
                if (dotsWrap.children.length !== pages) {
                    dotsWrap.innerHTML = '';
                    for (let index = 0; index < pages; index++) {
                        const dot = document.createElement('button');
                        dot.className = 'slider-dot';
                        dot.setAttribute('aria-label', `Slide ${index+1}`);
                        dot.addEventListener('click', () => {
                            goTo(index);
                            resetAutoplay()
                        });
                        dotsWrap.appendChild(dot)
                    }
                }
                Array.from(dotsWrap.children).forEach((dot, index) => {
                    dot.classList.toggle('active', index === current)
                })
            }

            function startAutoplay() {
                autoplayTimer = setInterval(() => {
                    goTo(current >= maxIndex() ? 0 : current + 1)
                }, 4500)
            }

            function resetAutoplay() {
                clearInterval(autoplayTimer);
                startAutoplay()
            }
            let dragStart = null;
            track.addEventListener('pointerdown', (event) => {
                dragStart = event.clientX;
                track.setPointerCapture(event.pointerId)
            });
            track.addEventListener('pointerup', (event) => {
                if (dragStart === null) {
                    return
                }
                const diff = dragStart - event.clientX;
                if (Math.abs(diff) > 40) {
                    goTo(diff > 0 ? current + 1 : current - 1);
                    resetAutoplay()
                }
                dragStart = null
            });
            btnPrev.addEventListener('click', () => {
                goTo(current - 1);
                resetAutoplay()
            });
            btnNext.addEventListener('click', () => {
                goTo(current + 1);
                resetAutoplay()
            });
            viewport.addEventListener('mouseenter', () => clearInterval(autoplayTimer));
            viewport.addEventListener('mouseleave', startAutoplay);

            function init() {
                calcSizes();
                current = 0;
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
                requestAnimationFrame(() => {
                    track.style.transition = '';
                    updateUI()
                })
            }
            const resizeObserver = new ResizeObserver(() => {
                init()
            });
            resizeObserver.observe(viewport);
            init();
            startAutoplay()
        })();
    </script>
@endsection
