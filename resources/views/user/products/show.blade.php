@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style_files/user/product.css') }}?v=4">
@endsection

@section('content')
    <main class="product-page" id="product">
        @php
            $primaryImage = $images->first();
            $heroImage = $primaryImage
                ? asset('storage/' . ltrim($primaryImage->path, '/'))
                : "https://picsum.photos/seed/product-{$product->id}/1600/800";
            $batteryIpRating = null;

            if (strcasecmp((string) ($product->category?->name ?? ''), 'Batteries') === 0) {
                $batteryIpRating = optional(
                    $product->specValues->first(function ($specValue) {
                        return $specValue->field &&
                            $specValue->field->key === 'ip_rating' &&
                            filled($specValue->value_text);
                    }),
                )->value_text;
            }
        @endphp

        <section class="product-hero reveal" style="background-image: url('{{ $heroImage }}');" aria-label="Product hero">
            <div class="product-hero-overlay"></div>
            <div class="container product-hero-content">
                <div class="product-hero-copy">
                    <h1>{{ $product->grandchild->name ?? $product->subcategory->name }}</h1>
                </div>
            </div>
        </section>

        <div class="container">
            <section class="product-detail reveal" aria-label="Product details">
                <div class="product-detail-media-shell">
                    @if ($batteryIpRating)
                        <div class="product-ip-badge-wrap" aria-hidden="true">
                            <div class="product-ip-badge">IP{{ $batteryIpRating }}</div>
                        </div>
                    @endif

                    <div class="product-detail-media">
                        @if ($primaryImage)
                            <img id="mainProductImage" src="{{ asset('storage/' . ltrim($primaryImage->path, '/')) }}"
                                alt="{{ $product->title }}" />
                        @else
                            <img id="mainProductImage" src="https://picsum.photos/seed/product-{{ $product->id }}/1200/800"
                                alt="Product placeholder" />
                        @endif
                    </div>

                    @if ($images->count() > 1)
                        <div class="product-thumb-row">
                            @foreach ($images as $img)
                                <button class="product-thumb @if ($loop->first) is-active @endif"
                                    type="button" data-image="{{ asset('storage/' . ltrim($img->path, '/')) }}"
                                    aria-label="Show image {{ $loop->iteration }}">
                                    <img src="{{ asset('storage/' . ltrim($img->path, '/')) }}" alt="Thumbnail">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="product-detail-body">
                    <div class="product-meta-strip">
                        <span class="product-meta-pill">{{ $product->category?->name ?? 'N/A' }}</span>
                        <span class="product-meta-pill">{{ $product->subcategory?->name ?? 'N/A' }}</span>
                        <span class="product-meta-pill">{{ $product->grandchild?->name ?? 'N/A' }}</span>
                    </div>

                    <h3 class="product-title">{{ $product->title }}</h3>
                    <p class="product-desc">{{ $product->description }}</p>

                    <div class="key-specs-block">
                        <div class="key-specs-head">
                            <h4 class="key-specs-title">Key Specifications</h4>
                            <p class="key-specs-subtitle">Quick reference values for this product.</p>
                        </div>
                        <dl class="key-specs-list">
                            @forelse ($keySpecs as $spec)
                                <div class="key-spec-item">
                                    <dt>{{ $spec['label'] }}</dt>
                                    <dd>
                                        {{ $spec['value'] }}
                                        @if (!empty($spec['unit']))
                                            <span class="key-spec-unit">{{ $spec['unit'] }}</span>
                                        @endif
                                    </dd>
                                </div>
                            @empty
                                <div class="key-spec-item key-spec-item--empty">
                                    <dd>No key specifications available.</dd>
                                </div>
                            @endforelse
                        </dl>
                    </div>
                </div>
            </section>

            <section class="product-actions-bar reveal" aria-label="Product actions">
                <div class="product-actions-wrap">
                    <button type="button" class="product-action-btn" id="otherDetailsBtn" aria-controls="otherDetailsPanel"
                        aria-expanded="false">
                        <span class="product-action-label">Other Details</span>
                        <span class="product-action-sub">Technical breakdown</span>
                    </button>
                    <button type="button" class="product-action-btn" id="downloadsBtn" aria-controls="downloadsPanel"
                        aria-expanded="false">
                        <span class="product-action-label">Download Files</span>
                        <span class="product-action-sub">Manuals, datasheets, certificates</span>
                    </button>
                </div>
            </section>

            <section class="product-extra reveal" aria-label="Product extra details">
                <div class="product-extra-panel d-none" id="otherDetailsPanel" aria-hidden="true">
                    <div class="product-panel-head">
                        <div>
                            <p class="product-panel-eyebrow">DETAILS</p>
                            <h3 class="product-panel-title">Other Details</h3>
                        </div>
                    </div>
                    <div class="loading-state d-none" id="otherDetailsLoading">Loading other details...</div>
                    <div class="error-state d-none" id="otherDetailsError"></div>
                    <div id="otherDetailsContent"></div>
                </div>

                <div class="product-extra-panel d-none" id="downloadsPanel" aria-hidden="true">
                    <div class="product-panel-head">
                        <div>
                            <p class="product-panel-eyebrow">DOWNLOADS</p>
                            <h3 class="product-panel-title">Download Files</h3>
                        </div>
                    </div>

                    <div class="loading-state d-none" id="downloadsLoading">Loading files...</div>
                    <div class="error-state d-none" id="downloadsError"></div>

                    <div class="download-controls">
                        <label for="fileTypeSelect" class="download-select-label">Choose file type</label>
                        <select id="fileTypeSelect" class="download-select">
                            <option value="">Select type...</option>
                        </select>
                    </div>

                    <div id="downloadLinksContainer"></div>

                    <div class="download-all-wrap d-none" id="downloadAllWrap">
                        <a id="downloadAllLink" class="btn btn-primary"
                            href="{{ route('product.files.downloadAll', ['id' => $product->id]) }}">
                            Download All Files
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        (() => {
            const otherDetailsUrl = @json(route('product.specs.other', ['id' => $product->id]));
            const filesListUrl = @json(route('product.files.list', ['id' => $product->id]));

            const otherDetailsBtn = document.getElementById('otherDetailsBtn');
            const downloadsBtn = document.getElementById('downloadsBtn');
            const otherDetailsPanel = document.getElementById('otherDetailsPanel');
            const downloadsPanel = document.getElementById('downloadsPanel');

            const otherDetailsLoading = document.getElementById('otherDetailsLoading');
            const otherDetailsError = document.getElementById('otherDetailsError');
            const otherDetailsContent = document.getElementById('otherDetailsContent');

            const downloadsLoading = document.getElementById('downloadsLoading');
            const downloadsError = document.getElementById('downloadsError');
            const fileTypeSelect = document.getElementById('fileTypeSelect');
            const downloadLinksContainer = document.getElementById('downloadLinksContainer');
            const downloadAllWrap = document.getElementById('downloadAllWrap');

            let activePanel = null;
            let hasLoadedOtherSpecs = false;
            let hasLoadedFiles = false;
            let cachedOtherGroups = [];
            let cachedFileTypes = [];
            let cachedAllFilesCount = 0;

            function esc(value) {
                return String(value ?? '').replace(/[&<>"']/g, (char) => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [char]));
            }

            function setActivePanel(panelName) {
                activePanel = panelName;
                const showOther = panelName === 'other';
                const showDownloads = panelName === 'downloads';

                otherDetailsBtn.classList.toggle('is-active', showOther);
                downloadsBtn.classList.toggle('is-active', showDownloads);

                otherDetailsBtn.setAttribute('aria-expanded', showOther ? 'true' : 'false');
                downloadsBtn.setAttribute('aria-expanded', showDownloads ? 'true' : 'false');

                otherDetailsPanel.classList.toggle('d-none', !showOther);
                downloadsPanel.classList.toggle('d-none', !showDownloads);

                otherDetailsPanel.setAttribute('aria-hidden', showOther ? 'false' : 'true');
                downloadsPanel.setAttribute('aria-hidden', showDownloads ? 'false' : 'true');
            }

            function renderOtherDetails(groups) {
                if (!groups.length) {
                    otherDetailsContent.innerHTML =
                        `<p class="empty-state">No additional specifications available.</p>`;
                    return;
                }

                const html = groups.map(group => `
                    <div class="spec-group-block">
                        <div class="spec-group-head">
                            <h4 class="spec-group-title">${esc(group.title)}</h4>
                        </div>
                        <dl class="spec-group-list">
                            ${(group.fields || []).map(field => `
                                                                    <div class="spec-group-item">
                                                                        <dt>${esc(field.label)}</dt>
                                                                        <dd>${esc(field.value)}${field.unit ? ` <span class="key-spec-unit">${esc(field.unit)}</span>` : ''}</dd>
                                                                    </div>
                                                                `).join('')}
                        </dl>
                    </div>
                `).join('');

                otherDetailsContent.innerHTML = html;
            }

            function renderDownloadTypeOptions(types) {
                const options = [
                    `<option value="">Select type...</option>`,
                    `<option value="__all__">All Files</option>`,
                    ...types.map(type => `<option value="${esc(type.type)}">${esc(type.label)}</option>`)
                ];
                fileTypeSelect.innerHTML = options.join('');
            }

            function renderDownloadLinks(typeValue) {
                if (!typeValue) {
                    downloadLinksContainer.innerHTML =
                        `<p class="empty-state">Choose a file type to view downloads.</p>`;
                    downloadAllWrap.classList.add('d-none');
                    return;
                }

                let files = [];
                if (typeValue === '__all__') {
                    files = cachedFileTypes.flatMap(type => type.files || []);
                    files.sort((a, b) => String(a.title || '').localeCompare(String(b.title || '')));
                } else {
                    const selectedType = cachedFileTypes.find(type => type.type === typeValue);
                    files = selectedType ? (selectedType.files || []) : [];
                }

                if (!files.length) {
                    downloadLinksContainer.innerHTML =
                        `<p class="empty-state">No downloadable files available for this selection.</p>`;
                    downloadAllWrap.classList.add('d-none');
                    return;
                }

                const listHtml = `
                    <div class="download-list">
                        ${files.map(file => `
                                                                <a class="download-item" href="${esc(file.download_url)}">
                                                                    <span class="download-item-title">${esc(file.title || 'Download File')}</span>
                                                                    <span class="download-item-meta">${esc(file.mime_type || 'File')}</span>
                                                                </a>
                                                            `).join('')}
                    </div>
                `;

                downloadLinksContainer.innerHTML = listHtml;
                downloadAllWrap.classList.toggle('d-none', typeValue !== '__all__' || cachedAllFilesCount === 0);
            }

            async function loadOtherDetails() {
                if (hasLoadedOtherSpecs) {
                    renderOtherDetails(cachedOtherGroups);
                    return;
                }

                otherDetailsLoading.classList.remove('d-none');
                otherDetailsError.classList.add('d-none');

                try {
                    const response = await fetch(otherDetailsUrl, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();
                    cachedOtherGroups = data.groups || [];
                    hasLoadedOtherSpecs = true;
                    renderOtherDetails(cachedOtherGroups);
                } catch (error) {
                    otherDetailsError.textContent = 'Failed to load additional details.';
                    otherDetailsError.classList.remove('d-none');
                } finally {
                    otherDetailsLoading.classList.add('d-none');
                }
            }

            async function loadFiles() {
                if (hasLoadedFiles) {
                    renderDownloadTypeOptions(cachedFileTypes);
                    renderDownloadLinks('');
                    return;
                }

                downloadsLoading.classList.remove('d-none');
                downloadsError.classList.add('d-none');

                try {
                    const response = await fetch(filesListUrl, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();
                    cachedFileTypes = data.types || [];
                    cachedAllFilesCount = Number(data.all_files_count || 0);
                    hasLoadedFiles = true;

                    renderDownloadTypeOptions(cachedFileTypes);
                    renderDownloadLinks('');
                } catch (error) {
                    downloadsError.textContent = 'Failed to load downloadable files.';
                    downloadsError.classList.remove('d-none');
                } finally {
                    downloadsLoading.classList.add('d-none');
                }
            }

            otherDetailsBtn.addEventListener('click', () => {
                setActivePanel('other');
                loadOtherDetails();
            });

            downloadsBtn.addEventListener('click', () => {
                setActivePanel('downloads');
                loadFiles();
            });

            fileTypeSelect.addEventListener('change', (event) => {
                renderDownloadLinks(event.target.value);
            });

            document.querySelectorAll('.product-thumb').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const src = btn.dataset.image;
                    if (!src) return;

                    const mainImage = document.getElementById('mainProductImage');
                    if (mainImage) {
                        mainImage.classList.add('is-switching');
                        mainImage.src = src;
                        window.setTimeout(() => mainImage.classList.remove('is-switching'), 180);
                    }

                    document.querySelectorAll('.product-thumb').forEach((thumb) => thumb.classList
                        .remove('is-active'));
                    btn.classList.add('is-active');
                });
            });

            const ipBadge = document.querySelector('.product-ip-badge-wrap');
            if (ipBadge) {
                window.setTimeout(() => {
                    ipBadge.classList.add('is-visible');
                }, 1500);
            }

            setActivePanel(null);
        })();
    </script>
@endsection
