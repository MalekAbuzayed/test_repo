@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style_files/user/download-center.css') }}?v=1">
@endsection

@section('content')
    @include('user.components.page-hero', [
        'eyebrow' => 'DOWNLOADS',
        'title' => 'Download Center',
        'subtitle' => 'Find manuals, datasheets, certificates, and every file available for a selected product.',
        'backgroundImage' =>
            'https://images.unsplash.com/photo-1465447142348-e9952c393450?q=80&w=2000&auto=format&fit=crop',
    ])

    <main class="section download-center-page" id="downloadCenter">
        <div class="container">
            <section class="download-center-shell reveal" aria-label="Download center filters">
                <div class="download-center-intro">
                    <span class="eyebrow">DOWNLOAD CENTER</span>
                    <h2>Browse Product Files</h2>
                    <p>Select a product branch step by step, then choose the file type you need.</p>
                </div>

                <div class="download-center-grid">
                    <div class="download-field">
                        <label for="downloadCategory">Category</label>
                        <select id="downloadCategory" class="download-select">
                            <option value="">Select category...</option>
                        </select>
                    </div>

                    <div class="download-field">
                        <label for="downloadSubcategory">Subcategory</label>
                        <select id="downloadSubcategory" class="download-select" disabled>
                            <option value="">Select subcategory...</option>
                        </select>
                    </div>

                    <div class="download-field d-none" id="downloadGrandchildField">
                        <label for="downloadGrandchild">Grandchild</label>
                        <select id="downloadGrandchild" class="download-select" disabled>
                            <option value="">Select grandchild...</option>
                        </select>
                    </div>

                    <div class="download-field">
                        <label for="downloadProduct">Product</label>
                        <select id="downloadProduct" class="download-select" disabled>
                            <option value="">Select product...</option>
                        </select>
                    </div>

                    <div class="download-field">
                        <label for="downloadFileType">File Type</label>
                        <select id="downloadFileType" class="download-select" disabled>
                            <option value="">Select file type...</option>
                        </select>
                    </div>
                </div>

                <div class="download-status" id="downloadStatus">Select a category first.</div>
                <div class="download-error d-none" id="downloadError"></div>

                <div class="download-results" id="downloadResults">
                    <div class="download-empty-state">
                        Choose a complete product path to reveal available files.
                    </div>
                </div>

                <div class="download-actions d-none" id="downloadActions">
                    <a id="downloadAllButton" class="btn btn-primary" href="#">Download All Files</a>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        (() => {
            const optionsUrl = @json(route('download.center.options'));

            const categorySelect = document.getElementById('downloadCategory');
            const subcategorySelect = document.getElementById('downloadSubcategory');
            const grandchildField = document.getElementById('downloadGrandchildField');
            const grandchildSelect = document.getElementById('downloadGrandchild');
            const productSelect = document.getElementById('downloadProduct');
            const fileTypeSelect = document.getElementById('downloadFileType');
            const statusBox = document.getElementById('downloadStatus');
            const errorBox = document.getElementById('downloadError');
            const resultsBox = document.getElementById('downloadResults');
            const actionsBox = document.getElementById('downloadActions');
            const downloadAllButton = document.getElementById('downloadAllButton');

            const state = {
                category_id: '',
                subcategory_id: '',
                grandchild_id: '',
                product_id: '',
                file_type: '',
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

            function fillSelect(select, items, placeholder, selectedValue = '', includePlaceholder = true) {
                const options = [];
                if (includePlaceholder) {
                    options.push(`<option value="">${esc(placeholder)}</option>`);
                }

                items.forEach((item) => {
                    const value = item.id ?? '';
                    const label = item.name ?? item.label ?? '';
                    const selected = String(selectedValue) === String(value) ? 'selected' : '';
                    options.push(`<option value="${esc(value)}" ${selected}>${esc(label)}</option>`);
                });

                select.innerHTML = options.join('');
            }

            function setDisabled(select, disabled) {
                select.disabled = disabled;
            }

            function resetSelect(select, placeholder) {
                fillSelect(select, [], placeholder, '', true);
                setDisabled(select, true);
            }

            function renderFiles(files, fileType) {
                if (!files.length) {
                    resultsBox.innerHTML = `
                        <div class="download-empty-state">
                            No downloadable files available for this selection.
                        </div>
                    `;
                    return;
                }

                if (fileType === '__all__') {
                    resultsBox.innerHTML = `
                        <div class="download-type-groups">
                            ${files.map((group) => `
                                <section class="download-type-group">
                                    <h3 class="download-type-group-title">${esc(group.label || 'Files')}</h3>
                                    <div class="download-list">
                                        ${(group.files || []).map((file) => `
                                            <a class="download-card" href="${esc(file.download_url)}">
                                                <span class="download-card-title">${esc(file.title || 'Download File')}</span>
                                                <span class="download-card-meta">${esc(file.mime_type || 'File')}</span>
                                            </a>
                                        `).join('')}
                                    </div>
                                </section>
                            `).join('')}
                        </div>
                    `;
                    return;
                }

                resultsBox.innerHTML = `
                    <div class="download-list">
                        ${files.map((file) => `
                            <a class="download-card" href="${esc(file.download_url)}">
                                <span class="download-card-title">${esc(file.title || 'Download File')}</span>
                                <span class="download-card-meta">${esc(file.mime_type || 'File')}</span>
                            </a>
                        `).join('')}
                    </div>
                `;
            }

            function updateStatus(data) {
                if (!state.category_id) {
                    statusBox.textContent = 'Select a category first.';
                    return;
                }

                if (!state.subcategory_id) {
                    statusBox.textContent = 'Select a subcategory next.';
                    return;
                }

                if (data.grandchild_selection_required && !state.grandchild_id) {
                    statusBox.textContent = 'Select a grandchild to continue.';
                    return;
                }

                if (!state.product_id) {
                    statusBox.textContent = 'Select a product to load file types.';
                    return;
                }

                if (!state.file_type) {
                    statusBox.textContent = 'Select a file type to view downloads.';
                    return;
                }

                if (state.file_type === '__all__') {
                    const fileCount = (data.files || []).reduce((total, group) => total + ((group.files || []).length), 0);
                    statusBox.textContent = `${fileCount} file(s) available for download.`;
                    return;
                }

                statusBox.textContent = `${data.files.length} file(s) available for download.`;
            }

            function syncStateFromResponse(selected) {
                state.category_id = selected.category_id ? String(selected.category_id) : '';
                state.subcategory_id = selected.subcategory_id ? String(selected.subcategory_id) : '';
                state.grandchild_id = selected.grandchild_id ? String(selected.grandchild_id) : '';
                state.product_id = selected.product_id ? String(selected.product_id) : '';
                state.file_type = selected.file_type ? String(selected.file_type) : '';
            }

            async function fetchOptions() {
                try {
                    errorBox.classList.add('d-none');

                    const params = new URLSearchParams();
                    if (state.category_id) params.set('category_id', state.category_id);
                    if (state.subcategory_id) params.set('subcategory_id', state.subcategory_id);
                    if (state.grandchild_id) params.set('grandchild_id', state.grandchild_id);
                    if (state.product_id) params.set('product_id', state.product_id);
                    if (state.file_type) params.set('file_type', state.file_type);

                    const response = await fetch(`${optionsUrl}?${params.toString()}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();
                    syncStateFromResponse(data.selected || {});

                    fillSelect(categorySelect, data.categories || [], 'Select category...', state.category_id);

                    fillSelect(
                        subcategorySelect,
                        data.subcategories || [],
                        'Select subcategory...',
                        state.subcategory_id
                    );
                    setDisabled(subcategorySelect, !state.category_id || !(data.subcategories || []).length);

                    grandchildField.classList.toggle('d-none', !(data.grandchild_selection_required));
                    fillSelect(
                        grandchildSelect,
                        data.grandchilds || [],
                        'Select grandchild...',
                        state.grandchild_id
                    );
                    setDisabled(
                        grandchildSelect,
                        !(data.grandchild_selection_required) || !(data.grandchilds || []).length
                    );

                    fillSelect(productSelect, data.products || [], 'Select product...', state.product_id);
                    setDisabled(
                        productSelect,
                        !state.subcategory_id ||
                        (data.grandchild_selection_required && !state.grandchild_id) ||
                        !(data.products || []).length
                    );

                    fillSelect(fileTypeSelect, data.file_types || [], 'Select file type...', state.file_type);
                    setDisabled(fileTypeSelect, !state.product_id || !(data.file_types || []).length);

                    if (state.file_type) {
                        renderFiles(data.files || [], state.file_type);
                    } else {
                        resultsBox.innerHTML = `
                            <div class="download-empty-state">
                                Choose a file type to view downloads.
                            </div>
                        `;
                    }

                    const showDownloadAll = state.file_type === '__all__' && !!data.download_all_url && (data.files || []).length;
                    actionsBox.classList.toggle('d-none', !showDownloadAll);
                    if (showDownloadAll) {
                        downloadAllButton.href = data.download_all_url;
                    } else {
                        downloadAllButton.href = '#';
                    }

                    updateStatus(data);
                } catch (error) {
                    errorBox.textContent = 'Failed to load download center data.';
                    errorBox.classList.remove('d-none');
                    statusBox.textContent = 'Try again.';
                }
            }

            categorySelect.addEventListener('change', (event) => {
                state.category_id = event.target.value;
                state.subcategory_id = '';
                state.grandchild_id = '';
                state.product_id = '';
                state.file_type = '';
                resetSelect(subcategorySelect, 'Select subcategory...');
                resetSelect(grandchildSelect, 'Select grandchild...');
                resetSelect(productSelect, 'Select product...');
                resetSelect(fileTypeSelect, 'Select file type...');
                fetchOptions();
            });

            subcategorySelect.addEventListener('change', (event) => {
                state.subcategory_id = event.target.value;
                state.grandchild_id = '';
                state.product_id = '';
                state.file_type = '';
                resetSelect(grandchildSelect, 'Select grandchild...');
                resetSelect(productSelect, 'Select product...');
                resetSelect(fileTypeSelect, 'Select file type...');
                fetchOptions();
            });

            grandchildSelect.addEventListener('change', (event) => {
                state.grandchild_id = event.target.value;
                state.product_id = '';
                state.file_type = '';
                resetSelect(productSelect, 'Select product...');
                resetSelect(fileTypeSelect, 'Select file type...');
                fetchOptions();
            });

            productSelect.addEventListener('change', (event) => {
                state.product_id = event.target.value;
                state.file_type = '';
                resetSelect(fileTypeSelect, 'Select file type...');
                fetchOptions();
            });

            fileTypeSelect.addEventListener('change', (event) => {
                state.file_type = event.target.value;
                fetchOptions();
            });

            fetchOptions();
        })();
    </script>
@endsection
