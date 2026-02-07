@extends('user.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/style_files/user/product.css') }}?v=2">
@endsection

@section('content')
    <!-- ================== PRODUCT PAGE ================== -->
    <main class="section product-page" id="product">
        <div class="container">
            @php
                $hasImage = $product->image && file_exists($product->image);
                $filePath = $product->file ? str_replace('\\', '/', $product->file) : null;
                $hasFile = $filePath && (file_exists(public_path($filePath)) || file_exists(base_path($filePath)));
                $fileUrl = $hasFile ? route('product.file', ['id' => $product->id]) : null;
                $isPdf = $hasFile && $filePath && \Illuminate\Support\Str::endsWith(strtolower($filePath), '.pdf');
            @endphp

            <!-- Header -->
            <div class="product-head reveal">
                <div>
                    <span class="eyebrow">Placeholder for product hierarchy - this will be a link</span>
                    <h2>{{ $product->title ?? $product->name }}</h2>
                    <p class="subtext product-sub">
                        {{ \Illuminate\Support\Str::limit($product->description, 180) }}
                    </p>
                </div>
            </div>

            <section class="product-detail reveal" aria-label="Product details">
                <div class="product-detail-media">
                    @if ($hasImage)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->title ?? $product->name }}" />
                    @else
                        <img src="https://picsum.photos/seed/product-{{ $product->id }}/1200/800"
                            alt="Product placeholder" />
                    @endif
                </div>

                <div class="product-detail-body">
                    <p class="product-type">Type: {{ $product->type }}</p>
                    <h3 class="product-title">{{ $product->title ?? $product->name }}</h3>
                    <p class="product-name">Name: {{ $product->name }}</p>
                    <p class="product-desc">
                        {{ $product->description }}
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
                            <dt>Type</dt>
                            <dd>{{ $product->type }}</dd>
                        </div>
                        <div class="field">
                            <dt>Category</dt>
                            <dd>{{ $category?->title ?? '—' }}</dd>
                        </div>
                    </dl>

                    <div class="product-detail-actions">
                        <a href="#" class="btn btn-primary">Request Quote</a>
                        @if ($hasFile)
                            <a href="{{ $fileUrl }}" class="btn btn-outline" target="_blank">Download Specs</a>
                        @else
                            <a href="#" class="btn btn-outline disabled" aria-disabled="true">Download Specs</a>
                        @endif
                    </div>
                </div>
            </section>

            <section class="product-specs reveal" aria-label="Product specifications">
                <div class="product-pdf-head">
                    <h3>Specifications</h3>
                    <p class="product-pdf-sub">Technical details for this product.</p>
                </div>
                <div class="product-pdf-frame">
                    <dl class="product-fields">
                        @forelse ($specs as $spec)
                            <div class="field">
                                <dt>{{ $spec->spec_title }}</dt>
                                <dd>{{ $spec->spec_desc }}</dd>
                            </div>
                        @empty
                            <div class="field">
                                <dt>Specs</dt>
                                <dd class="text-muted">No specifications available.</dd>
                            </div>
                        @endforelse
                    </dl>
                </div>
            </section>

            <section class="product-pdf reveal" aria-label="Product PDF">
                <div class="product-pdf-head">
                    <h3>Product File (PDF)</h3>
                    <p class="product-pdf-sub">
                        @if ($hasFile)
                            {{ basename($filePath) }}
                        @else
                            No file available.
                        @endif
                    </p>
                </div>
                <div class="product-pdf-frame">
                    @if ($isPdf)
                        <iframe src="{{ $fileUrl }}" title="Product PDF"></iframe>
                    @else
                        <div class="product-pdf-placeholder">
                            PDF preview will appear here once the file is available.
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </main>
@endsection
