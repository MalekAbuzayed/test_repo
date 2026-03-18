@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style_files/user/download-center.css') }}?v=2">
@endsection

@section('content')
    <div class="download-center-page" id="downloadCenterApp">
        <header class="download-center-header">
            <div class="container">
                <div class="download-center-header__inner">
                    <nav class="download-center-breadcrumb" aria-label="Breadcrumb">
                        <a href="{{ route('index') }}">Home</a>
                        <span>/</span>
                        <span>Download Center</span>
                    </nav>
                    <p class="download-center-eyebrow">Downloads</p>
                    <h1 class="download-center-title">Download <em>Center</em></h1>
                    <p class="download-center-subtitle">
                        Browse products step by step, then download manuals, datasheets, certificates, and technical files.
                    </p>
                </div>
            </div>
        </header>

        <main class="download-center-main">
            <div class="container">
                <div class="download-stepper reveal" id="downloadStepper" aria-label="Download center steps">
                    <button class="download-step" id="step-category" type="button"></button>
                    <button class="download-step" id="step-subcategory" type="button"></button>
                    <button class="download-step" id="step-grandchild" type="button"></button>
                    <button class="download-step" id="step-product" type="button"></button>
                    <button class="download-step" id="step-filetype" type="button"></button>
                    <button class="download-step" id="step-results" type="button"></button>
                </div>

                <div class="download-error d-none" id="downloadError"></div>

                <section class="download-panel reveal active" id="panel-category" aria-labelledby="panelCategoryTitle">
                    <div class="download-panel-heading">
                        <span class="download-panel-label">Step 1</span>
                        <h2 class="download-panel-title" id="panelCategoryTitle">Select a Category</h2>
                    </div>
                    <div class="download-card-grid cols-4" id="categoryGrid"></div>
                </section>

                <section class="download-panel reveal" id="panel-subcategory" aria-labelledby="panelSubcategoryTitle">
                    <div class="download-panel-heading">
                        <span class="download-panel-label">Step 2</span>
                        <h2 class="download-panel-title" id="panelSubcategoryTitle">Select a Subcategory</h2>
                    </div>
                    <div class="download-card-grid cols-3" id="subcategoryGrid"></div>
                </section>

                <section class="download-panel reveal" id="panel-grandchild" aria-labelledby="panelGrandchildTitle">
                    <div class="download-panel-heading">
                        <span class="download-panel-label">Step 3</span>
                        <h2 class="download-panel-title" id="panelGrandchildTitle">Select a Grandchild</h2>
                    </div>
                    <div class="download-card-grid cols-3" id="grandchildGrid"></div>
                </section>

                <section class="download-panel reveal" id="panel-product" aria-labelledby="panelProductTitle">
                    <div class="download-panel-heading">
                        <span class="download-panel-label">Step 4</span>
                        <h2 class="download-panel-title" id="panelProductTitle">Select a Product</h2>
                    </div>
                    <div class="download-product-list" id="productList"></div>
                </section>

                <section class="download-panel reveal" id="panel-filetype" aria-labelledby="panelFileTypeTitle">
                    <div class="download-panel-heading">
                        <span class="download-panel-label">Step 5</span>
                        <h2 class="download-panel-title" id="panelFileTypeTitle">Select a File Type</h2>
                    </div>
                    <div class="download-filetype-grid" id="fileTypeGrid"></div>
                </section>

                <section class="download-panel reveal" id="panel-results" aria-labelledby="downloadResultsTitle">
                    <div class="download-results-bar">
                        <div>
                            <h2 class="download-results-title" id="downloadResultsTitle">Files</h2>
                            <p class="download-results-meta" id="downloadResultsMeta"></p>
                        </div>
                        <div class="download-results-actions">
                            <button class="download-btn-outline" id="changeSelectionButton" type="button">Change Selection</button>
                            <a class="download-btn-primary d-none" id="downloadAllButton" href="#">Download All Files</a>
                        </div>
                    </div>
                    <div class="download-results-body" id="downloadResultsBody"></div>
                </section>
            </div>
        </main>
    </div>
@endsection

@section('scripts')
    <script>
        (() => {
            const optionsUrl = @json(route('download.center.options'));

            const panels = {
                category: document.getElementById('panel-category'),
                subcategory: document.getElementById('panel-subcategory'),
                grandchild: document.getElementById('panel-grandchild'),
                product: document.getElementById('panel-product'),
                filetype: document.getElementById('panel-filetype'),
                results: document.getElementById('panel-results'),
            };

            const stepOrder = ['category', 'subcategory', 'grandchild', 'product', 'filetype', 'results'];
            const stepLabels = {
                category: 'Category',
                subcategory: 'Subcategory',
                grandchild: 'Grandchild',
                product: 'Product',
                filetype: 'File Type',
                results: 'Files',
            };

            const stepButtons = {
                category: document.getElementById('step-category'),
                subcategory: document.getElementById('step-subcategory'),
                grandchild: document.getElementById('step-grandchild'),
                product: document.getElementById('step-product'),
                filetype: document.getElementById('step-filetype'),
                results: document.getElementById('step-results'),
            };

            const categoryGrid = document.getElementById('categoryGrid');
            const subcategoryGrid = document.getElementById('subcategoryGrid');
            const grandchildGrid = document.getElementById('grandchildGrid');
            const productList = document.getElementById('productList');
            const fileTypeGrid = document.getElementById('fileTypeGrid');
            const errorBox = document.getElementById('downloadError');
            const resultsBody = document.getElementById('downloadResultsBody');
            const resultsTitle = document.getElementById('downloadResultsTitle');
            const resultsMeta = document.getElementById('downloadResultsMeta');
            const downloadAllButton = document.getElementById('downloadAllButton');
            const changeSelectionButton = document.getElementById('changeSelectionButton');

            const state = {
                category_id: new URLSearchParams(window.location.search).get('category_id') || '',
                subcategory_id: new URLSearchParams(window.location.search).get('subcategory_id') || '',
                grandchild_id: new URLSearchParams(window.location.search).get('grandchild_id') || '',
                product_id: new URLSearchParams(window.location.search).get('product_id') || '',
                file_type: new URLSearchParams(window.location.search).get('file_type') || '',
                activePanel: 'category',
                data: {
                    categories: [],
                    subcategories: [],
                    grandchilds: [],
                    products: [],
                    file_types: [],
                    files: [],
                    grandchild_selection_required: false,
                    selected_labels: {},
                    download_all_url: null,
                },
            };

            function esc(value) {
                return String(value ?? '').replace(/[&<>"']/g, (char) => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                } [char]));
            }

            function formatCount(value, singular, plural = singular + 's') {
                const count = Number(value || 0);
                return `${count} ${count === 1 ? singular : plural}`;
            }

            function panelSequence() {
                return state.data.grandchild_selection_required
                    ? stepOrder
                    : stepOrder.filter((step) => step !== 'grandchild');
            }

            function determineActivePanel() {
                if (!state.category_id) return 'category';
                if (!state.subcategory_id) return 'subcategory';
                if (state.data.grandchild_selection_required && !state.grandchild_id) return 'grandchild';
                if (!state.product_id) return 'product';
                if (!state.file_type) return 'filetype';
                return 'results';
            }

            function syncStateFromResponse(data) {
                const selected = data.selected || {};
                state.category_id = selected.category_id ? String(selected.category_id) : '';
                state.subcategory_id = selected.subcategory_id ? String(selected.subcategory_id) : '';
                state.grandchild_id = selected.grandchild_id ? String(selected.grandchild_id) : '';
                state.product_id = selected.product_id ? String(selected.product_id) : '';
                state.file_type = selected.file_type ? String(selected.file_type) : '';
                state.data = {
                    categories: data.categories || [],
                    subcategories: data.subcategories || [],
                    grandchilds: data.grandchilds || [],
                    products: data.products || [],
                    file_types: data.file_types || [],
                    files: data.files || [],
                    grandchild_selection_required: !!data.grandchild_selection_required,
                    selected_labels: data.selected_labels || {},
                    download_all_url: data.download_all_url || null,
                };
            }

            function syncUrl() {
                const url = new URL(window.location.href);
                const params = url.searchParams;

                ['category_id', 'subcategory_id', 'grandchild_id', 'product_id', 'file_type'].forEach((key) => params.delete(key));

                if (state.category_id) params.set('category_id', state.category_id);
                if (state.subcategory_id) params.set('subcategory_id', state.subcategory_id);
                if (state.grandchild_id) params.set('grandchild_id', state.grandchild_id);
                if (state.product_id) params.set('product_id', state.product_id);
                if (state.file_type) params.set('file_type', state.file_type);

                history.replaceState({}, '', `${url.pathname}${params.toString() ? `?${params.toString()}` : ''}`);
            }

            function showPanel(panelKey) {
                state.activePanel = panelKey;
                Object.entries(panels).forEach(([key, panel]) => {
                    if (!panel) return;
                    const shouldShow = panelSequence().includes(key);
                    panel.classList.toggle('active', key === panelKey && shouldShow);
                });

                updateStepper();

                const activeElement = panels[panelKey];
                if (activeElement) {
                    window.scrollTo({
                        top: Math.max(0, activeElement.offsetTop - 110),
                        behavior: 'smooth',
                    });
                }
            }

            function updateStepper() {
                const sequence = panelSequence();
                const activeIndex = sequence.indexOf(state.activePanel);

                stepOrder.forEach((step) => {
                    const button = stepButtons[step];
                    if (!button) return;

                    const stepIndex = sequence.indexOf(step);
                    if (stepIndex === -1) {
                        button.classList.add('d-none');
                        button.onclick = null;
                        return;
                    }

                    button.classList.remove('d-none');
                    button.classList.remove('is-active', 'is-complete');
                    button.disabled = stepIndex > activeIndex;

                    const selectedLabel = state.data.selected_labels?.[`${step}_name`] || '';

                    if (stepIndex < activeIndex) {
                        button.classList.add('is-complete');
                        button.innerHTML = `
                            <span class="download-step-num">✓</span>
                            <span class="download-step-text">${esc(stepLabels[step])}</span>
                            <span class="download-step-value">${esc(selectedLabel)}</span>
                        `;
                        button.onclick = () => {
                            resetFromStep(step);
                            fetchOptions(step);
                        };
                        return;
                    }

                    if (stepIndex === activeIndex) {
                        button.classList.add('is-active');
                    }

                    button.innerHTML = `
                        <span class="download-step-num">${stepIndex + 1}</span>
                        <span class="download-step-text">${esc(stepLabels[step])}</span>
                    `;
                    button.onclick = null;
                });
            }

            function resetFromStep(step) {
                if (step === 'category') {
                    state.category_id = '';
                    state.subcategory_id = '';
                    state.grandchild_id = '';
                    state.product_id = '';
                    state.file_type = '';
                    return;
                }

                if (step === 'subcategory') {
                    state.subcategory_id = '';
                    state.grandchild_id = '';
                    state.product_id = '';
                    state.file_type = '';
                    return;
                }

                if (step === 'grandchild') {
                    state.grandchild_id = '';
                    state.product_id = '';
                    state.file_type = '';
                    return;
                }

                if (step === 'product') {
                    state.product_id = '';
                    state.file_type = '';
                    return;
                }

                if (step === 'filetype') {
                    state.file_type = '';
                }
            }

            function emptyState(message) {
                return `<div class="download-empty-state">${esc(message)}</div>`;
            }

            function cardTemplate(item, selected, meta, actionLabel = 'View options') {
                return `
                    <button class="download-select-card ${selected ? 'is-selected' : ''}" type="button">
                        <span class="download-card-arrow" aria-hidden="true">→</span>
                        <span class="download-card-name">${esc(item.name || '')}</span>
                        <span class="download-card-meta">${esc(meta)}</span>
                        <span class="download-card-count">${esc(actionLabel)}</span>
                    </button>
                `;
            }

            function renderCategories() {
                if (!state.data.categories.length) {
                    categoryGrid.innerHTML = emptyState('No active categories are available.');
                    return;
                }

                categoryGrid.innerHTML = state.data.categories.map((category) => {
                    const meta = formatCount(category.count, 'product');
                    return `
                        <div data-category-id="${esc(category.id)}">
                            ${cardTemplate(category, String(category.id) === state.category_id, meta, 'Browse')}
                        </div>
                    `;
                }).join('');
            }

            function renderSubcategories() {
                const title = document.getElementById('panelSubcategoryTitle');
                title.textContent = state.data.selected_labels?.category_name
                    ? `Select a Subcategory - ${state.data.selected_labels.category_name}`
                    : 'Select a Subcategory';

                if (!state.data.subcategories.length) {
                    subcategoryGrid.innerHTML = emptyState('No active subcategories are available for this category.');
                    return;
                }

                subcategoryGrid.innerHTML = state.data.subcategories.map((subcategory) => {
                    const parts = [formatCount(subcategory.count, 'product')];
                    if (Number(subcategory.grandchild_count) > 0) {
                        parts.unshift(formatCount(subcategory.grandchild_count, 'grandchild'));
                    }

                    return `
                        <div data-subcategory-id="${esc(subcategory.id)}">
                            ${cardTemplate(
                                subcategory,
                                String(subcategory.id) === state.subcategory_id,
                                parts.join(' • '),
                                Number(subcategory.grandchild_count) > 0 ? 'Browse grandchilds' : 'Browse products'
                            )}
                        </div>
                    `;
                }).join('');
            }

            function renderGrandchilds() {
                const title = document.getElementById('panelGrandchildTitle');
                title.textContent = state.data.selected_labels?.subcategory_name
                    ? `Select a Grandchild - ${state.data.selected_labels.subcategory_name}`
                    : 'Select a Grandchild';

                if (!state.data.grandchilds.length) {
                    grandchildGrid.innerHTML = emptyState('No active grandchilds are available for this subcategory.');
                    return;
                }

                grandchildGrid.innerHTML = state.data.grandchilds.map((grandchild) => `
                    <div data-grandchild-id="${esc(grandchild.id)}">
                        ${cardTemplate(
                            grandchild,
                            String(grandchild.id) === state.grandchild_id,
                            formatCount(grandchild.count, 'product'),
                            'Browse products'
                        )}
                    </div>
                `).join('');
            }

            function renderProducts() {
                const title = document.getElementById('panelProductTitle');
                const contextName = state.data.selected_labels?.grandchild_name || state.data.selected_labels?.subcategory_name;
                title.textContent = contextName ? `Select a Product - ${contextName}` : 'Select a Product';

                if (!state.data.products.length) {
                    productList.innerHTML = emptyState('No products are available for the selected path.');
                    return;
                }

                productList.innerHTML = state.data.products.map((product) => `
                    <button class="download-product-card ${String(product.id) === state.product_id ? 'is-selected' : ''}" type="button" data-product-id="${esc(product.id)}">
                        <span class="download-product-thumb" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="4" width="18" height="12" rx="2"></rect>
                                <line x1="8" y1="20" x2="16" y2="20"></line>
                                <line x1="12" y1="16" x2="12" y2="20"></line>
                            </svg>
                        </span>
                        <span class="download-product-copy">
                            <span class="download-product-label">Product</span>
                            <span class="download-product-name">${esc(product.name)}</span>
                            <span class="download-product-meta">${esc((product.grandchild_name || product.subcategory_name || ''))}</span>
                        </span>
                        <span class="download-product-count">${esc(formatCount(product.count, 'file'))}</span>
                        <span class="download-product-check" aria-hidden="true">✓</span>
                    </button>
                `).join('');
            }

            function renderFileTypes() {
                const title = document.getElementById('panelFileTypeTitle');
                title.textContent = state.data.selected_labels?.product_name
                    ? `Select a File Type - ${state.data.selected_labels.product_name}`
                    : 'Select a File Type';

                if (!state.data.file_types.length) {
                    fileTypeGrid.innerHTML = emptyState('No downloadable file types are available for this product.');
                    return;
                }

                fileTypeGrid.innerHTML = state.data.file_types.map((type) => `
                    <button class="download-filetype-card ${String(type.id) === state.file_type ? 'is-selected' : ''}" type="button" data-file-type="${esc(type.id)}">
                        <span class="download-filetype-badge ${String(type.id) === '__all__' ? 'is-all' : ''}">${esc(type.extension || 'FILE')}</span>
                        <span class="download-filetype-name">${esc(type.name)}</span>
                        <span class="download-filetype-count">${esc(formatCount(type.count, 'file'))}</span>
                    </button>
                `).join('');
            }

            function renderResults() {
                if (!state.file_type) {
                    resultsTitle.textContent = 'Files';
                    resultsMeta.textContent = '';
                    resultsBody.innerHTML = emptyState('Choose a file type to view downloadable files.');
                    downloadAllButton.classList.add('d-none');
                    downloadAllButton.href = '#';
                    return;
                }

                const fileTypeName = state.data.selected_labels?.file_type_name || 'Files';
                const productName = state.data.selected_labels?.product_name || 'Selected product';
                resultsTitle.innerHTML = state.file_type === '__all__'
                    ? `All Files - <em>${esc(productName)}</em>`
                    : `${esc(fileTypeName)} - <em>${esc(productName)}</em>`;

                const breadcrumbs = [
                    state.data.selected_labels?.category_name,
                    state.data.selected_labels?.subcategory_name,
                    state.data.selected_labels?.grandchild_name,
                    state.data.selected_labels?.product_name,
                ].filter(Boolean);
                resultsMeta.textContent = breadcrumbs.join(' / ');

                const files = state.data.files || [];
                if (!files.length) {
                    resultsBody.innerHTML = emptyState('No downloadable files are available for this selection.');
                } else if (state.file_type === '__all__') {
                    resultsBody.innerHTML = files.map((group) => renderResultSection(group.label, group.type, group.files || [], true)).join('');
                } else {
                    resultsBody.innerHTML = renderResultSection(fileTypeName, state.file_type, files, false);
                }

                const showDownloadAll = state.file_type === '__all__' && !!state.data.download_all_url && files.length > 0;
                downloadAllButton.classList.toggle('d-none', !showDownloadAll);
                downloadAllButton.href = showDownloadAll ? state.data.download_all_url : '#';
            }

            function renderResultSection(label, type, files, showFooter) {
                const badge = esc((files[0]?.extension || String(type || 'FILE')).toUpperCase().slice(0, 4));

                return `
                    <section class="download-result-section">
                        <header class="download-result-section__head">
                            <div class="download-result-section__title">
                                <span class="download-filetype-badge ${String(type) === '__all__' ? 'is-all' : ''}">${badge}</span>
                                <span>${esc(label || 'Files')}</span>
                            </div>
                            <span class="download-result-section__count">${esc(formatCount(files.length, 'file'))}</span>
                        </header>
                        <div class="download-result-list">
                            ${files.map((file) => `
                                <div class="download-file-row">
                                    <span class="download-file-badge">${esc((file.extension || badge).toUpperCase().slice(0, 4))}</span>
                                    <div class="download-file-copy">
                                        <div class="download-file-name">${esc(file.title || 'Download File')}</div>
                                        <div class="download-file-meta">
                                            <span>${esc(file.size_label || 'Unknown size')}</span>
                                            <span>${esc(file.mime_type || 'File')}</span>
                                            <span>${esc(file.updated_label ? `Updated ${file.updated_label}` : 'Ready to download')}</span>
                                        </div>
                                    </div>
                                    <a class="download-btn-dark" href="${esc(file.download_url)}">Download</a>
                                </div>
                            `).join('')}
                        </div>
                        ${showFooter ? `
                            <footer class="download-result-section__foot">
                                <span>${esc(`Included in all ${label || 'files'} downloads`)}</span>
                            </footer>
                        ` : ''}
                    </section>
                `;
            }

            function renderAll() {
                renderCategories();
                renderSubcategories();
                if (state.data.grandchild_selection_required) {
                    renderGrandchilds();
                }
                renderProducts();
                renderFileTypes();
                renderResults();
                updateStepper();
            }

            async function fetchOptions(preferredPanel = null) {
                try {
                    errorBox.classList.add('d-none');

                    const params = new URLSearchParams();
                    if (state.category_id) params.set('category_id', state.category_id);
                    if (state.subcategory_id) params.set('subcategory_id', state.subcategory_id);
                    if (state.grandchild_id) params.set('grandchild_id', state.grandchild_id);
                    if (state.product_id) params.set('product_id', state.product_id);
                    if (state.file_type) params.set('file_type', state.file_type);

                    const response = await fetch(`${optionsUrl}?${params.toString()}`, {
                        headers: { Accept: 'application/json' },
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();
                    syncStateFromResponse(data);
                    renderAll();

                    const nextPanel = preferredPanel && panelSequence().includes(preferredPanel)
                        ? preferredPanel
                        : determineActivePanel();

                    showPanel(nextPanel);
                    syncUrl();
                } catch (error) {
                    errorBox.textContent = 'Failed to load download center data.';
                    errorBox.classList.remove('d-none');
                }
            }

            categoryGrid.addEventListener('click', (event) => {
                const target = event.target.closest('[data-category-id]');
                if (!target) return;

                state.category_id = String(target.dataset.categoryId || '');
                state.subcategory_id = '';
                state.grandchild_id = '';
                state.product_id = '';
                state.file_type = '';
                fetchOptions('subcategory');
            });

            subcategoryGrid.addEventListener('click', (event) => {
                const target = event.target.closest('[data-subcategory-id]');
                if (!target) return;

                state.subcategory_id = String(target.dataset.subcategoryId || '');
                state.grandchild_id = '';
                state.product_id = '';
                state.file_type = '';
                fetchOptions();
            });

            grandchildGrid.addEventListener('click', (event) => {
                const target = event.target.closest('[data-grandchild-id]');
                if (!target) return;

                state.grandchild_id = String(target.dataset.grandchildId || '');
                state.product_id = '';
                state.file_type = '';
                fetchOptions('product');
            });

            productList.addEventListener('click', (event) => {
                const target = event.target.closest('[data-product-id]');
                if (!target) return;

                state.product_id = String(target.dataset.productId || '');
                state.file_type = '';
                fetchOptions('filetype');
            });

            fileTypeGrid.addEventListener('click', (event) => {
                const target = event.target.closest('[data-file-type]');
                if (!target) return;

                state.file_type = String(target.dataset.fileType || '');
                fetchOptions('results');
            });

            changeSelectionButton.addEventListener('click', () => {
                resetFromStep('filetype');
                fetchOptions('filetype');
            });

            fetchOptions();
        })();
    </script>
@endsection
