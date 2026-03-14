@php
    $isHomePage = request()->routeIs('index');
    $homeUrl = route('index');
    $aboutHref = route('about');
    $newsHref = $homeUrl . '#news';
    $contactHref = route('contact_us');
@endphp

<header class="site-header" id="navbar">
    <div class="container nav-shell">
        <div class="nav-inner">
            <a class="nav-logo" href="{{ route('index') }}" aria-label="TRISS home">
                <span class="nav-logo-mark">
                    <img src="{{ asset('style_files/images/logo.png') }}" alt="TRISS logo">
                </span>
                <span class="nav-logo-copy">
                    <strong>TRISS</strong>
                    <small>GoodWe Exclusive Agent</small>
                </span>
            </a>

            <nav class="nav-links" id="navLinks" aria-label="Primary navigation">
                <a class="nav-link{{ $isHomePage ? ' js-section-track' : '' }}" href="{{ $aboutHref }}"
                    @if ($isHomePage) data-section-target="about" @endif>About</a>

                <div class="nav-item nav-item--has-dropdown{{ $isHomePage ? ' js-section-track' : '' }}"
                    @if ($isHomePage) data-section-target="products" @endif>
                    <button class="nav-link nav-dropdown-trigger" type="button" aria-haspopup="true"
                        aria-expanded="false" aria-controls="productsDropdown">
                        <span class="nav-trigger-label">Products</span>
                        <span class="nav-trigger-caret" aria-hidden="true">
                            <svg class="nav-chevron" viewBox="0 0 10 6" fill="none">
                                <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>

                    <div class="nav-dropdown-menu" id="productsDropdown" aria-label="Products categories">
                        <div class="nav-dropdown-shell">
                            <div class="nav-dropdown-all">
                                <a class="nav-sub-link nav-sub-link--all" href="{{ route('products') }}">All Products</a>
                            </div>

                            <div class="nav-dropdown-grid">
                                @forelse ($navProductCategories ?? collect() as $category)
                                    <div class="nav-dropdown-group">
                                        <h4 class="nav-dropdown-heading">{{ $category->name }}</h4>

                                        @forelse ($category->subcategories as $subcategory)
                                            <a class="nav-sub-link"
                                                href="{{ route('products', ['category_id' => $category->id, 'subcategory_id' => $subcategory->id]) }}"
                                                data-category="{{ $category->id }}"
                                                data-subcategory="{{ $subcategory->id }}">
                                                {{ $subcategory->name }}
                                            </a>
                                        @empty
                                            <span class="nav-sub-link nav-sub-link--muted">No subcategories</span>
                                        @endforelse
                                    </div>
                                @empty
                                    <div class="nav-dropdown-group nav-dropdown-group--empty">
                                        <h4 class="nav-dropdown-heading">No Categories</h4>
                                        <span class="nav-sub-link nav-sub-link--muted">No product filters available.</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <a class="nav-link{{ $isHomePage ? ' js-section-track' : '' }}" href="{{ $newsHref }}"
                    @if ($isHomePage) data-section-target="news" @endif>News</a>
                <a class="nav-link" href="{{ route('download.center') }}">Download Center</a>
                <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                <a class="nav-link{{ $isHomePage ? ' js-section-track' : '' }}" href="{{ $contactHref }}"
                    @if ($isHomePage) data-section-target="contact" @endif>Contact</a>
                <a class="nav-cta" href="{{ $contactHref }}">Get in Touch</a>
            </nav>

            <button class="hamburger" id="burgerBtn" aria-label="Open menu" aria-controls="navLinks"
                aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
