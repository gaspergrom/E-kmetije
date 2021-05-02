@php
    $dostava = get_the_terms( $ponudnik->ID , 'dostava' );
    $kraj = get_field('kraj', $ponudnik->ID);
    $excerpt = get_the_excerpt($ponudnik->ID);
    $thumbnail = get_the_post_thumbnail_url($ponudnik->ID);
@endphp
<a href="{{get_the_permalink($ponudnik->ID)}}" class="card width100 height100 gtm-card-ponudniki relative">
    <div class="pt16 pl24 pr24 pb80">
        <h4 class="mb16">{{$ponudnik->post_title}}</h4>
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
            <div class="flex  mb8">
                            <span class="text--green mr4">
                                @include('icons.truck')
                            </span>
                <span style="width: calc(100% - 25px)">
                    {{implode(', ', array_map(function ($vrsta){return $vrsta->name;}, $dostava))}}
                </span>
            </div>
        @endif
        @if($excerpt)
            <p class="mb0">
                {!! wp_trim_words($excerpt, 20, '...') !!}
            </p>
        @endif
        <div class="absolute absolute--bottom absolute--left pt16 pb16 pl16 pr16 width100">
            <div class="btn">
                Poglej več
            </div>
        </div>
    </div>
</a>
