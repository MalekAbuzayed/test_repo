@php
    $title = $title ?? '';
    $subtitle = $subtitle ?? null;
    $eyebrow = $eyebrow ?? null;
    $backgroundImage = $backgroundImage ?? null;
@endphp

<section class="page-hero" @if ($backgroundImage) style="--hero-bg: url('{{ $backgroundImage }}');" @endif>
    <div class="page-hero__inner container">
        @if ($eyebrow)
            <span class="page-hero__eyebrow">{{ $eyebrow }}</span>
        @endif

        <h1 class="page-hero__title">{{ $title }}</h1>

        @if ($subtitle)
            <p class="page-hero__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
</section>
