@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/style_files/user/product.css') }}">
@endsection

@section('content')
    <!-- ================== PRODUCT PAGE ================== -->
    <main class="section product-page" id="product">
        <div class="container">

            <!-- Header -->
            <div class="product-head reveal">
                <div>
                    <span class="eyebrow">PRODUCT</span>
                    <h2>Atlas 550W Mono PERC</h2>
                    <p class="subtext product-sub">
                        Placeholder details aligned to the products schema: name, type, title, description, image, file,
                        status.
                    </p>
                </div>

                <div class="product-head-right">
                    <div class="results-pill">Status: Active</div>
                </div>
            </div>

            <section class="product-detail reveal" aria-label="Product details">
                <div class="product-detail-media">
                    <span class="product-badge status-active">Active</span>
                    <span class="product-image-label">Image: atlas-550.jpg</span>
                    <img src="https://picsum.photos/seed/solar-panel/1200/800" alt="Solar panel placeholder" />
                </div>

                <div class="product-detail-body">
                    <p class="product-type">Type: panels</p>
                    <h3 class="product-title">Atlas 550W Mono PERC</h3>
                    <p class="product-name">Name: atlas-550-mono</p>
                    <p class="product-desc">
                        High-efficiency panel designed for commercial rooftops and large installations. Built for
                        durability, high output, and long-term performance under demanding conditions.
                    </p>

                    <dl class="product-fields">
                        <div class="field">
                            <dt>File</dt>
                            <dd><a class="file-link" href="#">atlas-550-specs.pdf</a></dd>
                        </div>
                        <div class="field">
                            <dt>Type</dt>
                            <dd>panels</dd>
                        </div>
                    </dl>

                    <div class="product-detail-actions">
                        <a href="#" class="btn btn-primary">Request Quote</a>
                        <a href="#" class="btn btn-outline">Download Specs</a>
                    </div>
                </div>
            </section>

            <section class="product-pdf reveal" aria-label="Product PDF">
                <div class="product-pdf-head">
                    <h3>Product File (PDF)</h3>
                    <p class="product-pdf-sub">
                        Placeholder area for the PDF file that will be loaded via the controller.
                    </p>
                </div>
                <div class="product-pdf-frame">
                    <div class="product-pdf-placeholder">
                        PDF preview will appear here once the file is available.
                    </div>
                </div>
            </section>

        </div>
    </main>
@endsection
