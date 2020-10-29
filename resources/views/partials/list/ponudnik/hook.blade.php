@php
    $dostava = get_the_terms( get_the_ID() , 'dostava' );
    $kraj = get_field('kraj');
    $excerpt = get_the_excerpt();
@endphp
<div class="col-lg-4 col-md-6 flex--one mb16">
    <a href="{{the_permalink()}}"
       class="card pt32 pl24 pr24 pb32 width100 height100 gtm-card-ponudniki">
        <h4 class="mb16">{{the_title()}}</h4>
        @if($kraj)
            <div class="flex mb8">
                <span class="text--green mr4">
                    @include('icons.map-pin')
                </span>
                <span style="width: calc(100% - 25px)">
                    {{$kraj}}
                </span>
            </div>
        @endif
        @if($dostava)
            <div class="flex mb8">
                <span class="text--green mr4">
                    @include('icons.truck')
                </span>
                <span style="width: calc(100% - 25px)">
                    {{implode(', ', array_map(function ($vrsta){return $vrsta->name;}, $dostava))}}
                </span>
            </div>
        @endif
        @if($excerpt)
            <p>
                {!! wp_trim_words($excerpt, 20, '...') !!}
            </p>
        @endif
        <div class="flex pt16">
            <button class="btn">
                Poglej več
            </button>
        </div>
    </a>
</div>
