@php
    $thumbnail = get_the_post_thumbnail_url();
    $cena = get_field('cena');
    $ponudnik = get_field('ponudnik');
    $ponudnik = property_exists($ponudnik, 'ID') ? $ponudnik : get_post($ponudnik);
    $excerpt = get_the_excerpt();
@endphp

<div class="card height100 width100 gtm-card-izdelki">
    @if($thumbnail)
        <img src="{{$thumbnail}}" alt="{{the_title()}}" class="width100" style="object-fit: cover; height: 200px;">
    @endif
    <div class="pt16 pl24 pr24 pb24">
        <h5 class="mb8">
            {{the_title()}}
        </h5>
        <p>
            <a href="{{get_permalink($ponudnik->ID)}}">
                {{$ponudnik->post_title}}
            </a>
        </p>
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
        <a href="{{the_permalink()}}" class="text--green flex flex--middle mt8">
            <span class="text-bold">Poglej podrobnosti</span>
            @include('icons.chevron-right')
        </a>
    </div>
</div>
