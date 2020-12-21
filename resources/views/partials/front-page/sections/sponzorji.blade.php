@php
    $sponzorji = get_posts([
         'post_type' => 'sponzorji',
         'numberposts' => -1
    ]);
@endphp
<section>
    <div class="container pt24 pb24">
        <div class="owl owl-carousel" id="sponzorjicarousel">
            @foreach($sponzorji as $sponzor)
                <div class="item pl16 pr16">
                    <a href="{{get_the_permalink($sponzor->ID)}}" class="block">
                        <img src="{{get_the_post_thumbnail_url($sponzor->ID)}}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
