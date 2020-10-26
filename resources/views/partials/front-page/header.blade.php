@php
    $header = get_field('header');
@endphp
<section class="bg--image"
         style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/banner-1.jpg); background-position: 50% 40%">
    <div class="container pt160 pb80 pt120:sm pb48:sm">
        <h1 class="mb8">{{$header['title']}}</h1>
        @if($header['description'])
            <p class="h5 mb24">
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
</section>
