@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style_files/user/products.css') }}">
@endsection

@section('content')
    @include('user.components.page-hero', [
        'eyebrow' => 'CATALOG',
        'title' => 'Products',
        'subtitle' => 'Explore our latest products and technical specifications.',
        'backgroundImage' =>
            'https://images.unsplash.com/photo-1497440001374-f26997328c1b?q=80&w=2000&auto=format&fit=crop',
    ])

    <main class="section products-page" id="products">
        <div class="container">
            <div class="products-head reveal">
                <div>
                    <span class="eyebrow">PRODUCTS</span>
                    <h2>Products Catalog</h2>
                    <p class="subtext products-sub">
                        Explore products by category and subcategory.
                    </p>
                </div>

                <div class="products-head-right">
                    <div class="results-pill" id="resultsCount">{{ $products->count() }} Products</div>
                </div>
            </div>

            <div class="products-layout reveal">
                <aside class="products-filters" aria-label="Product filters">
                    <div class="filter-card">
                        <h3 class="filter-title">Categories</h3>
                        <p class="filter-hint">Choose a category to narrow the catalog.</p>

                        <div class="filter-group" id="categoryFilterGroup">
                            <label class="filter-item">
                                <input class="filter-check category-check" type="radio" name="category_id" value=""
                                    @checked(empty($selected['category_id'])) />
                                <span>All Categories</span>
                            </label>

                            @foreach ($categories as $category)
                                <label class="filter-item">
                                    <input class="filter-check category-check" type="radio" name="category_id"
                                        value="{{ $category->id }}" @checked((int) ($selected['category_id'] ?? 0) === (int) $category->id) />
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-card">
                        <h3 class="filter-title">Subcategories</h3>
                        <p class="filter-hint">Pick a subcategory or view all in selected category.</p>

                        <div class="filter-group" id="subcategoryFilterGroup"></div>

                        <div class="filter-actions">
                            <button type="button" class="btn btn-outline" id="clearFiltersBtn">Clear</button>
                        </div>
                    </div>
                </aside>

                <section class="products-main" aria-label="Products list">
                    <div class="products-toolbar">
                        <div class="search-wrap">
                            <input class="search-input" id="searchInput" type="search"
                                placeholder="Search products (title, description...)" autocomplete="off"
                                value="{{ $selected['search'] ?? '' }}" />
                        </div>

                        <div class="toolbar-actions">
                            <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                        </div>
                    </div>

                    <div id="productsFetchError" class="text-danger small mb-2 d-none"></div>

                    <div class="products-grid" id="productsGrid">
                        @include('user.products.partials.cards', ['products' => $products])
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        (() => {
            const categories = @json($categories);
            const fetchUrl = @json(route('products.filter'));
            const selectedState = @json($selected);

            const categoryGroup = document.getElementById('categoryFilterGroup');
            const subcategoryGroup = document.getElementById('subcategoryFilterGroup');
            const productsGrid = document.getElementById('productsGrid');
            const resultsCount = document.getElementById('resultsCount');
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const clearBtn = document.getElementById('clearFiltersBtn');
            const errorBox = document.getElementById('productsFetchError');

            let currentCategoryId = selectedState.category_id ? String(selectedState.category_id) : '';
            let currentSubcategoryId = selectedState.subcategory_id ? String(selectedState.subcategory_id) : '';
            let currentSearch = selectedState.search || '';

            function getSubcategoriesByCategory(categoryId) {
                if (!categoryId) return [];
                const category = categories.find(c => String(c.id) === String(categoryId));
                return category && Array.isArray(category.subcategories) ? category.subcategories : [];
            }

            function renderSubcategories(categoryId, selectedSubcategoryId = '') {
                const subcategories = getSubcategoriesByCategory(categoryId);

                if (!categoryId) {
                    subcategoryGroup.innerHTML = `
                        <label class="filter-item">
                            <input class="filter-check subcategory-check" type="radio" name="subcategory_id" value="" checked>
                            <span>All Subcategories</span>
                        </label>
                    `;
                    return;
                }

                let html = `
                    <label class="filter-item">
                        <input class="filter-check subcategory-check" type="radio" name="subcategory_id" value="" ${selectedSubcategoryId ? '' : 'checked'}>
                        <span>All Subcategories</span>
                    </label>
                `;

                if (!subcategories.length) {
                    html += `<span class="filter-empty">No subcategories available.</span>`;
                } else {
                    subcategories.forEach(sub => {
                        const checked = String(selectedSubcategoryId) === String(sub.id) ? 'checked' : '';
                        html += `
                            <label class="filter-item">
                                <input class="filter-check subcategory-check" type="radio" name="subcategory_id" value="${sub.id}" ${checked}>
                                <span>${sub.name}</span>
                            </label>
                        `;
                    });
                }

                subcategoryGroup.innerHTML = html;
            }

            function productCardTemplate(product) {
                const imageUrl = product.image_url || `https://picsum.photos/seed/product-${product.id}/900/650`;
                const esc = (value) => {
                    return String(value ?? '').replace(/[&<>"']/g, (char) => ({
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#39;',
                    } [char]));
                };

                const safeTitle = esc(product.title || '');
                const rawDescription = String(product.description || '');
                const safeDescription = esc(rawDescription.length > 140 ? `${rawDescription.slice(0, 140)}...` :
                    rawDescription);
                const safeCategory = esc(product.category_name || 'N/A');
                const safeSubcategory = esc(product.subcategory_name || 'N/A');
                const safeProductUrl = esc(product.product_url || '#');
                const safeImageUrl = esc(imageUrl);

                return `
                    <article class="product-card">
                        <div class="product-media">
                            <img src="${safeImageUrl}" alt="${safeTitle}">
                        </div>
                        <div class="product-body">
                            <p class="product-type">Category: ${safeCategory}</p>
                            <h3 class="product-title">
                                <a href="${safeProductUrl}">${safeTitle}</a>
                            </h3>
                            <p class="product-name">Subcategory: ${safeSubcategory}</p>
                            <p class="product-desc">${safeDescription}</p>
                        </div>
                    </article>
                `;
            }

            function renderProducts(products) {
                if (!products.length) {
                    productsGrid.innerHTML = `<div class="col-12 text-muted">No products found.</div>`;
                    return;
                }

                productsGrid.innerHTML = products.map(productCardTemplate).join('');
            }

            function syncUrl() {
                const url = new URL(window.location.href);
                const params = url.searchParams;

                params.delete('category_id');
                params.delete('subcategory_id');
                params.delete('search');

                if (currentCategoryId) params.set('category_id', currentCategoryId);
                if (currentSubcategoryId) params.set('subcategory_id', currentSubcategoryId);
                if (currentSearch) params.set('search', currentSearch);

                history.replaceState({}, '', `${url.pathname}${params.toString() ? `?${params.toString()}` : ''}`);
            }

            async function fetchProducts() {
                try {
                    errorBox.classList.add('d-none');
                    const params = new URLSearchParams();

                    if (currentCategoryId) params.set('category_id', currentCategoryId);
                    if (currentSubcategoryId) params.set('subcategory_id', currentSubcategoryId);
                    if (currentSearch) params.set('search', currentSearch);

                    const response = await fetch(`${fetchUrl}?${params.toString()}`, {
                        headers: {
                            'Accept': 'application/json'
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();
                    renderProducts(data.products || []);
                    resultsCount.textContent = `${data.count ?? 0} Products`;

                    const selected = data.selected || {};
                    currentCategoryId = selected.category_id ? String(selected.category_id) : '';
                    currentSubcategoryId = selected.subcategory_id ? String(selected.subcategory_id) : '';
                    currentSearch = selected.search || '';

                    searchInput.value = currentSearch;
                    renderSubcategories(currentCategoryId, currentSubcategoryId);
                    syncUrl();
                } catch (err) {
                    errorBox.textContent = 'Failed to update products. Please try again.';
                    errorBox.classList.remove('d-none');
                }
            }

            categoryGroup.addEventListener('change', (event) => {
                if (!event.target.classList.contains('category-check')) return;
                currentCategoryId = event.target.value;
                currentSubcategoryId = '';
                renderSubcategories(currentCategoryId);
                fetchProducts();
            });

            subcategoryGroup.addEventListener('change', (event) => {
                if (!event.target.classList.contains('subcategory-check')) return;
                currentSubcategoryId = event.target.value;
                fetchProducts();
            });

            searchBtn.addEventListener('click', () => {
                currentSearch = searchInput.value.trim();
                fetchProducts();
            });

            searchInput.addEventListener('keydown', (event) => {
                if (event.key !== 'Enter') return;
                event.preventDefault();
                currentSearch = searchInput.value.trim();
                fetchProducts();
            });

            clearBtn.addEventListener('click', () => {
                currentCategoryId = '';
                currentSubcategoryId = '';
                currentSearch = '';

                const allCategoriesOption = categoryGroup.querySelector('input[value=""]');
                if (allCategoriesOption) allCategoriesOption.checked = true;

                searchInput.value = '';
                renderSubcategories('');
                fetchProducts();
            });

            renderSubcategories(currentCategoryId, currentSubcategoryId);
            fetchProducts();
        })();
    </script>
@endsection
