@php
    $thumbnail = get_the_post_thumbnail_url($izdelek->ID);
    $cena = get_field('cena', $izdelek->ID);
    $ponudnik = get_field('ponudnik',  $izdelek->ID);
    $ponudnik = property_exists($ponudnik, 'ID') ? $ponudnik : get_post($ponudnik);
    $excerpt = get_the_excerpt($izdelek->ID);
@endphp

<div class="card height100 width100 gtm-card-izdelki">
    @if($thumbnail)
        <img src="{{$thumbnail}}" alt="{{$izdelek->post_title}}" class="width100"
             style="object-fit: cover; height: 200px;">
    @endif
    <div class="pt16 pl24 pr24 pb24">
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
                {!! wp_trim_words($excerpt, 10, '...') !!}
            </p>
        @endif
        <a href="{{the_permalink($izdelek->ID)}}" class="text--green flex flex--middle mt8">
            <span class="text-bold">Poglej podrobnosti</span>
            @include('icons.chevron-right')
        </a>
    </div>
</div>
