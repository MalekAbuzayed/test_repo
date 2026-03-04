    <header class="navbar navbar--floating" id="navbar">
        <div class="container nav-inner">
            <a class="brand" href="{{ route('index') }}" aria-label="Energy Magic Home">
                <span class="brand-icon">
                    <img src="{{ asset('style_files/images/logo.png') }}" alt="Magic Energy logo"
                        style="height: 28px; width: auto;">
                </span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a class="nav-link" href="{{ route('index') }}">Home</a>
                <a class="nav-link" href="{{ route('about') }}">About</a>
                <div class="nav-item nav-item--has-dropdown">
                    <button class="nav-link nav-dropdown-trigger" type="button" aria-haspopup="true"
                        aria-expanded="false" aria-controls="productsDropdown">
                        Products
                    </button>

                    <div class="nav-dropdown-menu" id="productsDropdown" aria-label="Products Categories">
                        <a class="nav-sub-link nav-sub-link--all" href="{{ route('products') }}">All Products</a>

                        <div class="nav-dropdown-grid">
                            <div class="nav-dropdown-group">
                                <h4 class="nav-dropdown-heading">Solar Solutions</h4>
                                <a class="nav-sub-link" href="#" data-category="solar-solutions"
                                    data-subcategory="residential-systems">Residential Systems</a>
                                <a class="nav-sub-link" href="#" data-category="solar-solutions"
                                    data-subcategory="commercial-systems">Commercial Systems</a>
                            </div>

                            <div class="nav-dropdown-group">
                                <h4 class="nav-dropdown-heading">Energy Storage</h4>
                                <a class="nav-sub-link" href="#" data-category="energy-storage"
                                    data-subcategory="home-batteries">Home Batteries</a>
                                <a class="nav-sub-link" href="#" data-category="energy-storage"
                                    data-subcategory="industrial-batteries">Industrial Batteries</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="nav-link" href="{{ route('index') }}#clients">Download Center</a>
                <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                <a class="nav-link" href="{{ route('contact_us') }}">Contact Us</a>
            </nav>

            <div class="nav-actions">
                <button class="burger" id="burgerBtn" aria-label="Open menu" aria-controls="navLinks"
                    aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>
