@extends('user.layouts.app')

@section('styles')
    <style>
        .about-page {
            background: #fff;
            color: #111;
        }

        /* ══════════════════════════
                       SHARED
                    ══════════════════════════ */
        .wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-tag {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: #c8102e;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 700;
            line-height: 1.1;
            color: #111;
            margin: 0;
        }

        /* reveal animations */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        .rd1 {
            transition-delay: 0.1s;
        }

        .rd2 {
            transition-delay: 0.2s;
        }

        .rd3 {
            transition-delay: 0.3s;
        }

        .rx {
            opacity: 0;
            transform: translateX(-28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .rx.visible {
            opacity: 1;
            transform: none;
        }

        .rx-r {
            opacity: 0;
            transform: translateX(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .rx-r.visible {
            opacity: 1;
            transform: none;
        }

        /* image placeholder */
        .img-block {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #e8e8e6 0%, #d4d4d0 100%);
        }

        .img-block::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(45deg, transparent, transparent 8px, rgba(0, 0, 0, 0.022) 8px, rgba(0, 0, 0, 0.022) 9px);
        }

        .img-block-label {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(0, 0, 0, 0.25);
            font-weight: 500;
        }

        .img-accent {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: #c8102e;
        }

        /* ══════════════════════════
                       PAGE HEADER
                    ══════════════════════════ */
        .page-header {

            background: #111;
            padding: 5rem 2rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: 'ABOUT';
            position: absolute;
            right: -1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(8rem, 18vw, 16rem);
            color: rgba(255, 255, 255, 0.035);
            letter-spacing: 0.05em;
            line-height: 1;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        .page-header-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
            margin-bottom: 1.5rem;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.35);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: #c8102e;
        }

        .breadcrumb span {
            color: rgba(255, 255, 255, 0.2);
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 7vw, 6rem);
            line-height: 0.92;
            color: #fff;
            letter-spacing: 0.04em;
            margin: 0 0 1.25rem;
        }

        .page-header h1 em {
            color: #c8102e;
            font-style: normal;
        }

        .page-header-sub {
            color: rgba(255, 255, 255, 0.45);
            font-size: 1rem;
            font-weight: 300;
            max-width: 560px;
            margin: 0;
            line-height: 1.7;
        }

        /* ══════════════════════════
                       SECTION 1 — MISSION
                    ══════════════════════════ */
        .mission {
            padding: 7rem 0;
            background: #fff;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        @media (max-width: 900px) {
            .mission-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
        }

        .mission-text .lead {
            font-size: 1.2rem;
            font-weight: 300;
            color: #111;
            line-height: 1.75;
            margin-bottom: 1.5rem;
            border-left: 3px solid #c8102e;
            padding-left: 1.25rem;
        }

        .mission-text p {
            font-size: 0.975rem;
            color: #6b6b6b;
            font-weight: 300;
            line-height: 1.8;
            margin-bottom: 1.1rem;
        }

        .mission-text p:last-child {
            margin-bottom: 0;
        }

        .mission-image {
            height: 520px;
        }

        .mission-image .img-accent {
            width: 55%;
        }

        /* ══════════════════════════
                       SECTION 2 — STATS BAND
                    ══════════════════════════ */
        .stats-band {
            background: #111;
            padding: 5rem 0;
        }

        .stats-inner {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        @media (max-width: 768px) {
            .stats-inner {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .stat-cell {
            padding: 2.5rem 2rem;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            transition: background 0.3s;
        }

        .stat-cell:last-child {
            border-right: none;
        }

        @media (max-width: 768px) {
            .stat-cell:nth-child(2) {
                border-right: none;
            }

            .stat-cell:nth-child(3) {
                border-right: 1px solid rgba(255, 255, 255, 0.08);
            }

            .stat-cell {
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .stat-cell:nth-child(3),
            .stat-cell:nth-child(4) {
                border-bottom: none;
            }
        }

        .stat-cell:hover {
            background: rgba(200, 16, 46, 0.06);
        }

        .stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 4.5rem;
            color: #c8102e;
            line-height: 1;
            letter-spacing: 0.03em;
        }

        .stat-unit {
            font-size: 1.5rem;
        }

        .stat-lbl {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 0.5rem;
        }

        /* ══════════════════════════
                       SECTION 3 — STORY TIMELINE
                    ══════════════════════════ */
        .story {
            padding: 7rem 0;
            background: #f5f5f3;
        }

        .story-header {
            margin-bottom: 4rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e8e8e6;
        }

        .tl-item {
            position: relative;
            padding: 0 0 3rem 2.5rem;
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 2rem;
        }

        .tl-item:last-child {
            padding-bottom: 0;
        }

        .tl-dot {
            position: absolute;
            left: -7px;
            top: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #e8e8e6;
            transition: border-color 0.3s, background 0.3s;
        }

        .tl-item:hover .tl-dot {
            border-color: #c8102e;
            background: #c8102e;
        }

        .tl-year {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            color: #e8e8e6;
            letter-spacing: 0.05em;
            line-height: 1;
            padding-top: 2px;
            transition: color 0.3s;
        }

        .tl-item:hover .tl-year {
            color: #c8102e;
        }

        .tl-content {}

        .tl-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 0.5rem;
        }

        .tl-text {
            font-size: 0.9rem;
            color: #6b6b6b;
            font-weight: 300;
            line-height: 1.75;
        }

        @media (max-width: 640px) {
            .tl-item {
                grid-template-columns: 80px 1fr;
                gap: 1rem;
            }

            .tl-year {
                font-size: 1.75rem;
            }
        }

        /* ══════════════════════════
                       SECTION 4 — VALUES
                    ══════════════════════════ */
        .values {
            padding: 7rem 0;
            background: #fff;
        }

        .values-header {
            margin-bottom: 4rem;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 900px) {
            .values-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {
            .values-grid {
                grid-template-columns: 1fr;
            }
        }

        .value-card {
            background: #f5f5f3;
            border: 1px solid #ebebeb;
            padding: 2.25rem 2rem;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .value-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #c8102e;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
        }

        .value-card:hover {
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px);
        }

        .value-card:hover::before {
            transform: scaleX(1);
        }

        .value-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 4rem;
            color: #e8e8e6;
            line-height: 1;
            margin-bottom: 0.75rem;
            letter-spacing: 0.02em;
            transition: color 0.3s;
        }

        .value-card:hover .value-number {
            color: rgba(200, 16, 46, 0.15);
        }

        .value-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 0.6rem;
        }

        .value-text {
            font-size: 0.875rem;
            color: #6b6b6b;
            font-weight: 300;
            line-height: 1.75;
        }

        /* ══════════════════════════
                       SECTION 5 — PARTNERSHIP
                    ══════════════════════════ */
        .partnership {
            padding: 7rem 0;
            background: #f5f5f3;
        }

        .partnership-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        @media (max-width: 900px) {
            .partnership-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
        }

        .partner-image {
            height: 460px;
            order: -1;
        }

        .partner-image .img-accent {
            width: 70%;
        }

        .partner-text p {
            font-size: 0.975rem;
            color: #6b6b6b;
            font-weight: 300;
            line-height: 1.8;
            margin-bottom: 1.1rem;
        }

        .partner-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .partner-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #fff;
            border: 1px solid #ebebeb;
            padding: 0.5rem 0.875rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #111;
        }

        .partner-badge svg {
            width: 14px;
            height: 14px;
            color: #c8102e;
        }

        /* ══════════════════════════
                       SECTION 6 — TEAM
                    ══════════════════════════ */
        .team {
            padding: 7rem 0;
            background: #fff;
        }

        .team-header {
            margin-bottom: 4rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 1000px) {
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 540px) {
            .team-grid {
                grid-template-columns: 1fr;
            }
        }

        .team-card {
            background: #f5f5f3;
            border: 1px solid #ebebeb;
            overflow: hidden;
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .team-card:hover {
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.09);
            transform: translateY(-4px);
        }

        .team-photo {
            height: 220px;
            position: relative;
            background: linear-gradient(135deg, #ddddd9 0%, #c8c8c4 100%);
        }

        .team-photo::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(-45deg, transparent, transparent 6px, rgba(0, 0, 0, 0.015) 6px, rgba(0, 0, 0, 0.015) 7px);
        }

        .team-photo-initial {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 4rem;
            color: rgba(0, 0, 0, 0.12);
            letter-spacing: 0.05em;
        }

        .team-photo-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #c8102e;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .team-card:hover .team-photo-bar {
            transform: scaleX(1);
        }

        .team-info {
            padding: 1.25rem 1.25rem 1.5rem;
        }

        .team-name {
            font-size: 1rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 0.2rem;
        }

        .team-role {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #c8102e;
            margin-bottom: 0.6rem;
        }

        .team-bio {
            font-size: 0.825rem;
            color: #6b6b6b;
            font-weight: 300;
            line-height: 1.6;
        }

        /* ══════════════════════════
                       SECTION 7 — CTA BAND
                    ══════════════════════════ */
        .cta-band {
            padding: 6rem 0;
            background: #111;
            position: relative;
            overflow: hidden;
        }

        .cta-band::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(-45deg, transparent, transparent 40px, rgba(200, 16, 46, 0.03) 40px, rgba(200, 16, 46, 0.03) 41px);
            pointer-events: none;
        }

        .cta-inner {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-band h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.5rem, 6vw, 5rem);
            color: #fff;
            letter-spacing: 0.04em;
            line-height: 1;
            margin: 0 0 1.25rem;
        }

        .cta-band h2 em {
            color: #c8102e;
            font-style: normal;
        }

        .cta-band p {
            font-size: 1rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.5);
            max-width: 480px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        .cta-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #c8102e;
            color: #fff;
            padding: 0.9rem 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.05em;
            transition: background 0.2s, transform 0.2s;
        }

        .cta-primary:hover {
            background: #a00c24;
            transform: translateY(-2px);
        }

        .cta-primary svg {
            width: 15px;
            height: 15px;
        }

        .cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.9rem 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            letter-spacing: 0.05em;
            transition: border-color 0.2s, color 0.2s;
        }

        .cta-secondary:hover {
            border-color: rgba(255, 255, 255, 0.5);
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <main class="about-page">
        <!-- ═══════════ PAGE HEADER ═══════════ -->
        <div class="page-header">
            <div class="page-header-inner">
                <div class="breadcrumb">
                    <a href="{{ route('index') }}">Home</a>
                    <span>/</span>
                    <span style="color:rgba(255,255,255,0.6)">About Us</span>
                </div>
                <h1>Driving the<br><em>Solar Revolution</em><br>in the Middle East</h1>
                <p class="page-header-sub">Triss is the exclusive distributor of GoodWe solar inverters across the region —
                    bridging world-class technology with the unique demands of one of the world's fastest-growing energy
                    markets.</p>
            </div>
        </div>

        <!-- ═══════════ SECTION 1: MISSION ═══════════ -->
        <section class="mission">
            <div class="wrap">
                <div class="mission-grid">
                    <div class="rx">
                        <span class="section-tag">Our Mission</span>
                        <h2 class="section-title" style="margin-bottom:2rem">More than a distributor. A partner in
                            sustainable progress.</h2>
                        <p class="lead">We exist to accelerate the Middle East's transition to clean, reliable solar
                            energy — one installation at a time.</p>
                        <p>Founded in the UAE, Triss was built on the belief that access to the world's finest solar
                            technology should not stop at regional borders. As GoodWe's exclusive agent, we bring
                            cutting-edge inverter solutions to installers, developers and utilities across the region.</p>
                        <p>We go far beyond supply. Our team of certified engineers provides pre-sale design support,
                            on-site commissioning, and long-term technical training — ensuring every project delivers on its
                            full potential for decades to come.</p>
                        <p>With an intimate understanding of the region's climate, grid regulations, and incentive
                            structures, we don't just sell products — we architect outcomes.</p>
                    </div>
                    <div class="rx-r">
                        <div class="img-block mission-image">
                            <div class="img-block-label">Triss Engineering Team</div>
                            <div class="img-accent" style="width:55%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════ SECTION 2: STATS BAND ═══════════ -->
        <section class="stats-band">
            <div class="wrap">
                <div class="stats-inner">
                    <div class="stat-cell reveal">
                        <div class="stat-num">10<span class="stat-unit">+</span></div>
                        <div class="stat-lbl">Years in Operation</div>
                    </div>
                    <div class="stat-cell reveal rd1">
                        <div class="stat-num">15</div>
                        <div class="stat-lbl">Countries Served</div>
                    </div>
                    <div class="stat-cell reveal rd2">
                        <div class="stat-num">5<span class="stat-unit">K+</span></div>
                        <div class="stat-lbl">Installations Completed</div>
                    </div>
                    <div class="stat-cell reveal rd3">
                        <div class="stat-num">99<span class="stat-unit">%</span></div>
                        <div class="stat-lbl">Client Satisfaction</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════ SECTION 3: STORY / TIMELINE ═══════════ -->
        <section class="story">
            <div class="wrap">
                <div class="story-header reveal">
                    <span class="section-tag">Our Journey</span>
                    <h2 class="section-title">A decade of growth,<br>built on trust.</h2>
                </div>
                <div class="timeline">

                    <div class="tl-item reveal">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2014</div>
                        <div class="tl-content">
                            <div class="tl-title">Founded in Dubai</div>
                            <div class="tl-text">Triss is established in the UAE with a clear mandate — to bring world-class
                                solar inverter solutions to an underserved regional market, starting with the GCC.</div>
                        </div>
                    </div>

                    <div class="tl-item reveal rd1">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2016</div>
                        <div class="tl-content">
                            <div class="tl-title">Exclusive GoodWe Partnership</div>
                            <div class="tl-text">Triss signs an exclusive distribution agreement with GoodWe Technologies —
                                one of the world's top five inverter manufacturers — covering the entire Middle East and
                                North Africa region.</div>
                        </div>
                    </div>

                    <div class="tl-item reveal rd1">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2018</div>
                        <div class="tl-content">
                            <div class="tl-title">Regional Expansion</div>
                            <div class="tl-text">Operations expand into Saudi Arabia, Jordan, and Egypt, with dedicated
                                technical support hubs established in Riyadh and Cairo to serve growing demand.</div>
                        </div>
                    </div>

                    <div class="tl-item reveal rd1">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2021</div>
                        <div class="tl-content">
                            <div class="tl-title">1,000th Installation Milestone</div>
                            <div class="tl-text">Triss reaches the milestone of supporting over 1,000 successful
                                installations across the Middle East, with combined capacity exceeding 250 MW.</div>
                        </div>
                    </div>

                    <div class="tl-item reveal rd1">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2023</div>
                        <div class="tl-content">
                            <div class="tl-title">Energy Storage Integration</div>
                            <div class="tl-text">Launch of Lynx battery system distribution and integration, expanding
                                Triss's portfolio to include complete solar-plus-storage solutions from residential to
                                utility scale.</div>
                        </div>
                    </div>

                    <div class="tl-item reveal rd1">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2026</div>
                        <div class="tl-content">
                            <div class="tl-title">Present Day</div>
                            <div class="tl-text">Triss continues to grow its installer network, strengthen technical
                                infrastructure, and pioneer new collaborations on large-scale renewable energy projects
                                across the region.</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ═══════════ SECTION 4: VALUES ═══════════ -->
        <section class="values">
            <div class="wrap">
                <div class="values-header reveal">
                    <span class="section-tag">What We Stand For</span>
                    <h2 class="section-title">The principles that<br>guide everything we do.</h2>
                </div>
                <div class="values-grid">

                    <div class="value-card reveal">
                        <div class="value-number">01</div>
                        <div class="value-title">Technical Excellence</div>
                        <div class="value-text">We hold ourselves to the highest engineering standards — from product
                            selection and system design through to commissioning and long-term support.</div>
                    </div>

                    <div class="value-card reveal rd1">
                        <div class="value-number">02</div>
                        <div class="value-title">Regional Expertise</div>
                        <div class="value-text">Deep knowledge of the Middle East's climate, grid infrastructure, and
                            regulatory environment means our solutions are built for here — not adapted from elsewhere.
                        </div>
                    </div>

                    <div class="value-card reveal rd2">
                        <div class="value-number">03</div>
                        <div class="value-title">Partnership First</div>
                        <div class="value-text">We build long-term relationships with our installer network, providing
                            training, co-support, and business development to help our partners grow alongside us.</div>
                    </div>

                    <div class="value-card reveal">
                        <div class="value-number">04</div>
                        <div class="value-title">Transparency</div>
                        <div class="value-text">Honest communication, clear pricing, and straightforward after-sales
                            processes. No surprises — just reliable service you can count on.</div>
                    </div>

                    <div class="value-card reveal rd1">
                        <div class="value-number">05</div>
                        <div class="value-title">Sustainability</div>
                        <div class="value-text">Solar energy is our business and our belief. We are committed to reducing
                            the region's carbon footprint through every kilowatt-hour of clean energy we enable.</div>
                    </div>

                    <div class="value-card reveal rd2">
                        <div class="value-number">06</div>
                        <div class="value-title">Innovation</div>
                        <div class="value-text">We continuously evolve our product portfolio and service offering, bringing
                            emerging technologies — from smart monitoring to grid-scale storage — to market as they mature.
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ═══════════ SECTION 5: GOODWE PARTNERSHIP ═══════════ -->
        <section class="partnership">
            <div class="wrap">
                <div class="partnership-grid">
                    <div class="rx-r">
                        <div class="img-block partner-image">
                            <div class="img-block-label">GoodWe Global Headquarters</div>
                            <div class="img-accent" style="width:70%"></div>
                        </div>
                    </div>
                    <div class="rx">
                        <span class="section-tag">Our Technology Partner</span>
                        <h2 class="section-title" style="margin-bottom:1.5rem">The GoodWe<br>Difference</h2>
                        <p>GoodWe Technologies is consistently ranked among the world's top five inverter manufacturers,
                            with products operating in over 100 countries and a global installed capacity exceeding 80 GW.
                        </p>
                        <p>Their product range spans everything from compact residential single-phase inverters to
                            multi-megawatt utility-scale string and central systems — all engineered to perform in demanding
                            conditions with industry-leading efficiency ratings.</p>
                        <p>As the exclusive Middle East agent, Triss provides the regional expertise, logistics
                            infrastructure, and technical support network that ensures GoodWe technology performs at its
                            peak, wherever it's deployed.</p>
                        <div class="partner-badges">
                            <span class="partner-badge">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" />
                                </svg>
                                DEWA Approved
                            </span>
                            <span class="partner-badge">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" />
                                </svg>
                                SEC Certified
                            </span>
                            <span class="partner-badge">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" />
                                </svg>
                                ISO 9001:2015
                            </span>
                            <span class="partner-badge">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" />
                                </svg>
                                UL 1741 Certified
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════ SECTION 6: TEAM ═══════════ -->
        <section class="team">
            <div class="wrap">
                <div class="team-header reveal">
                    <span class="section-tag">The Team</span>
                    <h2 class="section-title">Led by experts.<br>Driven by purpose.</h2>
                </div>
                <div class="team-grid">

                    <div class="team-card reveal">
                        <div class="team-photo">
                            <div class="team-photo-initial">A</div>
                            <div class="team-photo-bar"></div>
                        </div>
                        <div class="team-info">
                            <div class="team-name">Ahmed Al-Mansouri</div>
                            <div class="team-role">CEO &amp; Founder</div>
                            <div class="team-bio">15+ years in renewable energy. Led Triss from vision to region-leading
                                distributor.</div>
                        </div>
                    </div>

                    <div class="team-card reveal rd1">
                        <div class="team-photo">
                            <div class="team-photo-initial">S</div>
                            <div class="team-photo-bar"></div>
                        </div>
                        <div class="team-info">
                            <div class="team-name">Samir Khalil</div>
                            <div class="team-role">Chief Technical Officer</div>
                            <div class="team-bio">Expert in solar system design and utility-scale projects. Certified
                                engineer across GCC markets.</div>
                        </div>
                    </div>

                    <div class="team-card reveal rd2">
                        <div class="team-photo">
                            <div class="team-photo-initial">L</div>
                            <div class="team-photo-bar"></div>
                        </div>
                        <div class="team-info">
                            <div class="team-name">Layla Al-Qahtani</div>
                            <div class="team-role">Director of Operations</div>
                            <div class="team-bio">Oversees logistics, warehouse, and supply chain. Ensures projects deliver
                                on time, every time.</div>
                        </div>
                    </div>

                    <div class="team-card reveal rd3">
                        <div class="team-photo">
                            <div class="team-photo-initial">M</div>
                            <div class="team-photo-bar"></div>
                        </div>
                        <div class="team-info">
                            <div class="team-name">Marwan Hassan</div>
                            <div class="team-role">Head of Sales &amp; Partnerships</div>
                            <div class="team-bio">Builds relationships with installers and developers across the Middle
                                East. 10+ years in B2B solar.</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ═══════════ CTA BAND ═══════════ -->
        <section class="cta-band">
            <div class="cta-inner">
                <h2 class="reveal">Ready to power<br>your next <em>solar project?</em></h2>
                <p class="reveal rd1">Whether you're an installer, developer, or utility — our team is ready to support you
                    from design to commissioning.</p>
                <div class="cta-buttons reveal rd2">
                    <a href="{{ route('contact_us') }}" class="cta-primary">
                        Get in Touch
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                        </svg>
                    </a>
                    <a href="{{ route('products') }}" class="cta-secondary">
                        Browse Products
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        /* ── Scroll reveal ── */
        const allReveal = document.querySelectorAll('.reveal, .rx, .rx-r');
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '-30px'
        });
        allReveal.forEach(el => obs.observe(el));
    </script>
@endsection
