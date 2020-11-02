@php
    $header = get_field('header');
@endphp
<section class="bg--image"
         style="background-image: url(@asset('images/banner.jpg')); background-position: 50% 40%">
    <div class="container pt120 pb48 pt120:sm pb48:sm">
        <div class="row">
            <div class="col-md-7">
                <h1 class="h2">{{$header['title']}}</h1>
                @if($header['description'])
                    <p class="mb16">
                        {{$header['description']}}
                    </p>
                @endif
                @if($header['cta'])
                    <div class="">
                        <a href="{{$header['cta']['url']}}" target="{{$header['cta']['target']}}" class="btn gtm-main-header-cta">
                            {{$header['cta']['title']}}
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
