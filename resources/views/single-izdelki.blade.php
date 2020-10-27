@extends('layouts.app')

@php
    $id = get_the_ID();
    $ponudnik = get_field('ponudnik');
    $cena = get_field('cena');
    $thumbnail = get_the_post_thumbnail_url();

    if($ponudnik){
        $kraj = get_field('kraj', $ponudnik->ID);
        $naslov = get_field('naslov', $ponudnik->ID);
        $lokacija = get_field('lokacija', $ponudnik->ID);
        $kontakti = get_field('kontakti', $ponudnik->ID);
        $social = get_field('druzbena_omrezja', $ponudnik->ID);
        $dostava = get_the_terms( $ponudnik->ID , 'dostava' );
        $izdelki = get_posts([
            'numberposts'	=> -1,
            'post_type'			=> 'izdelki',
            'meta_key'		=> 'ponudnik',
            'meta_value'	=> $ponudnik->ID
        ]);
    }
@endphp

@section('content')
    @if($ponudnik)
        <section class="bg--image"
                 style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
            <div class="container pt120 pb48 pt120:sm pb40:sm">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb16">{{$ponudnik->post_title}}</h2>
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
                        <div class="pt16">
                            <a href="{{get_permalink($ponudnik->ID)}}" class="btn gtm-izdelek-ponudnik">
                                Poglej ponudnika
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container pt64 pb64 pt32:sm pb32:sm">
            <div class="row flex--center">
                <div class="col-md-8 mb24">
                    <div class="row mb64">
                        @if($thumbnail)
                            <div class="col-md-4 mb16:sm">
                                <img src="{{$thumbnail}}" alt="{{the_title()}}" class="img">
                            </div>
                        @endif
                        <div class="col-md-8">
                            <h1 class="h3 mb8">{{the_title()}}</h1>
                            <div class="content">
                                {{the_content()}}
                            </div>
                            @if($cena)
                                <h5>{{$cena}}</h5>
                            @endif
                        </div>
                    </div>
                    @if($ponudnik && $izdelki && count($izdelki) > 1)
                        <h3 class="mb16">Ostali izdelki ponudnika</h3>
                        <div class="row">
                            @foreach($izdelki as $izdelek)
                                @if($id !== $izdelek->ID)
                                    @php
                                        $thumbnail = get_the_post_thumbnail_url($izdelek->ID);
                                        $title = $izdelek->post_title;
                                        $opis = get_field('opis', $izdelek->ID);
                                        $cena = get_field('cena', $izdelek->ID);
                                    @endphp
                                    <div class="col-lg-4 col-sm-6 mb16 flex--one">
                                        <a href="{{get_permalink($izdelek->ID)}}"
                                           class="card pt16 pl24 pr24 pb16 height100 width100 gtm-izdelek-other">
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
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @if($ponudnik)
                    <div class="col-md-4">
                        @if($naslov && $kontakti && count($kontakti))
                            <div class="card pl16 pr16 pt16 pb16 mb24">
                                <h3 class="mb16">Kontakti</h3>

                                @if($naslov)
                                    <p>
                                        {!! $naslov !!}
                                    </p>
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
                                <div class="card pl16 pr16 pt16 pb16 mb24">
                                    <h3 class="mb16">Lokacija</h3>
                                    <div id="map" style="width: 100%; height: 260px"></div>
                                </div>
                            @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
