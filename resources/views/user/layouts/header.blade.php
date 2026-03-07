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
                        <span class="nav-trigger-label">Products</span>
                        <span class="nav-trigger-caret" aria-hidden="true"></span>
                    </button>

                    <div class="nav-dropdown-menu" id="productsDropdown" aria-label="Products Categories">
                        <a class="nav-sub-link nav-sub-link--all" href="{{ route('products') }}">All Products</a>

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
                                <div class="nav-dropdown-group">
                                    <h4 class="nav-dropdown-heading">No Categories</h4>
                                    <span class="nav-sub-link nav-sub-link--muted">No product filters available.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <a class="nav-link" href="{{ route('download.center') }}">Download Center</a>
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
