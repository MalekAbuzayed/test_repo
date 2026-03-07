@forelse ($products as $product)
    @php
        $primaryImage = $product->files->first();
        $imageUrl = $primaryImage ? asset('storage/' . ltrim($primaryImage->path, '/')) : null;
    @endphp
    <a class="product-card product-card-link" href="{{ route('product', ['id' => $product->id]) }}">
        <article>
            <div class="product-media">
                @if ($imageUrl)
                    <img src="{{ $imageUrl }}" alt="{{ $product->title }}" />
                @else
                    <img src="https://picsum.photos/seed/product-{{ $product->id }}/900/650" alt="Product placeholder" />
                @endif
            </div>
            <div class="product-body">
                <p class="product-type">Category: {{ $product->category?->name ?? 'N/A' }}</p>
                <h3 class="product-title">{{ $product->title }}</h3>
                <p class="product-name">Subcategory: {{ $product->subcategory?->name ?? 'N/A' }}</p>
                <p class="product-name">Grandchild: {{ $product->grandchild?->name ?? 'N/A' }}</p>
                <p class="product-desc">
                    {{ \Illuminate\Support\Str::limit($product->description, 140) }}
                </p>
            </div>
        </article>
    </a>
@empty
    <div class="col-12 text-muted">No products found.</div>
@endforelse
