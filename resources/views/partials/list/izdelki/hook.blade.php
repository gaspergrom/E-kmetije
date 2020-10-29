@php
    $thumbnail = get_the_post_thumbnail_url();
    $cena = get_field('cena');
    $excerpt = get_the_excerpt();
@endphp

<div class="col-lg-4 col-sm-6 mb16">
    <a href="{{the_permalink()}}" class="card height100 width100 gtm-card-izdelki">
        @if($thumbnail)
            <div style="background-image:url({{$thumbnail}}); " class="quadric bg--image">
            </div>
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
</div>
