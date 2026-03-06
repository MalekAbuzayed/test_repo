@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('style_files/user/product.css') }}?v=3">
@endsection

@section('content')
    <main class="section product-page" id="product">
        <div class="container">
            <div class="product-head reveal">
                <div>
                    <span class="eyebrow">{{ $product->category?->name ?? 'Products' }}</span>
                    <h2>{{ $product->title }}</h2>
                    <p class="subtext product-sub">
                        {{ \Illuminate\Support\Str::limit($product->description, 180) }}
                    </p>
                </div>
            </div>

            <section class="product-detail reveal" aria-label="Product details">
                <div class="product-detail-media">
                    @php
                        $primaryImage = $images->first();
                    @endphp

                    @if ($primaryImage)
                        <img id="mainProductImage" src="{{ asset('storage/' . ltrim($primaryImage->path, '/')) }}"
                            alt="{{ $product->title }}" />
                    @else
                        <img id="mainProductImage" src="https://picsum.photos/seed/product-{{ $product->id }}/1200/800"
                            alt="Product placeholder" />
                    @endif

                    @if ($images->count() > 1)
                        <div class="product-thumb-row">
                            @foreach ($images as $img)
                                <button class="product-thumb @if ($loop->first) is-active @endif" type="button"
                                    data-image="{{ asset('storage/' . ltrim($img->path, '/')) }}"
                                    aria-label="Show image {{ $loop->iteration }}">
                                    <img src="{{ asset('storage/' . ltrim($img->path, '/')) }}" alt="Thumbnail">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="product-detail-body">
                    <p class="product-type">Subcategory: {{ $product->subcategory?->name ?? 'N/A' }}</p>
                    <h3 class="product-title">{{ $product->title }}</h3>
                    <p class="product-desc">{{ $product->description }}</p>

                    <div class="key-specs-block">
                        <h4 class="key-specs-title">Key Specifications</h4>
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

            <section class="product-extra reveal" aria-label="Product extra details">
                <div class="product-extra-tabs">
                    <button type="button" class="btn btn-primary product-tab-btn is-active" id="otherDetailsBtn">
                        Other Details
                    </button>
                    <button type="button" class="btn btn-outline product-tab-btn" id="downloadsBtn">
                        Downloadable Files
                    </button>
                </div>

                <div class="product-extra-panel" id="otherDetailsPanel">
                    <div class="loading-state d-none" id="otherDetailsLoading">Loading other details...</div>
                    <div class="error-state d-none" id="otherDetailsError"></div>
                    <div id="otherDetailsContent"></div>
                </div>

                <div class="product-extra-panel d-none" id="downloadsPanel">
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
                        <a id="downloadAllLink" class="btn btn-primary" href="{{ route('product.files.downloadAll', ['id' => $product->id]) }}">
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
            const productId = @json($product->id);
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

            function setActiveTab(tab) {
                const showOther = tab === 'other';

                otherDetailsBtn.classList.toggle('btn-primary', showOther);
                otherDetailsBtn.classList.toggle('btn-outline', !showOther);
                downloadsBtn.classList.toggle('btn-primary', !showOther);
                downloadsBtn.classList.toggle('btn-outline', showOther);

                otherDetailsBtn.classList.toggle('is-active', showOther);
                downloadsBtn.classList.toggle('is-active', !showOther);

                otherDetailsPanel.classList.toggle('d-none', !showOther);
                downloadsPanel.classList.toggle('d-none', showOther);
            }

            function renderOtherDetails(groups) {
                if (!groups.length) {
                    otherDetailsContent.innerHTML = `<p class="empty-state">No additional specifications available.</p>`;
                    return;
                }

                const html = groups.map(group => `
                    <div class="spec-group-block">
                        <h4 class="spec-group-title">${esc(group.title)}</h4>
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
                    downloadLinksContainer.innerHTML = `<p class="empty-state">Choose a file type to view downloads.</p>`;
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
                    downloadLinksContainer.innerHTML = `<p class="empty-state">No downloadable files available for this selection.</p>`;
                    downloadAllWrap.classList.add('d-none');
                    return;
                }

                const listHtml = `
                    <ol class="download-list">
                        ${files.map(file => `
                            <li>
                                <a class="file-link" href="${esc(file.download_url)}">
                                    ${esc(file.title || 'Download File')}
                                </a>
                            </li>
                        `).join('')}
                    </ol>
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
                    if (!response.ok) throw new Error(`HTTP ${response.status}`);

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
                    if (!response.ok) throw new Error(`HTTP ${response.status}`);

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
                setActiveTab('other');
                loadOtherDetails();
            });

            downloadsBtn.addEventListener('click', () => {
                setActiveTab('downloads');
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
                    if (mainImage) mainImage.src = src;

                    document.querySelectorAll('.product-thumb').forEach((b) => b.classList.remove('is-active'));
                    btn.classList.add('is-active');
                });
            });

            loadOtherDetails();
        })();
    </script>
@endsection
