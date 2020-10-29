@php
    $thumbnail = get_the_post_thumbnail_url($izdelek->ID);
    $cena = get_field('cena', $izdelek->ID);
    $excerpt = get_the_excerpt($izdelek->ID);
@endphp

<div class="col-lg-4 col-sm-6 mb16">
    <a href="{{the_permalink($izdelek->ID)}}" class="card pt16 pl24 pr24 pb16 height100 width100 gtm-card-izdelki">
        @if($thumbnail)
            <div style="background-image:url({{$thumbnail}}); " class="quadric bg--image">
            </div>
        @endif
        <h5 class="mb8 mt8">
            {{$izdelek->post_title}}
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
    </a>
</div>
