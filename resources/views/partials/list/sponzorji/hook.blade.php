@php
    $thumbnail = get_the_post_thumbnail_url();
    $excerpt = get_the_excerpt();
@endphp

<div class="col-lg-4 col-sm-6 mb16">
    <a href="{{the_permalink()}}" class="card pt16 pl24 pr24 pb16 height100 width100 gtm-card-izdelki">
        @if($thumbnail)
            <img src="{{$thumbnail}}" alt="{{the_title()}}">
        @endif
        <h5 class="mb8 mt8">
            {{the_title()}}
        </h5>
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
