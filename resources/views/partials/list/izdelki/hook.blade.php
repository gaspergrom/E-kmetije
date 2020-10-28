@php
    $thumbnail = get_the_post_thumbnail_url();
    $cena = get_field('cena');
    $excerpt = get_the_excerpt();
@endphp

<div class="col-lg-4 col-sm-6 mb16">
    <a href="{{the_permalink()}}" class="card pt16 pl24 pr24 pb16 height100 width100 gtm-card-izdelki">
        @if($thumbnail)
            <img src="{{$thumbnail}}"
                 alt="{{the_title()}}" loading="lazy" class="img">
        @endif
        <h4 class="mb16">
            {{the_title()}}
        </h4>
            @if($excerpt)
                <p>
                    {!! wp_trim_words($excerpt, 20, '...') !!}
                </p>
            @endif
        @if($cena)
            @if($cena['vrsta'] === 'dogovor')
                <h5 class="text-right">
                    Po dogovoru
                </h5>
            @elseif($cena['vrsta'] === 'cena')
                <h5 class="text-right">
                    {{$cena['vrednost']}}€
                </h5>
            @endif
        @endif
    </a>
</div>
