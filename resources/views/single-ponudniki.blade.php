@extends('layouts.app')

@php
    $kraj = get_field('kraj');
    $naslov = get_field('naslov');
    $lokacija = get_field('lokacija');
    $telefon = get_field('telefon');
    $email = get_field('email');
    $spletnastran = get_field('spletna_stran');
    $lokacija = get_field('lokacija');
    $izdelki = get_posts([
                'numberposts'	=> -1,
                'post_type'			=> 'izdelki',
                'meta_key'		=> 'ponudnik',
                'meta_value'	=> get_the_ID()
            ]);
    $dostava = get_the_terms( get_the_ID() , 'dostava' );
@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt160 pb80 pt120:sm pb40:sm">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="h2 mb16">{{the_title()}}</h1>
                    @if($kraj)
                        <div class="flex flex--middle mb8">
                            <span class="text--green mr4">
                                @include('icons.map-pin')
                            </span>
                            <span>
                                {{$kraj}}
                            </span>
                        </div>
                    @endif
                    @if($dostava)
                        @foreach($dostava as $vrsta)
                            <div class="flex flex--middle mb8">
                        <span class="text--green mr4">
                            @include('icons.'.get_field('ikona', 'term_'.$vrsta->term_id))
                        </span>
                                <span>
                            {{$vrsta->name}}
                        </span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </section>
    <section>
        <div class="container pt64 pb64 pt32:sm pb32:sm">
            <div class="row flex--center">
                <div class="col-md-8 mb24">
                    <div class="content">
                        {{the_content()}}
                    </div>
                    @if($izdelki && count($izdelki))
                        <h3 class="mb16">Izdelki</h3>
                        <div class="row">
                            @foreach($izdelki as $izdelek)
                                @php
                                    $thumbnail = get_the_post_thumbnail_url($izdelek->ID);
                                    $title = $izdelek->post_title;
                                    $opis = get_field('opis', $izdelek->ID);
                                    $cena = get_field('cena', $izdelek->ID);
                                @endphp
                                <div class="col-lg-4 col-sm-6 mb16 flex--one ">
                                    <a href="{{get_permalink($izdelek->ID)}}"
                                       class="card pt16 pl24 pr24 pb16 height100 width100 gtm-ponudnik-izdelek">
                                        @if($thumbnail)
                                            <img src="{{$thumbnail}}"
                                                 alt="{{$title}}" loading="lazy" class="img">
                                        @endif
                                        @if($title)
                                            <h4 class="mb16">
                                                {{$title}}
                                            </h4>
                                        @endif
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
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    @if($telefon || $email || $spletnastran)
                        <div class="card pl16 pr16 pt16 pb16 mb24">
                            <h3 class="mb16">Kontakti</h3>

                            @if($naslov)
                                <p>
                                    {!! $naslov !!}
                                </p>
                            @endif
                            @if($telefon)
                                <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.phone')
                                    </span>
                                    <a href="tel:{{$telefon}}" target="_blank" rel="noreferrer" class="link--reverse gtm-ponudnik-tel gtm-contact">
                                        {{$telefon}}
                                    </a>
                                </div>
                            @endif
                            @if($email)
                                <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.mail')
                                    </span>
                                    <a href="mailto:{{$email}}" target="_blank" rel="noreferrer" class="link--reverse gtm-ponudnik-email gtm-contact">
                                        {{$email}}
                                    </a>
                                </div>
                            @endif
                            @if($spletnastran)
                                <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.globe')
                                    </span>
                                    <a href="{{$spletnastran}}" target="_blank" rel="noreferrer" class="link--reverse gtm-ponudnik-web gtm-contact">
                                        {{$spletnastran}}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if($lokacija)
                        <script>
                            const loc = {!!  json_encode([
                                    'lat' => $lokacija['lat'],
                                    'lng' => $lokacija['lng'],
                                ]) !!}
                        </script>
                        <div class="card pl16 pr16 pt16 pb16 mb24">
                            <h3 class="mb16">Lokacija</h3>
                            <div id="map" style="width: 100%; height: 260px"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
