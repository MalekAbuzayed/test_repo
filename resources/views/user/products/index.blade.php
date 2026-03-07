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
                        Explore products by category and product family.
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
                        <p class="filter-hint">Pick a subcategory to reveal its related product families.</p>

                        <div class="filter-group" id="subcategoryFilterGroup"></div>

                        <div class="filter-actions">
                            <button type="button" class="btn btn-outline" id="clearFiltersBtn">Clear</button>
                        </div>
                    </div>
                </aside>

                <section class="products-main" aria-label="Products list">
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
            const clearBtn = document.getElementById('clearFiltersBtn');
            const errorBox = document.getElementById('productsFetchError');

            let currentCategoryId = selectedState.category_id ? String(selectedState.category_id) : '';
            let currentSubcategoryId = selectedState.subcategory_id ? String(selectedState.subcategory_id) : '';
            let currentGrandchildId = selectedState.grandchild_id ? String(selectedState.grandchild_id) : '';

            function esc(value) {
                return String(value ?? '').replace(/[&<>"']/g, (char) => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                } [char]));
            }

            function getSubcategoriesByCategory(categoryId) {
                if (!categoryId) return [];
                const category = categories.find((item) => String(item.id) === String(categoryId));
                return category && Array.isArray(category.subcategories) ? category.subcategories : [];
            }

            function renderSubcategoryTree(categoryId, selectedSubcategoryId = '', selectedGrandchildId = '') {
                const subcategories = getSubcategoriesByCategory(categoryId);

                let html = `
                    <label class="filter-item">
                        <input class="filter-check subcategory-check" type="radio" name="subcategory_id" value="" ${selectedSubcategoryId ? '' : 'checked'}>
                        <span>All Subcategories</span>
                    </label>
                `;

                if (!categoryId) {
                    html += `<span class="filter-empty">Choose a category to browse subcategories.</span>`;
                    subcategoryGroup.innerHTML = html;
                    return;
                }

                if (!subcategories.length) {
                    html += `<span class="filter-empty">No subcategories available.</span>`;
                    subcategoryGroup.innerHTML = html;
                    return;
                }

                html += `<ul class="subcategory-tree">`;

                subcategories.forEach((subcategory) => {
                    const isActive = String(selectedSubcategoryId) === String(subcategory.id);
                    const grandchilds = Array.isArray(subcategory.grandchilds) ? subcategory.grandchilds : [];
                    let grandchildHtml = '';

                    if (grandchilds.length) {
                        grandchildHtml = grandchilds.map((grandchild) => {
                            const checked = String(selectedGrandchildId) === String(grandchild.id) ? 'checked' : '';
                            const activeClass = checked ? ' is-active' : '';

                            return `
                                <li class="grandchild-item">
                                    <label class="grandchild-option${activeClass}">
                                        <input class="filter-check grandchild-check" type="radio" name="grandchild_id" value="${esc(grandchild.id)}" ${checked}>
                                        <span>${esc(grandchild.name)}</span>
                                    </label>
                                </li>
                            `;
                        }).join('');
                    } else {
                        grandchildHtml = `<li class="grandchild-item grandchild-item--empty"><span class="filter-empty">No related items.</span></li>`;
                    }

                    html += `
                        <li class="subcategory-node">
                            <label class="subcategory-option${isActive ? ' is-active' : ''}">
                                <input class="filter-check subcategory-check" type="radio" name="subcategory_id" value="${esc(subcategory.id)}" ${isActive ? 'checked' : ''}>
                                <span>${esc(subcategory.name)}</span>
                            </label>
                            <div class="grandchild-wrap${isActive ? ' is-open' : ''}">
                                <ul class="grandchild-list">
                                    ${grandchildHtml}
                                </ul>
                            </div>
                        </li>
                    `;
                });

                html += `</ul>`;
                subcategoryGroup.innerHTML = html;
            }

            function productCardTemplate(product) {
                const imageUrl = product.image_url || `https://picsum.photos/seed/product-${product.id}/900/650`;
                const safeTitle = esc(product.title || '');
                const rawDescription = String(product.description || '');
                const safeDescription = esc(rawDescription.length > 140 ? `${rawDescription.slice(0, 140)}...` :
                    rawDescription);
                const safeCategory = esc(product.category_name || 'N/A');
                const safeSubcategory = esc(product.subcategory_name || 'N/A');
                const safeGrandchild = esc(product.grandchild_name || 'N/A');
                const safeProductUrl = esc(product.product_url || '#');
                const safeImageUrl = esc(imageUrl);

                return `
                    <a class="product-card product-card-link" href="${safeProductUrl}">
                        <article>
                            <div class="product-media">
                                <img src="${safeImageUrl}" alt="${safeTitle}">
                            </div>
                            <div class="product-body">
                                <p class="product-type">Category: ${safeCategory}</p>
                                <h3 class="product-title">${safeTitle}</h3>
                                <p class="product-name">Subcategory: ${safeSubcategory}</p>
                                <p class="product-name">Grandchild: ${safeGrandchild}</p>
                                <p class="product-desc">${safeDescription}</p>
                            </div>
                        </article>
                    </a>
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
                params.delete('grandchild_id');

                if (currentCategoryId) params.set('category_id', currentCategoryId);
                if (currentSubcategoryId) params.set('subcategory_id', currentSubcategoryId);
                if (currentGrandchildId) params.set('grandchild_id', currentGrandchildId);

                history.replaceState({}, '', `${url.pathname}${params.toString() ? `?${params.toString()}` : ''}`);
            }

            async function fetchProducts() {
                try {
                    errorBox.classList.add('d-none');
                    const params = new URLSearchParams();

                    if (currentCategoryId) params.set('category_id', currentCategoryId);
                    if (currentSubcategoryId) params.set('subcategory_id', currentSubcategoryId);
                    if (currentGrandchildId) params.set('grandchild_id', currentGrandchildId);

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
                    currentGrandchildId = selected.grandchild_id ? String(selected.grandchild_id) : '';

                    renderSubcategoryTree(currentCategoryId, currentSubcategoryId, currentGrandchildId);
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
                currentGrandchildId = '';
                renderSubcategoryTree(currentCategoryId);
                fetchProducts();
            });

            subcategoryGroup.addEventListener('change', (event) => {
                if (event.target.classList.contains('subcategory-check')) {
                    currentSubcategoryId = event.target.value;
                    currentGrandchildId = '';
                    renderSubcategoryTree(currentCategoryId, currentSubcategoryId, currentGrandchildId);
                    fetchProducts();
                    return;
                }

                if (event.target.classList.contains('grandchild-check')) {
                    currentGrandchildId = event.target.value;
                    fetchProducts();
                }
            });

            clearBtn.addEventListener('click', () => {
                currentCategoryId = '';
                currentSubcategoryId = '';
                currentGrandchildId = '';

                const allCategoriesOption = categoryGroup.querySelector('input[value=""]');
                if (allCategoriesOption) allCategoriesOption.checked = true;

                renderSubcategoryTree('');
                fetchProducts();
            });

            renderSubcategoryTree(currentCategoryId, currentSubcategoryId, currentGrandchildId);
            fetchProducts();
        })();
    </script>
@endsection
