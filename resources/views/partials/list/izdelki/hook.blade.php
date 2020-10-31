@php
    $thumbnail = get_the_post_thumbnail_url();
    $cena = get_field('cena');
    $excerpt = get_the_excerpt();
@endphp

<a href="{{the_permalink()}}" class="card height100 width100 gtm-card-izdelki">
    @if($thumbnail)
        <img src="{{$thumbnail}}" alt="{{the_title()}}" class="width100" style="object-fit: cover; height: 200px;">
    @endif
    <div class="pt16 pl24 pr24 pb24">
        <h5 class="mb8">
            {{the_title()}}
        </h5>
        @if($cena)
            @if($cena['vrsta'] === 'dogovor')
                <p class="text-bold">
                    Cena po dogovoru
                </p>
            @elseif($cena['vrsta'] === 'cena')
                <p class="text-bold">
                    {{$cena['vrednost']}}€
                </p>
            @endif
        @endif
        @if($excerpt)
            <p>
                {!! wp_trim_words($excerpt, 20, '...') !!}
            </p>
        @endif
        <div class="text--green flex flex--middle mt8">
            <span class="text-bold">Poglej podrobnosti</span>
            @include('icons.chevron-right')
        </div>
    </div>
</a>
