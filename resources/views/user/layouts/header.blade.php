    <header class="navbar" id="navbar">
        <div class="container nav-inner">
            <a class="brand" href="{{ route('index') }}" aria-label="Energy Magic Home">
                <span class="brand-icon">⚡</span>
                <span class="brand-text">Energy Magic</span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a class="nav-link" href="{{ route('index') }}">Home</a>
                <a class="nav-link" href="{{ route('about') }}">About</a>
                <a class="nav-link" href="{{ route('products') }}">Products</a>
                <a class="nav-link" href="{{ route('index') }}#clients">Clients</a>
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
