@php
    $excerpt = get_the_excerpt($nastanitev->ID);
    $thumbnail = get_the_post_thumbnail_url($nastanitev->ID);
    $cena = get_field('cena', $nastanitev->ID);
@endphp
  <div class="card height100 width100 gtm-card-izdelki">
    @if($thumbnail)
      <img src="{{$thumbnail}}" alt="{{$nastanitev->post_title}}" class="width100"
           style="object-fit: cover; height: 200px;">
    @endif
    <div class="pt16 pl24 pr24 pb24">
      <h5 class="mb8 mt8">
        {{$nastanitev->post_title}}
      </h5>
      @if($excerpt)
        <p>
          {!! wp_trim_words($excerpt, 20, '...') !!}
        </p>
      @endif
      @if($cena)
      <p class="text-bold">
        {{$cena}}€ / noč
      </p>
      @endif
      <a href="{{get_the_permalink($nastanitev->ID)}}" class="text--green flex flex--middle mt8">
        <span class="text-bold">Poglej podrobnosti</span>
        @include('icons.chevron-right')
      </a>
    </div>
  </div>

