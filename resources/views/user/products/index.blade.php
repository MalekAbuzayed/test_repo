@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style_files/user/products.css') }}">
@endsection

@section('content')
    <div class="products-page-shell">
        <header class="products-page-header">
            <div class="products-page-header__inner">
                <nav class="products-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('index') }}">Home</a>
                    <span>/</span>
                    <span>Products</span>
                </nav>
                <p class="products-page-eyebrow">Catalog</p>
                <h1 class="products-page-title">GoodWe <em>Products</em></h1>
                <p class="products-page-subtitle">
                    Explore route-aware product families and technical product lines for residential, commercial, and
                    utility-scale solar deployments.
                </p>
            </div>
        </header>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <main class="products-page-body" id="products">
            <aside class="products-sidebar" id="productsSidebar" aria-label="Product filters">
                <div class="filter-block">
                    <div class="filter-header">
                        <span class="filter-title">Browse by Category</span>
                        <button type="button" class="sidebar-close" id="sidebarCloseBtn" aria-label="Close filters">
                            <span></span><span></span>
                        </button>
                    </div>

                    <div class="filter-body">
                        <div class="filter-tree" id="filterTree"></div>
                        <button type="button" class="clear-btn" id="clearFiltersBtn">Clear Selection</button>
                    </div>
                </div>
            </aside>

            <section class="products-area" aria-label="Products list">
                <div class="products-toolbar reveal">
                    <div>
                        <span class="products-count"><strong id="productCount">{{ $products->count() }}</strong> products
                            found</span>
                    </div>

                    <div class="toolbar-right">
                        <div class="view-toggle" aria-label="Layout switch">
                            <button class="view-btn active" id="gridBtn" type="button" data-view="grid"
                                aria-label="Grid view">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="3" y="3" width="7" height="7" />
                                    <rect x="14" y="3" width="7" height="7" />
                                    <rect x="3" y="14" width="7" height="7" />
                                    <rect x="14" y="14" width="7" height="7" />
                                </svg>
                            </button>
                            <button class="view-btn" id="listBtn" type="button" data-view="list"
                                aria-label="List view">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="3" y1="6" x2="21" y2="6" />
                                    <line x1="3" y1="12" x2="21" y2="12" />
                                    <line x1="3" y1="18" x2="21" y2="18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="active-filters reveal" id="activeTags"></div>

                <div id="productsFetchError" class="products-fetch-error d-none"></div>

                <div class="product-grid reveal" id="productsGrid">
                    @include('user.products.partials.cards', ['products' => $products])
                </div>
            </section>
        </main>

        <div class="mobile-filter-bar">
            <button class="mob-filter-btn" id="openSidebarBtn" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="4" y1="6" x2="20" y2="6" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                    <line x1="10" y1="18" x2="14" y2="18" />
                </svg>
                Filters
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (() => {
            const categories = @json($categories);
            const fetchUrl = @json(route('products.filter'));
            const selectedState = @json($selected);

            const filterTree = document.getElementById('filterTree');
            const productsGrid = document.getElementById('productsGrid');
            const productCount = document.getElementById('productCount');
            const activeTags = document.getElementById('activeTags');
            const clearBtn = document.getElementById('clearFiltersBtn');
            const errorBox = document.getElementById('productsFetchError');
            const productsSidebar = document.getElementById('productsSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const openSidebarBtn = document.getElementById('openSidebarBtn');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            const gridBtn = document.getElementById('gridBtn');
            const listBtn = document.getElementById('listBtn');

            let currentCategoryId = selectedState.category_id ? String(selectedState.category_id) : '';
            let currentSubcategoryId = selectedState.subcategory_id ? String(selectedState.subcategory_id) : '';
            let currentGrandchildId = selectedState.grandchild_id ? String(selectedState.grandchild_id) : '';
            let currentView = 'grid';

            function esc(value) {
                return String(value ?? '').replace(/[&<>"']/g, (char) => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                } [char]));
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

            function setView(view) {
                currentView = view;
                productsGrid.classList.toggle('list-view', view === 'list');
                gridBtn.classList.toggle('active', view === 'grid');
                listBtn.classList.toggle('active', view === 'list');
            }

            function getSelectedCategory() {
                return categories.find((item) => String(item.id) === currentCategoryId) || null;
            }

            function getSelectedSubcategory() {
                const category = getSelectedCategory();
                if (!category || !Array.isArray(category.subcategories)) return null;
                return category.subcategories.find((item) => String(item.id) === currentSubcategoryId) || null;
            }

            function renderActiveTags() {
                const tags = [];
                const category = getSelectedCategory();
                const subcategory = getSelectedSubcategory();
                const grandchild = subcategory && Array.isArray(subcategory.grandchilds)
                    ? subcategory.grandchilds.find((item) => String(item.id) === currentGrandchildId) || null
                    : null;

                if (category) {
                    tags.push({
                        level: 'category',
                        label: category.name,
                    });
                }

                if (subcategory) {
                    tags.push({
                        level: 'subcategory',
                        label: subcategory.name,
                    });
                }

                if (grandchild) {
                    tags.push({
                        level: 'grandchild',
                        label: grandchild.name,
                    });
                }

                if (!tags.length) {
                    activeTags.innerHTML = '';
                    activeTags.classList.add('is-empty');
                    return;
                }

                activeTags.classList.remove('is-empty');
                activeTags.innerHTML = tags.map((tag) => `
                    <button class="filter-tag" type="button" data-clear-level="${tag.level}">
                        ${esc(tag.label)}
                        <span class="tag-x" aria-hidden="true">&times;</span>
                    </button>
                `).join('');
            }

            function renderFilterTree() {
                const html = `
                    <ul class="cat-list">
                        <li class="cat-item ${currentCategoryId === '' ? 'is-selected-root' : ''}">
                            <button class="cat-row ${currentCategoryId === '' ? 'active' : ''}" type="button" data-action="category" data-category-id="">
                                <span class="cat-name">All Categories</span>
                            </button>
                        </li>
                        ${categories.map((category) => {
                            const isCategoryActive = String(category.id) === currentCategoryId;
                            const subcategories = Array.isArray(category.subcategories) ? category.subcategories : [];

                            return `
                                <li class="cat-item ${isCategoryActive ? 'open' : ''}">
                                    <button class="cat-row ${isCategoryActive ? 'active' : ''}" type="button" data-action="category" data-category-id="${esc(category.id)}">
                                        <span class="cat-arrow" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </span>
                                        <span class="cat-name">${esc(category.name)}</span>
                                    </button>
                                    <ul class="sub-list">
                                        <li class="sub-item ${isCategoryActive && currentSubcategoryId === '' ? 'is-selected-root' : ''}">
                                            <button class="sub-row ${isCategoryActive && currentSubcategoryId === '' ? 'active' : ''}" type="button" data-action="subcategory" data-category-id="${esc(category.id)}" data-subcategory-id="">
                                                <span class="sub-name">All ${esc(category.name)}</span>
                                            </button>
                                        </li>
                                        ${subcategories.map((subcategory) => {
                                            const isSubcategoryActive = String(subcategory.id) === currentSubcategoryId;
                                            const grandchilds = Array.isArray(subcategory.grandchilds) ? subcategory.grandchilds : [];

                                            return `
                                                <li class="sub-item ${isSubcategoryActive ? 'open' : ''}">
                                                    <button class="sub-row ${isSubcategoryActive ? 'active' : ''}" type="button" data-action="subcategory" data-category-id="${esc(category.id)}" data-subcategory-id="${esc(subcategory.id)}">
                                                        <span class="sub-arrow" aria-hidden="true">
                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                                <polyline points="9 18 15 12 9 6"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span class="sub-name">${esc(subcategory.name)}</span>
                                                    </button>
                                                    <ul class="subsub-list">
                                                        <li>
                                                            <button class="subsub-row ${isSubcategoryActive && currentGrandchildId === '' ? 'active' : ''}" type="button" data-action="grandchild" data-category-id="${esc(category.id)}" data-subcategory-id="${esc(subcategory.id)}" data-grandchild-id="">
                                                                <span class="subsub-name">All ${esc(subcategory.name)}</span>
                                                            </button>
                                                        </li>
                                                        ${grandchilds.map((grandchild) => `
                                                            <li>
                                                                <button class="subsub-row ${String(grandchild.id) === currentGrandchildId ? 'active' : ''}" type="button" data-action="grandchild" data-category-id="${esc(category.id)}" data-subcategory-id="${esc(subcategory.id)}" data-grandchild-id="${esc(grandchild.id)}">
                                                                    <span class="subsub-name">${esc(grandchild.name)}</span>
                                                                </button>
                                                            </li>
                                                        `).join('')}
                                                    </ul>
                                                </li>
                                            `;
                                        }).join('')}
                                    </ul>
                                </li>
                            `;
                        }).join('')}
                    </ul>
                `;

                filterTree.innerHTML = html;
            }

            function productCardTemplate(product) {
                const imageUrl = product.image_url || `https://picsum.photos/seed/product-${product.id}/900/650`;
                const safeTitle = esc(product.title || '');
                const safeDescription = esc(String(product.description || '').slice(0, 140)) + (String(product
                    .description || '').length > 140 ? '...' : '');
                const safeCategory = esc(product.category_name || 'N/A');
                const safeSubcategory = esc(product.subcategory_name || 'N/A');
                const safeGrandchild = esc(product.grandchild_name || 'N/A');
                const safeProductUrl = esc(product.product_url || '#');
                const safeImageUrl = esc(imageUrl);
                const imageLabel = safeGrandchild !== 'N/A' ? safeGrandchild : safeSubcategory;

                return `
                    <a class="prod-card product-card-link" href="${safeProductUrl}">
                        <article>
                            <div class="prod-img">
                                <img src="${safeImageUrl}" alt="${safeTitle}">
                                <span class="prod-img-label">${imageLabel}</span>
                            </div>
                            <div class="prod-body">
                                <p class="prod-cat">${safeCategory} / ${safeSubcategory}</p>
                                <h3 class="prod-name">${safeTitle}</h3>
                                <p class="prod-model">${safeGrandchild}</p>
                                <p class="prod-desc">${safeDescription}</p>
                                <div class="prod-footer">
                                    <div class="prod-meta">
                                        <span>${safeCategory}</span>
                                        <span>${safeGrandchild}</span>
                                    </div>
                                    <span class="prod-btn">Details</span>
                                </div>
                            </div>
                        </article>
                    </a>
                `;
            }

            function renderProducts(products) {
                if (!products.length) {
                    productsGrid.innerHTML = `
                        <div class="no-results">
                            <h3>No products found</h3>
                            <p>Try clearing the current filters or selecting a different category path.</p>
                        </div>
                    `;
                    return;
                }

                productsGrid.innerHTML = products.map(productCardTemplate).join('');
                setView(currentView);
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
                            Accept: 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();
                    const selected = data.selected || {};

                    currentCategoryId = selected.category_id ? String(selected.category_id) : '';
                    currentSubcategoryId = selected.subcategory_id ? String(selected.subcategory_id) : '';
                    currentGrandchildId = selected.grandchild_id ? String(selected.grandchild_id) : '';

                    productCount.textContent = String(data.count ?? 0);
                    renderFilterTree();
                    renderActiveTags();
                    renderProducts(data.products || []);
                    syncUrl();
                    closeSidebar();
                } catch (err) {
                    errorBox.textContent = 'Failed to update products. Please try again.';
                    errorBox.classList.remove('d-none');
                }
            }

            function clearFromLevel(level) {
                if (level === 'category') {
                    currentCategoryId = '';
                    currentSubcategoryId = '';
                    currentGrandchildId = '';
                    return;
                }

                if (level === 'subcategory') {
                    currentSubcategoryId = '';
                    currentGrandchildId = '';
                    return;
                }

                if (level === 'grandchild') {
                    currentGrandchildId = '';
                }
            }

            function openSidebar() {
                productsSidebar.classList.add('open');
                sidebarOverlay.classList.add('open');
                document.body.classList.add('products-sidebar-open');
            }

            function closeSidebar() {
                productsSidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
                document.body.classList.remove('products-sidebar-open');
            }

            filterTree.addEventListener('click', (event) => {
                const trigger = event.target.closest('[data-action]');
                if (!trigger) return;

                const action = trigger.dataset.action;
                const categoryId = trigger.dataset.categoryId ?? '';
                const subcategoryId = trigger.dataset.subcategoryId ?? '';
                const grandchildId = trigger.dataset.grandchildId ?? '';

                if (action === 'category') {
                    currentCategoryId = categoryId;
                    currentSubcategoryId = '';
                    currentGrandchildId = '';
                    fetchProducts();
                    return;
                }

                if (action === 'subcategory') {
                    currentCategoryId = categoryId;
                    currentSubcategoryId = subcategoryId;
                    currentGrandchildId = '';
                    fetchProducts();
                    return;
                }

                if (action === 'grandchild') {
                    currentCategoryId = categoryId;
                    currentSubcategoryId = subcategoryId;
                    currentGrandchildId = grandchildId;
                    fetchProducts();
                }
            });

            activeTags.addEventListener('click', (event) => {
                const button = event.target.closest('[data-clear-level]');
                if (!button) return;

                clearFromLevel(button.dataset.clearLevel);
                fetchProducts();
            });

            clearBtn.addEventListener('click', () => {
                currentCategoryId = '';
                currentSubcategoryId = '';
                currentGrandchildId = '';
                fetchProducts();
            });

            openSidebarBtn?.addEventListener('click', openSidebar);
            sidebarCloseBtn?.addEventListener('click', closeSidebar);
            sidebarOverlay?.addEventListener('click', closeSidebar);

            gridBtn.addEventListener('click', () => setView('grid'));
            listBtn.addEventListener('click', () => setView('list'));

            renderFilterTree();
            renderActiveTags();
            setView('grid');
            fetchProducts();
        })();
    </script>
@endsection
