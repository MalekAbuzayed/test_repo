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
                        Placeholder items aligned to the products schema: name, type, title, description, image, file,
                        status.
                    </p>
                </div>

                <div class="products-head-right">
                    <div class="results-pill">3 Products</div>
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
                            <input class="search-input" type="search"
                                placeholder="Search products (name, title, type...)" autocomplete="off" />
                        </div>

                        <div class="toolbar-actions">
                            <button type="button" class="btn btn-primary">Search</button>
                        </div>
                    </div>

                    <div class="products-grid">
                    <article class="product-card">
                        <div class="product-media">
                            <span class="product-badge status-active">Active</span>
                            <span class="product-image-label">Image: atlas-550.jpg</span>
                            <img src="https://picsum.photos/seed/solar-panel/900/650" alt="Solar panel placeholder" />
                        </div>
                        <div class="product-body">
                            <p class="product-type">Type: panels</p>
                            <h3 class="product-title">Atlas 550W Mono PERC</h3>
                            <p class="product-name">Name: atlas-550-mono</p>
                            <p class="product-desc">
                                High-efficiency panel designed for commercial rooftops and large installations.
                            </p>
                            <dl class="product-fields">
                                <div class="field">
                                    <dt>File</dt>
                                    <dd><a class="file-link" href="#">atlas-550-specs.pdf</a></dd>
                                </div>
                            </dl>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-media">
                            <span class="product-badge status-active">Active</span>
                            <span class="product-image-label">Image: helios-8k.jpg</span>
                            <img src="https://picsum.photos/seed/inverter/900/650" alt="Inverter placeholder" />
                        </div>
                        <div class="product-body">
                            <p class="product-type">Type: inverters</p>
                            <h3 class="product-title">Helios 8k Hybrid Inverter</h3>
                            <p class="product-name">Name: helios-8k-hybrid</p>
                            <p class="product-desc">
                                Grid-tied hybrid inverter with battery-ready ports and smart monitoring.
                            </p>
                            <dl class="product-fields">
                                <div class="field">
                                    <dt>File</dt>
                                    <dd><a class="file-link" href="#">helios-8k-datasheet.pdf</a></dd>
                                </div>
                            </dl>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-media">
                            <span class="product-badge status-inactive">Inactive</span>
                            <span class="product-image-label">Image: pulse-10kwh.jpg</span>
                            <img src="https://picsum.photos/seed/battery/900/650" alt="Battery placeholder" />
                        </div>
                        <div class="product-body">
                            <p class="product-type">Type: batteries</p>
                            <h3 class="product-title">Pulse 10kWh Battery Pack</h3>
                            <p class="product-name">Name: pulse-10kwh</p>
                            <p class="product-desc">
                                Stackable lithium storage system with integrated BMS and safety monitoring.
                            </p>
                            <dl class="product-fields">
                                <div class="field">
                                    <dt>File</dt>
                                    <dd><a class="file-link" href="#">pulse-10kwh-manual.pdf</a></dd>
                                </div>
                            </dl>
                        </div>
                    </article>
                    </div>
                </section>
            </div>

        </div>
    </main>
@endsection
