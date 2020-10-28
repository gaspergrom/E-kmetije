@extends('layouts.app')

@php
    $kraj = get_field('kraj');
    $ulica = get_field('ulica');
    $postna_stevilka = get_field('postna_stevilka');
    $lokacija = get_field('lokacija');
    $kontakti = get_field('kontakti');
    $social = get_field('druzbena_omrezja');
    $image = get_the_post_thumbnail_url();
    $izdelki = get_posts([
                'numberposts'	=> -1,
                'post_type'			=> 'izdelki',
                'meta_key'		=> 'ponudnik',
                'meta_value'	=> get_the_ID()
            ]);
    $dostava = get_the_terms( get_the_ID() , 'dostava' );
@endphp

@section('content')
    <div itemtype="http://schema.org/Store" itemscope>
        <section class="bg--image"
                 style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
            <div class="container pt120 pb48 pt120:sm pb40:sm">
                <div class="row">
                    <div class="col-md-8">
                        <meta itemprop="@id" content="{{the_permalink()}}"/>
                        @if($image)
                            <link itemprop="image" href="{{$image}}"/>
                        @endif
                        @if(!$izdelki && !$image)
                            <link itemprop="image" href="https://e-kmetije.si/wp-content/uploads/social-thumbnail.png"/>
                        @endif
                        <meta itemprop="priceRange" content="$"/>
                        <h1 class="h2 mb16" itemprop="name">{{the_title()}}</h1>
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
                        <div class="content" itemprop="description">
                            {{the_content()}}
                        </div>

                        <h3 class="mb16">Izdelki</h3>
                        <div class="row">
                            @if($izdelki && count($izdelki))
                                @foreach($izdelki as $izdelek)
                                    @php
                                        $thumbnail = get_the_post_thumbnail_url($izdelek->ID);
                                        $title = $izdelek->post_title;
                                        $opis = get_field('opis', $izdelek->ID);
                                        $cena = get_field('cena', $izdelek->ID);
                                    @endphp
                                    @if($thumbnail)
                                        <link itemprop="image" href="{{$thumbnail}}"/>
                                    @endif
                                    @include('partials.list.izdelki.item', ['izdelek' => $izdelek])
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <h5>Trenutno še ni dodanih izdelkov</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if($ulica && $kraj && $postna_stevilka || $kontakti && count($kontakti))
                            <div class="card pl16 pr16 pt16 pb16 mb24">
                                <h3 class="mb16">Kontakti</h3>

                                @if($ulica && $kraj && $postna_stevilka)
                                    <div itemprop="address" itemtype="http://schema.org/PostalAddress" itemscope>
                                        <p>
                                            <span itemprop="streetAddress">{{ $ulica }}</span>,<br>
                                            <span itemprop="postalCode">{{ $postna_stevilka }}</span> <span
                                                    itemprop="addressLocality">{{ $kraj }}</span>
                                            <meta itemprop="addressCountry" content="SI">
                                        </p>
                                    </div>
                                @endif
                                @foreach($kontakti as $kontakt)
                                    @if($kontakt['vrsta'] === 'tel')
                                        <div class="flex flex--middle mb8">
                                        <span class="text--green mr4">
                                            @include('icons.phone')
                                        </span>
                                            <a href="tel:{{$kontakt['kontakt']}}" target="_blank" rel="noreferrer"
                                               class="link--reverse gtm-ponudnik-tel gtm-contact">
                                                {{$kontakt['kontakt']}}
                                            </a>

                                        </div>
                                        <meta itemprop="telephone" content="{{$kontakt['kontakt']}}">
                                    @elseif($kontakt['vrsta'] === 'email')
                                        <div class="flex flex--middle mb8">
                                        <span class="text--green mr4">
                                            @include('icons.mail')
                                        </span>
                                            <a href="mailto:{{$kontakt['kontakt']}}" target="_blank" rel="noreferrer"
                                               class="link--reverse gtm-ponudnik-email gtm-contact">
                                                {{$kontakt['kontakt']}}
                                            </a>

                                        </div>
                                        <meta itemprop="email" content="{{$kontakt['kontakt']}}">
                                    @elseif($kontakt['vrsta'] === 'web')
                                        <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.globe')
                                    </span>
                                            <a href="{{$kontakt['kontakt']}}" target="_blank" rel="noreferrer"
                                               class="link--reverse gtm-ponudnik-web gtm-contact">
                                                {{$kontakt['kontakt']}}
                                            </a>

                                        </div>
                                        <meta itemprop="url" content="{{$kontakt['kontakt']}}">
                                    @endif
                                @endforeach
                                @if($social && count($social))
                                    <div class="pt16">
                                        <h6 class="mb4">Družabna omrežja</h6>
                                        <div class="flex">
                                            @foreach($social as $soc)
                                                <a href="{{$soc['povezava']}}" target="_blank" rel="noreferrer"
                                                   aria-label="{{$soc['platforma']}}"
                                                   class="btn btn--icon btn--small gtm-ponudnik-social mr8">
                                                    @if($soc['platforma'] === 'facebook')
                                                        @include('icons.facebook')
                                                    @elseif($soc['platforma'] === 'instagram')
                                                        @include('icons.instagram')
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
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
                            <div itemprop="geo" itemtype="http://schema.org/GeoCoordinates" itemscope>
                                <meta itemprop="latitude" content="{{$lokacija['lat']}}">
                                <meta itemprop="longitude" content="{{$lokacija['lng']}}">
                            </div>
                            <div class="card pl16 pr16 pt16 pb16 mb24">
                                <h3 class="mb16">Lokacija</h3>
                                <div id="map" style="width: 100%; height: 260px"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
