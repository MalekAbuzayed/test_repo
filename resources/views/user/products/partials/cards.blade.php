@forelse ($products as $product)
    @php
        $primaryImage = $product->files->first();
        $imageUrl = $primaryImage ? asset('storage/' . ltrim($primaryImage->path, '/')) : null;
        $categoryName = $product->category?->name ?? 'N/A';
        $subcategoryName = $product->subcategory?->name ?? 'N/A';
        $grandchildName = $product->grandchild?->name ?? 'N/A';
    @endphp
    <a class="prod-card product-card-link" href="{{ route('product', ['id' => $product->id]) }}">
        <article>
            <div class="prod-img">
                @if ($imageUrl)
                    <img src="{{ $imageUrl }}" alt="{{ $product->title }}">
                @else
                    <img src="https://picsum.photos/seed/product-{{ $product->id }}/900/650" alt="Product placeholder">
                @endif
                <span class="prod-img-label">{{ $grandchildName !== 'N/A' ? $grandchildName : $subcategoryName }}</span>
            </div>
            <div class="prod-body">
                <p class="prod-cat">{{ $categoryName }} / {{ $subcategoryName }}</p>
                <h3 class="prod-name">{{ $product->title }}</h3>
                <p class="prod-model">{{ $grandchildName }}</p>
                <p class="prod-desc">{{ \Illuminate\Support\Str::limit($product->description, 140) }}</p>
                <div class="prod-footer">
                    <div class="prod-meta">
                        <span>{{ $categoryName }}</span>
                        <span>{{ $grandchildName }}</span>
                    </div>
                    <span class="prod-btn">Details</span>
                </div>
            </div>
        </article>
    </a>
@empty
    <div class="no-results">
        <h3>No products found</h3>
        <p>Try clearing the current filters or selecting a different category path.</p>
    </div>
@endforelse
