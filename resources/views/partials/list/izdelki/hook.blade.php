@php
    $thumbnail = get_the_post_thumbnail_url();
    $opis = get_field('opis');
    $cena = get_field('cena');
@endphp

<div class="col-lg-4 col-sm-6 mb16">
    <a href="{{the_permalink()}}" class="card pt16 pl24 pr24 pb16 height100 width100">
        @if($thumbnail)
            <img src="{{$thumbnail}}"
                 alt="{{$title}}" loading="lazy" class="img">
        @endif
        <h4 class="mb16">
            {{the_title()}}
        </h4>
        @if($opis)
            <p>
                {{$opis}}
            </p>
        @endif
        @if($cena)
            <h5 class="text-right">
                {{$cena}}
            </h5>
        @endif
    </a>
</div>
