@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/style_files/user/products.css') }}">
@endsection

@section('content')
    <!-- ================== PRODUCTS PAGE ================== -->
    <main class="section products-page" id="products">
        <div class="container">

            <!-- Header -->
            <div class="products-head reveal">
                <div>
                    <span class="eyebrow">PRODUCTS</span>
                    <h2>Products Catalog</h2>
                    <p class="subtext products-sub">
                        Explore our latest products and specifications.
                    </p>
                </div>

                <div class="products-head-right">
                    <div class="results-pill">{{ $products->count() }} Products</div>
                </div>
            </div>

            <div class="products-layout reveal">
                <aside class="products-filters" aria-label="Product filters">
                    <div class="filter-card">
                        <h3 class="filter-title">Filter by Type</h3>
                        <p class="filter-hint">Select one or more types to narrow the list later.</p>

                        <div class="filter-group">
                            <label class="filter-item">
                                <input class="filter-check" type="checkbox" value="panels" checked />
                                <span>Panels</span>
                            </label>

                            <label class="filter-item">
                                <input class="filter-check" type="checkbox" value="inverters" checked />
                                <span>Inverters</span>
                            </label>

                            <label class="filter-item">
                                <input class="filter-check" type="checkbox" value="batteries" checked />
                                <span>Batteries</span>
                            </label>

                            <label class="filter-item">
                                <input class="filter-check" type="checkbox" value="other" checked />
                                <span>Other</span>
                            </label>
                        </div>

                        <div class="filter-actions">
                            <button type="button" class="btn btn-outline">Clear</button>
                            <button type="button" class="btn btn-primary">Select All</button>
                        </div>
                    </div>

                    <div class="filter-card filter-card-soft">
                        <h3 class="filter-title">Need a full system?</h3>
                        <p class="filter-hint" style="margin-bottom: 14px;">
                            Request a complete solution including design, installation, and support.
                        </p>
                        <a href="#" class="btn btn-primary filter-full-btn">Request Quote</a>
                    </div>
                </aside>

                <section class="products-main" aria-label="Products list">
                    <div class="products-toolbar">
                        <div class="search-wrap">
                            <input class="search-input" type="search" placeholder="Search products (name, title, type...)"
                                autocomplete="off" />
                        </div>

                        <div class="toolbar-actions">
                            <button type="button" class="btn btn-primary">Search</button>
                        </div>
                    </div>

                    <div class="products-grid">
                        @forelse ($products as $product)
                            @php
                                $hasImage = $product->image && file_exists($product->image);
                                $filePath = $product->file ? str_replace('\\', '/', $product->file) : null;
                                $hasFile =
                                    $filePath &&
                                    (file_exists(public_path($filePath)) || file_exists(base_path($filePath)));
                                $fileUrl = $hasFile ? route('product.file', ['id' => $product->id]) : null;
                            @endphp
                            <article class="product-card">
                                <div class="product-media">
                                    @if ($hasImage)
                                        <img src="{{ asset($product->image) }}"
                                            alt="{{ $product->title ?? $product->name }}" />
                                    @else
                                        <img src="https://picsum.photos/seed/product-{{ $product->id }}/900/650"
                                            alt="Product placeholder" />
                                    @endif
                                </div>
                                <div class="product-body">
                                    <p class="product-type">Type: {{ $product->type }}</p>
                                    <h3 class="product-title">
                                        <a href="{{ route('product', ['id' => $product->id]) }}">
                                            {{ $product->title ?? $product->name }}
                                        </a>
                                    </h3>
                                    <p class="product-name">Name: {{ $product->name }}</p>
                                    <p class="product-desc">
                                        {{ \Illuminate\Support\Str::limit($product->description, 140) }}
                                    </p>
                                    <dl class="product-fields">
                                        <div class="field">
                                            <dt>File</dt>
                                            <dd>
                                                @if ($hasFile)
                                                    <a class="file-link" href="{{ $fileUrl }}" target="_blank">
                                                        {{ basename($filePath) }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Not available</span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div class="field">
                                            <dt>Category</dt>
                                            <dd>{{ optional($product->category)->title ?? '—' }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </article>
                        @empty
                            <div class="col-12 text-muted">No products found.</div>
                        @endforelse
                    </div>
                </section>
            </div>

        </div>
    </main>
@endsection
