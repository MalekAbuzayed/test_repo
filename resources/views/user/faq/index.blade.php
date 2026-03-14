@extends('user.layouts.app')

@section('styles')
    <style>
        :root {
            --red: #c8102e;
            --red-dark: #a00c24;
            --black: #111111;
            --light: #f5f5f3;
            --gray: #6b6b6b;
            --gray-light: #e8e8e6;
            --white: #ffffff;
            --border: #ebebeb;
        }

        .faq-page {
            background: var(--white);
            color: var(--black);
        }

        /* ══════════════════════════
                   PAGE HEADER
                ══════════════════════════ */
        .faq-header {
            background: var(--black);
            padding: 5rem 2rem 4rem;
            position: relative;
            overflow: hidden;
            margin-top: 0;
        }

        .faq-header::after {
            content: 'FAQ';
            position: absolute;
            right: -1rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(10rem, 22vw, 20rem);
            color: rgba(255, 255, 255, 0.03);
            letter-spacing: 0.05em;
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }

        .faq-header-inner {
            max-width: 1280px;
            margin: 0 auto;
            width: min(1280px, 92%);
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
            color: var(--red);
        }

        .breadcrumb span {
            color: rgba(255, 255, 255, 0.2);
        }

        .faq-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 7vw, 5.5rem);
            line-height: 0.95;
            color: #fff;
            letter-spacing: 0.04em;
            margin: 0 0 1.25rem;
        }

        .faq-header h1 em {
            color: var(--red);
            font-style: normal;
        }

        .faq-header-sub {
            color: rgba(255, 255, 255, 0.45);
            font-size: 1rem;
            font-weight: 300;
            max-width: 520px;
            margin: 0;
            line-height: 1.7;
        }

        /* ══════════════════════════
                   SEARCH BAR
                ══════════════════════════ */
        .search-bar-wrap {
            background: var(--black);
            padding: 0 2rem 3rem;
        }

        .search-bar-inner {
            max-width: 680px;
            margin: 0 auto;
            width: min(1280px, 92%);
        }

        .search-field {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: border-color 0.2s;
        }

        .search-field:focus-within {
            border-color: var(--red);
        }

        .search-field svg {
            width: 18px;
            height: 18px;
            color: rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
            margin: 0 1rem;
        }

        .search-field input {
            flex: 1;
            background: none;
            border: none;
            outline: none;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 300;
            color: #fff;
            padding: 1rem 1rem 1rem 0;
        }

        .search-field input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .search-clear {
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.3);
            padding: 0 1rem;
            font-size: 1.1rem;
            line-height: 1;
            transition: color 0.2s;
            display: none;
        }

        .search-clear.visible {
            display: block;
        }

        .search-clear:hover {
            color: var(--red);
        }

        /* ══════════════════════════
                   MAIN BODY
                ══════════════════════════ */
        .faq-body {
            max-width: 1280px;
            margin: 0 auto;
            width: min(1280px, 92%);
            padding: 4rem 0 6rem;
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 4rem;
            align-items: start;
        }

        @media (max-width: 900px) {
            .faq-body {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        /* ══════════════════════════
                   CATEGORY NAV (sticky sidebar)
                ══════════════════════════ */
        .cat-nav {
            position: sticky;
            top: 120px;
        }

        .cat-nav-title {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 1rem;
        }

        .cat-nav-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .cat-nav-item {}

        .cat-nav-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.6rem 0.875rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--gray);
            text-decoration: none;
            border-left: 2px solid transparent;
            transition: color 0.2s, border-color 0.2s, background 0.2s;
            cursor: pointer;
            background: none;
            border-top: none;
            border-right: none;
            border-bottom: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }

        .cat-nav-link:hover {
            color: var(--black);
            background: var(--light);
        }

        .cat-nav-link.active {
            color: var(--red);
            font-weight: 700;
            border-left-color: var(--red);
            background: rgba(200, 16, 46, 0.04);
        }

        .cat-nav-count {
            margin-left: auto;
            font-size: 0.7rem;
            font-weight: 400;
            color: var(--gray-light);
            background: var(--light);
            padding: 0.1rem 0.4rem;
            border-radius: 0;
        }

        .cat-nav-link.active .cat-nav-count {
            background: rgba(200, 16, 46, 0.1);
            color: var(--red);
        }

        @media (max-width: 900px) {
            .cat-nav {
                position: static;
            }

            .cat-nav-list {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }

            .cat-nav-link {
                border-left: none;
                border-bottom: 2px solid transparent;
                padding: 0.45rem 0.75rem;
                font-size: 0.8rem;
            }

            .cat-nav-link.active {
                border-bottom-color: var(--red);
                border-left: none;
            }
        }

        /* ══════════════════════════
                   FAQ SECTIONS + ACCORDIONS
                ══════════════════════════ */
        .faq-content {}

        .no-results {
            display: none;
            padding: 4rem 0;
            text-align: center;
            color: var(--gray);
        }

        .no-results.show {
            display: block;
        }

        .no-results h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--black);
            margin: 0 0 0.5rem;
        }

        .no-results p {
            font-size: 0.9rem;
            font-weight: 300;
            margin: 0;
        }

        .faq-section {
            margin-bottom: 3.5rem;
        }

        .faq-section.hidden {
            display: none;
        }

        .faq-section-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.875rem;
            border-bottom: 2px solid var(--black);
        }

        .faq-section-tag {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--red);
            background: rgba(200, 16, 46, 0.08);
            padding: 0.2rem 0.6rem;
        }

        .faq-section-label {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.75rem;
            color: var(--black);
            letter-spacing: 0.04em;
        }

        .faq-section-count {
            margin-left: auto;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gray);
            white-space: nowrap;
        }

        /* Accordion item */
        .faq-item {
            border-bottom: 1px solid var(--border);
            overflow: hidden;
        }

        .faq-item.hidden {
            display: none;
        }

        .faq-q {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 0;
            cursor: pointer;
            list-style: none;
            user-select: none;
        }

        .faq-q::-webkit-details-marker {
            display: none;
        }

        .faq-q-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.25s;
            position: relative;
        }

        .faq-q-icon::before,
        .faq-q-icon::after {
            content: '';
            position: absolute;
            background: var(--gray);
            border-radius: 1px;
            transition: all 0.3s;
        }

        .faq-q-icon::before {
            width: 10px;
            height: 1.5px;
        }

        .faq-q-icon::after {
            width: 1.5px;
            height: 10px;
        }

        .faq-item.open .faq-q-icon {
            background: var(--red);
        }

        .faq-item.open .faq-q-icon::before {
            background: #fff;
        }

        .faq-item.open .faq-q-icon::after {
            background: #fff;
            transform: rotate(90deg);
            opacity: 0;
        }

        .faq-q-text {
            font-size: 0.975rem;
            font-weight: 600;
            color: var(--black);
            line-height: 1.4;
            flex: 1;
            transition: color 0.2s;
        }

        .faq-item.open .faq-q-text {
            color: var(--red);
        }

        .faq-item:hover .faq-q-text {
            color: var(--red);
        }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.38s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-item.open .faq-a {
            max-height: 600px;
        }

        .faq-a-inner {
            padding: 0 0 1.5rem 2.75rem;
            font-size: 0.9rem;
            color: var(--gray);
            font-weight: 300;
            line-height: 1.8;
        }

        .faq-a-inner p {
            margin: 0 0 0.75rem;
        }

        .faq-a-inner p:last-child {
            margin-bottom: 0;
        }

        .faq-a-inner a {
            color: var(--red);
            text-decoration: none;
            font-weight: 500;
        }

        .faq-a-inner a:hover {
            text-decoration: underline;
        }

        .faq-a-inner ul {
            padding-left: 1.25rem;
            margin: 0.5rem 0 0;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
            list-style: disc;
        }

        .faq-a-inner ul li {
            font-size: 0.875rem;
        }

        /* highlight from search */
        mark {
            background: rgba(200, 16, 46, 0.15);
            color: var(--red);
            padding: 0 2px;
            border-radius: 2px;
        }

        /* ══════════════════════════
                   CTA BAND
                ══════════════════════════ */
        .cta-band {
            background: var(--black);
            padding: 5.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .cta-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(-45deg, transparent, transparent 40px, rgba(200, 16, 46, 0.03) 40px, rgba(200, 16, 46, 0.03) 41px);
            pointer-events: none;
        }

        .cta-inner {
            max-width: 760px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
            width: min(1280px, 92%);
        }

        .cta-band h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            color: #fff;
            letter-spacing: 0.04em;
            line-height: 1;
            margin: 0 0 1rem;
        }

        .cta-band h2 em {
            color: var(--red);
            font-style: normal;
        }

        .cta-band p {
            font-size: 0.975rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.45);
            max-width: 460px;
            margin: 0 auto 2.25rem;
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
            background: var(--red);
            color: #fff;
            padding: 0.875rem 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.05em;
            transition: background 0.2s, transform 0.2s;
        }

        .cta-primary:hover {
            background: var(--red-dark);
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
            color: rgba(255, 255, 255, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.875rem 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .cta-secondary:hover {
            border-color: rgba(255, 255, 255, 0.5);
            color: #fff;
        }

        /* reveal animation */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
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
    </style>
@endsection

@section('content')
    <main class="faq-page">
        <!-- ═══════════ PAGE HEADER ═══════════ -->
        <div class="faq-header">
            <div class="faq-header-inner">
                <div class="breadcrumb">
                    <a href="{{ route('index') }}">Home</a>
                    <span>/</span>
                    <span style="color:rgba(255,255,255,0.6)">FAQ</span>
                </div>
                <h1>Frequently<br><em>Asked Questions</em></h1>
                <p class="faq-header-sub">Everything you need to know about GoodWe inverters, our services, warranties, and
                    how to work with Triss across the Middle East.</p>
            </div>
        </div>

        <!-- ═══════════ SEARCH BAR ═══════════ -->
        <div class="search-bar-wrap">
            <div class="search-bar-inner">
                <div class="search-field">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="searchInput" placeholder="Search questions…" autocomplete="off" />
                    <button class="search-clear" id="searchClear" onclick="clearSearch()"
                        aria-label="Clear search">×</button>
                </div>
            </div>
        </div>

        <!-- ═══════════ MAIN BODY ═══════════ -->
        <div class="faq-body">

            <!-- ── SIDEBAR CATEGORY NAV ── -->
            <aside class="cat-nav">
                <div class="cat-nav-title">Browse by Topic</div>
                <ul class="cat-nav-list">
                    <li class="cat-nav-item">
                        <button class="cat-nav-link active" onclick="filterCat('all', this)">
                            All Questions <span class="cat-nav-count">28</span>
                        </button>
                    </li>
                    <li class="cat-nav-item">
                        <button class="cat-nav-link" onclick="filterCat('products', this)">
                            Products &amp; Technology <span class="cat-nav-count">7</span>
                        </button>
                    </li>
                    <li class="cat-nav-item">
                        <button class="cat-nav-link" onclick="filterCat('purchasing', this)">
                            Purchasing &amp; Pricing <span class="cat-nav-count">5</span>
                        </button>
                    </li>
                    <li class="cat-nav-item">
                        <button class="cat-nav-link" onclick="filterCat('installation', this)">
                            Installation &amp; Setup <span class="cat-nav-count">6</span>
                        </button>
                    </li>
                    <li class="cat-nav-item">
                        <button class="cat-nav-link" onclick="filterCat('warranty', this)">
                            Warranty &amp; After-Sales <span class="cat-nav-count">5</span>
                        </button>
                    </li>
                    <li class="cat-nav-item">
                        <button class="cat-nav-link" onclick="filterCat('partnership', this)">
                            Partnership &amp; Distribution <span class="cat-nav-count">5</span>
                        </button>
                    </li>
                </ul>
            </aside>

            <!-- ── FAQ CONTENT ── -->
            <div class="faq-content" id="faqContent">

                <div class="no-results" id="noResults">
                    <h3>No results found</h3>
                    <p>Try a different search term or <button onclick="clearSearch()"
                            style="background:none;border:none;color:var(--red);cursor:pointer;font-family:inherit;font-size:inherit;font-weight:600;padding:0">browse
                            all questions</button>.</p>
                </div>

                <!-- ── PRODUCTS & TECHNOLOGY ── -->
                <div class="faq-section" data-cat="products" id="section-products">
                    <div class="faq-section-title">
                        <span class="faq-section-tag">01</span>
                        <span class="faq-section-label">Products &amp; Technology</span>
                        <span class="faq-section-count">7 questions</span>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What types of GoodWe inverters does Triss supply?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Triss supplies the full GoodWe inverter range across four main categories:</p>
                                <ul>
                                    <li><strong>Residential:</strong> Single-phase string inverters (DNS, XS, SDT G3),
                                        hybrid/storage inverters (ET Plus, EH Series), and microinverters (GM Series).</li>
                                    <li><strong>Commercial &amp; Industrial:</strong> Three-phase string inverters (MT G3,
                                        SBP Series), commercial storage-ready systems (BH Series), and string inverters (DT
                                        G2).</li>
                                    <li><strong>Utility Scale:</strong> High-voltage string inverters (HT, SU Series) and
                                        central inverters (GW 250K, GW 500K).</li>
                                    <li><strong>Energy Storage:</strong> Residential and commercial Lynx battery systems
                                        (Lynx Home, Lynx Stack, Lynx Pro).</li>
                                </ul>
                                <p>Contact our sales team for current stock availability and lead times.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Are GoodWe inverters suitable for the Gulf climate?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. GoodWe inverters are engineered to operate in extreme heat — most models are rated
                                    to 60–70°C ambient operating temperature. They feature wide MPPT voltage ranges
                                    optimised for high-irradiance environments, and many carry IP65 or higher ingress
                                    protection ratings for dusty desert conditions.</p>
                                <p>Our technical team can recommend the optimal model and mounting configuration for your
                                    specific site conditions, whether coastal, inland, or high-altitude.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What is the difference between a string inverter and a hybrid
                                inverter?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>A <strong>string inverter</strong> converts DC power from your solar panels into AC grid
                                    power. It is the most common and cost-effective inverter type, best suited for sites
                                    with consistent shading conditions and no battery storage requirement.</p>
                                <p>A <strong>hybrid inverter</strong> (also called a storage-ready inverter) does all of
                                    this — plus it manages a battery bank. It can store excess solar energy for use at night
                                    or during grid outages, making it ideal for clients who want energy independence or
                                    backup power capability.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Do GoodWe inverters include monitoring capabilities?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. All GoodWe inverters are compatible with the <strong>SEMS Portal</strong> (Smart
                                    Energy Management System), GoodWe's cloud-based monitoring platform. It provides
                                    real-time generation data, historical performance analysis, fault alerts, and remote
                                    diagnostics.</p>
                                <p>Most models feature built-in WiFi. For commercial and utility projects, LAN, RS485, and
                                    4G communication options are also available. The SEMS platform is accessible via web
                                    browser and the SEMS app on iOS and Android.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Are GoodWe inverters approved for use in the UAE (DEWA) and Saudi
                                Arabia (SEC)?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. The majority of GoodWe's residential and commercial inverter models carry DEWA
                                    (Dubai Electricity and Water Authority) approval for grid-tied installations in Dubai,
                                    as well as SEC (Saudi Electricity Company) approval for use in the Kingdom of Saudi
                                    Arabia.</p>
                                <p>We can provide the full list of approved model numbers on request. Our team also assists
                                    installers with the technical documentation required for DEWA and SEC net-metering
                                    applications.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Can GoodWe inverters operate in off-grid mode?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>GoodWe's hybrid inverter range (ET Plus, EH Series) supports off-grid and backup
                                    operation when paired with a compatible Lynx battery system. In the event of a grid
                                    outage, these inverters automatically switch to island mode, powering critical loads
                                    from solar and stored energy.</p>
                                <p>Pure string inverters (DNS, XS, MT G3, etc.) are grid-tied only and will shut down during
                                    a grid outage for safety, as required by IEC standards.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="products">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What certifications do GoodWe products hold?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>GoodWe inverters hold a comprehensive range of international certifications including IEC
                                    62109-1/2, CE, VDE, TÜV, MCS, G98/G99 (UK), AS/NZS 4777 (Australia), and UL 1741 (North
                                    America). For the Middle East market, relevant models also carry DEWA, SEC, and SEWA
                                    approvals.</p>
                                <p>Certification documentation is available through your Triss account manager for inclusion
                                    in project submissions.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- /products section -->

                <!-- ── PURCHASING & PRICING ── -->
                <div class="faq-section" data-cat="purchasing" id="section-purchasing">
                    <div class="faq-section-title">
                        <span class="faq-section-tag">02</span>
                        <span class="faq-section-label">Purchasing &amp; Pricing</span>
                        <span class="faq-section-count">5 questions</span>
                    </div>

                    <div class="faq-item" data-cat="purchasing">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">How do I place an order with Triss?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Orders can be placed directly through your assigned Triss account manager, or by
                                    submitting a purchase request via our <a href="{{ route('contact_us') }}">contact
                                        form</a>. For registered installer partners, orders can also be submitted through
                                    our partner portal.</p>
                                <p>We recommend confirming stock availability and lead times before placing large orders,
                                    particularly for newer model ranges or utility-scale quantities.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="purchasing">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Do you offer volume discounts for installers and distributors?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. Triss operates a tiered pricing structure for registered installer and distribution
                                    partners. Volume discounts are applied based on annual purchase commitments and order
                                    size. Contact our sales team to discuss the right tier for your business.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="purchasing">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What currencies and payment terms do you accept?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>We transact primarily in UAE Dirhams (AED) and US Dollars (USD). Payment terms for new
                                    accounts are typically 100% advance payment. Established partners with a good payment
                                    history may qualify for net-30 or net-60 credit terms subject to a credit assessment.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="purchasing">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What are your typical lead times?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>For in-stock items at our UAE warehouse, dispatch is typically within 2–5 business days
                                    of confirmed payment. For items sourced directly from GoodWe's manufacturing facilities
                                    in China, lead times range from 4–12 weeks depending on the model and quantity.</p>
                                <p>We maintain strategic stock of the most popular residential and commercial models.
                                    Contact us for a current stock list.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="purchasing">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Do you ship outside the UAE?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. Triss ships to all 15 countries in our coverage area, including Saudi Arabia,
                                    Jordan, Egypt, Kuwait, Bahrain, Oman, and Qatar among others. Shipping costs and customs
                                    documentation are handled by our logistics team. DDP (Delivered Duty Paid) pricing is
                                    available for most GCC destinations.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- /purchasing section -->

                <!-- ── INSTALLATION & SETUP ── -->
                <div class="faq-section" data-cat="installation" id="section-installation">
                    <div class="faq-section-title">
                        <span class="faq-section-tag">03</span>
                        <span class="faq-section-label">Installation &amp; Setup</span>
                        <span class="faq-section-count">6 questions</span>
                    </div>

                    <div class="faq-item" data-cat="installation">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Does Triss provide installation services?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Triss does not directly install systems — we work exclusively through our certified
                                    installer partner network. We can refer you to a qualified installer in your area. If
                                    you are an installer looking to join our network, please visit our <a
                                        href="{{ route('about') }}">Partner Program</a> page.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="installation">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Does Triss offer pre-sale system design support?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes, this is one of our core service offerings. Our application engineering team provides
                                    complimentary pre-sale design support including inverter sizing, string configuration,
                                    MPPT optimisation, and compatibility checks — for both residential and commercial
                                    projects.</p>
                                <p>Submit your project details via our <a href="{{ route('contact_us') }}">contact form</a>
                                    or reach out to your account manager to arrange a design review session.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="installation">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">How do I commission a GoodWe inverter?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>GoodWe inverters are commissioned via the <strong>GoodWe SEMS Portal</strong> or the
                                    <strong>PV Master app</strong> (available on iOS and Android). The setup process
                                    involves scanning the inverter's QR code, configuring grid parameters, and registering
                                    the device to the owner's SEMS account.
                                </p>
                                <p>Full commissioning guides are included in the product documentation. Triss also offers
                                    on-site commissioning support for large commercial and utility projects — contact your
                                    account manager for details.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="installation">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What grid parameters should I configure for the UAE?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>For UAE (mainland) grid connections, inverters should be configured with the standard
                                    grid profile: 230V / 50Hz (single phase) or 400V / 50Hz (three phase), with frequency
                                    and voltage ride-through settings aligned with DEWA's technical requirements.</p>
                                <p>Our technical team can provide the exact parameter settings for DEWA, SEWA, Abu Dhabi
                                    Distribution Company (ADDC/AADC), and other regional utilities on request.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="installation">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Can multiple GoodWe inverters be connected together (multi-machine
                                parallel)?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. GoodWe's commercial three-phase and hybrid inverters support multi-machine parallel
                                    operation using the EZLINK or EZBUS communication interface. This allows multiple
                                    inverters to be monitored and managed as a unified system — essential for larger
                                    commercial rooftop and C&amp;I projects.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="installation">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Does Triss offer training for installers?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. Triss runs regular GoodWe product training workshops for registered installer
                                    partners, covering system design principles, commissioning procedures, troubleshooting,
                                    and SEMS platform operation. Training is available in-person at our Dubai facility and,
                                    for larger partner organisations, on-site.</p>
                                <p>Participants receive a GoodWe installer certification upon successful completion. <a
                                        href="{{ route('contact_us') }}">Contact us</a> to register for the next scheduled
                                    session.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- /installation section -->

                <!-- ── WARRANTY & AFTER-SALES ── -->
                <div class="faq-section" data-cat="warranty" id="section-warranty">
                    <div class="faq-section-title">
                        <span class="faq-section-tag">04</span>
                        <span class="faq-section-label">Warranty &amp; After-Sales</span>
                        <span class="faq-section-count">5 questions</span>
                    </div>

                    <div class="faq-item" data-cat="warranty">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What warranty does GoodWe offer on its inverters?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>GoodWe standard warranty periods vary by product category:</p>
                                <ul>
                                    <li><strong>Residential string inverters:</strong> 10 years standard (extendable to 20
                                        years)</li>
                                    <li><strong>Hybrid inverters:</strong> 10 years standard</li>
                                    <li><strong>Commercial string inverters:</strong> 5 years standard (extendable to 20
                                        years)</li>
                                    <li><strong>Utility-scale inverters:</strong> 5 years standard</li>
                                    <li><strong>Lynx battery systems:</strong> 10 years</li>
                                </ul>
                                <p>Extended warranty packages are available for purchase. All warranties are backed by
                                    GoodWe globally, with Triss managing the claims process regionally.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="warranty">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">How do I make a warranty claim?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>To initiate a warranty claim, contact our after-sales team at <a
                                        href="mailto:support@triss.ae">support@triss.ae</a> with the following information:
                                </p>
                                <ul>
                                    <li>Inverter serial number (found on the product label and in SEMS)</li>
                                    <li>Date of installation and installer details</li>
                                    <li>Description of the fault with any error codes displayed</li>
                                    <li>Screenshots from the SEMS portal showing the fault history</li>
                                </ul>
                                <p>Our technical team will assess the claim, typically within 2 business days, and advise on
                                    the next steps — which may include remote diagnostics, a site visit, or a direct
                                    replacement.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="warranty">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Does the warranty cover damage caused by lightning or power
                                surges?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>The standard GoodWe warranty covers manufacturing defects and component failures under
                                    normal operating conditions. Damage caused by external factors such as lightning
                                    strikes, power surges, flooding, physical impact, or improper installation is not
                                    covered under warranty and would need to be claimed through the property or contractor's
                                    insurance.</p>
                                <p>We strongly recommend installing surge protection devices (SPDs) on the AC and DC sides
                                    as part of every installation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="warranty">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">How long does a warranty replacement or repair take?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>For in-warranty replacements where a fault is confirmed, we aim to dispatch a replacement
                                    unit within 5–10 business days for stocked models. Complex or less common models may
                                    require 2–4 weeks if the replacement unit needs to be sourced from GoodWe directly.</p>
                                <p>In cases where the inverter can be repaired rather than replaced, our technical team will
                                    advise on the expected repair timeline.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="warranty">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Is the warranty transferable if the property is sold?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. GoodWe warranties are attached to the equipment (identified by serial number) rather
                                    than the original purchaser. If a property is sold, the remaining warranty period
                                    transfers to the new owner. We recommend updating the SEMS account ownership and
                                    notifying Triss of the change so our records remain current.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- /warranty section -->

                <!-- ── PARTNERSHIP & DISTRIBUTION ── -->
                <div class="faq-section" data-cat="partnership" id="section-partnership">
                    <div class="faq-section-title">
                        <span class="faq-section-tag">05</span>
                        <span class="faq-section-label">Partnership &amp; Distribution</span>
                        <span class="faq-section-count">5 questions</span>
                    </div>

                    <div class="faq-item" data-cat="partnership">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">How can my company become a Triss installer partner?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>We welcome applications from qualified solar installation companies across the Middle
                                    East. To join our installer network, you will need to demonstrate:</p>
                                <ul>
                                    <li>A valid electrical or solar contractor licence in your market</li>
                                    <li>Relevant technical experience and qualified personnel</li>
                                    <li>Commitment to completing GoodWe product training</li>
                                </ul>
                                <p>Submit your application via our <a href="{{ route('contact_us') }}">contact form</a> or
                                    contact our partnerships team at <a
                                        href="mailto:partners@triss.ae">partners@triss.ae</a>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="partnership">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">What benefits do registered Triss partners receive?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Registered Triss installer partners benefit from:</p>
                                <ul>
                                    <li>Access to preferential pricing tiers</li>
                                    <li>Priority stock allocation during high-demand periods</li>
                                    <li>Free pre-sale technical design support from our engineers</li>
                                    <li>GoodWe product training and certification</li>
                                    <li>Co-branded marketing materials and case study support</li>
                                    <li>Dedicated account management</li>
                                    <li>Access to the Triss partner portal for order tracking and documentation</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="partnership">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Can I become a sub-distributor for Triss in my country?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>In markets where Triss does not yet have a direct presence, we do consider
                                    sub-distribution partnerships with established solar distributors. These arrangements
                                    are assessed on a case-by-case basis, taking into account market size, the applicant's
                                    existing distribution capabilities, and technical infrastructure.</p>
                                <p>If you are interested in exploring a sub-distribution agreement, please reach out to our
                                    partnerships team with an overview of your company and target market.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="partnership">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Does Triss support project-specific tenders and bids?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>Yes. For utility-scale and large commercial tenders, our team provides comprehensive bid
                                    support including technical specifications, performance guarantees, certifications, and
                                    competitive pricing. We can also coordinate directly with GoodWe's project team for very
                                    large or strategic opportunities.</p>
                                <p>Contact your account manager or email <a
                                        href="mailto:projects@triss.ae">projects@triss.ae</a> with your tender details as
                                    early as possible to ensure adequate preparation time.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-cat="partnership">
                        <div class="faq-q" onclick="toggleItem(this.parentElement)">
                            <div class="faq-q-icon"></div>
                            <span class="faq-q-text">Who is GoodWe and why did Triss choose to partner with them?</span>
                        </div>
                        <div class="faq-a">
                            <div class="faq-a-inner">
                                <p>GoodWe Technologies Co., Ltd. is a publicly listed Chinese company (STAR Market: 688390)
                                    and one of the world's top-five solar inverter manufacturers by shipped capacity. With
                                    over 80 GW installed across more than 100 countries, they combine mass-manufacturing
                                    scale with genuine R&amp;D investment in efficiency, reliability, and smart energy
                                    management.</p>
                                <p>Triss selected GoodWe as our technology partner because of their proven track record in
                                    hot-climate markets, their comprehensive product range from residential to utility
                                    scale, and their commitment to long-term product support — qualities that align directly
                                    with what our regional customers demand.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- /partnership section -->

            </div><!-- /faq-content -->
        </div><!-- /faq-body -->

        <!-- ═══════════ CTA BAND ═══════════ -->
        <section class="cta-band">
            <div class="cta-inner">
                <h2 class="reveal">Still have a <em>question?</em></h2>
                <p class="reveal rd1">Our team is available Sunday through Thursday, 8am to 5pm GST. We typically respond
                    within one business day.</p>
                <div class="cta-buttons reveal rd2">
                    <a href="{{ route('contact_us') }}" class="cta-primary">
                        Contact Us
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                        </svg>
                    </a>
                    <a href="mailto:support@triss.ae" class="cta-secondary">support@triss.ae</a>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        /* ── Accordion ── */
        function toggleItem(item) {
            const wasOpen = item.classList.contains('open');
            // close all in same section
            item.closest('.faq-section').querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
            if (!wasOpen) item.classList.add('open');
        }

        /* ── Category filter ── */
        function filterCat(cat, btn) {
            // update nav
            document.querySelectorAll('.cat-nav-link').forEach(l => l.classList.remove('active'));
            btn.classList.add('active');

            // clear search
            document.getElementById('searchInput').value = '';
            document.getElementById('searchClear').classList.remove('visible');
            clearHighlights();

            const sections = document.querySelectorAll('.faq-section');
            const items = document.querySelectorAll('.faq-item');

            if (cat === 'all') {
                sections.forEach(s => s.classList.remove('hidden'));
                items.forEach(i => i.classList.remove('hidden'));
            } else {
                sections.forEach(s => {
                    s.classList.toggle('hidden', s.dataset.cat !== cat);
                });
                items.forEach(i => i.classList.remove('hidden'));
            }

            document.getElementById('noResults').classList.remove('show');
            // close all open items
            items.forEach(i => i.classList.remove('open'));
        }

        /* ── Search ── */
        const searchInput = document.getElementById('searchInput');
        const searchClear = document.getElementById('searchClear');

        searchInput.addEventListener('input', () => {
            const q = searchInput.value.trim();
            searchClear.classList.toggle('visible', q.length > 0);
            if (!q) {
                clearSearch();
                return;
            }
            runSearch(q);
        });

        function runSearch(q) {
            // reset category nav
            document.querySelectorAll('.cat-nav-link').forEach(l => l.classList.remove('active'));
            document.querySelector('[onclick="filterCat(\'all\', this)"]').classList.add('active');

            const term = q.toLowerCase();
            let anyVisible = false;
            const sections = document.querySelectorAll('.faq-section');

            sections.forEach(s => s.classList.remove('hidden'));

            const items = document.querySelectorAll('.faq-item');
            items.forEach(item => {
                const qText = item.querySelector('.faq-q-text').textContent.toLowerCase();
                const aText = item.querySelector('.faq-a-inner').textContent.toLowerCase();
                const match = qText.includes(term) || aText.includes(term);
                item.classList.toggle('hidden', !match);
                if (match) {
                    anyVisible = true;
                    item.classList.add('open'); // auto-open matches
                    highlightItem(item, q);
                }
            });

            // hide sections that have no visible items
            sections.forEach(s => {
                const hasVisible = [...s.querySelectorAll('.faq-item')].some(i => !i.classList.contains('hidden'));
                s.classList.toggle('hidden', !hasVisible);
            });

            document.getElementById('noResults').classList.toggle('show', !anyVisible);
        }

        function highlightItem(item, q) {
            clearHighlightsIn(item);
            const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&')})`, 'gi');
            const qEl = item.querySelector('.faq-q-text');
            const aEl = item.querySelector('.faq-a-inner');
            qEl.innerHTML = qEl.textContent.replace(re, '<mark>$1</mark>');
            // For answer, only highlight text nodes to avoid breaking HTML
            highlightTextNodes(aEl, re);
        }

        function highlightTextNodes(el, re) {
            el.childNodes.forEach(node => {
                if (node.nodeType === 3) { // text node
                    const span = document.createElement('span');
                    span.innerHTML = node.textContent.replace(re, '<mark>$1</mark>');
                    el.replaceChild(span, node);
                } else if (node.nodeType === 1 && node.tagName !== 'MARK') {
                    highlightTextNodes(node, re);
                }
            });
        }

        function clearHighlights() {
            document.querySelectorAll('.faq-item').forEach(item => clearHighlightsIn(item));
        }

        function clearHighlightsIn(item) {
            const qEl = item.querySelector('.faq-q-text');
            const aEl = item.querySelector('.faq-a-inner');
            // restore plain text from marks
            qEl.querySelectorAll('mark').forEach(m => m.replaceWith(m.textContent));
            aEl.querySelectorAll('mark').forEach(m => m.replaceWith(m.textContent));
            aEl.querySelectorAll('span').forEach(s => {
                if (s.childNodes.length === 1 && s.childNodes[0].nodeType === 3) {
                    s.replaceWith(s.textContent);
                }
            });
        }

        function clearSearch() {
            searchInput.value = '';
            searchClear.classList.remove('visible');
            clearHighlights();
            document.querySelectorAll('.faq-section').forEach(s => s.classList.remove('hidden'));
            document.querySelectorAll('.faq-item').forEach(i => {
                i.classList.remove('hidden', 'open');
            });
            document.getElementById('noResults').classList.remove('show');
            document.querySelectorAll('.cat-nav-link').forEach(l => l.classList.remove('active'));
            document.querySelector('[onclick="filterCat(\'all\', this)"]').classList.add('active');
        }

        /* ── Scroll reveal ── */
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '-20px'
        });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>
@endsection
