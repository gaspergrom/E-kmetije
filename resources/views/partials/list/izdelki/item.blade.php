@php
    $thumbnail = get_the_post_thumbnail_url($izdelek->ID);
    $cena = get_field('cena', $izdelek->ID);
    $excerpt = get_the_excerpt($izdelek->ID);
@endphp

<div class="col-lg-4 col-sm-6 mb16">
    <a href="{{the_permalink($izdelek->ID)}}" class="card pt16 pl24 pr24 pb16 height100 width100 gtm-card-izdelki">
        @if($thumbnail)
            <img src="{{$thumbnail}}"
                 alt="{{$izdelek->post_title}}" loading="lazy" class="img">
        @endif
        <h5 class="mb8 mt8">
            {{$izdelek->post_title}}
        </h5>
            @if($excerpt)
                <p>
                    {!! wp_trim_words($excerpt, 20, '...') !!}
                </p>
            @endif
        @if($cena)
            @if($cena['vrsta'] === 'dogovor')
                <h5 class="text-right">
                    Cena po dogovoru
                </h5>
            @elseif($cena['vrsta'] === 'cena')
                <h5 class="text-right">
                    {{$cena['vrednost']}}€
                </h5>
            @endif
        @endif
    </a>
</div>
