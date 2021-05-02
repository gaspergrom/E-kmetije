@extends('layouts.app')

@php
    $kraj = get_field('kraj');
    $ulica = get_field('ulica');
    $postna_stevilka = get_field('postna_stevilka');
    $lokacija = get_field('lokacija');
    $kontakti = get_field('kontakti');
    $social = get_field('druzbena_omrezja');
    $nastanitve = get_posts([
                'numberposts'	=> -1,
                'post_type'			=> 'nastanitve',
                'meta_key'		=> 'ponudnik',
                'meta_value'	=> get_the_ID()
            ]);
@endphp

@section('content')
    <div>
        <section class="bg--image"
                 style="background-image: url(@asset('images/banner.jpg'))">
            <div class="container pt120 pb48 pt120:sm pb40:sm">
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

                        <h3 class="mb16">Nastanitve</h3>
                        <div class="row">
                          @if($nastanitve && count($nastanitve))
                            @foreach($nastanitve as $nastanitev)
                              @php
                                $title = $nastanitev->post_title;
                                $opis = get_the_excerpt($nastanitev->ID);
                                $cena = get_field('cena', $nastanitev->ID);
                              @endphp
                              <div class="col-lg-4 col-sm-6 mb16">
                                @include('partials.list.turisticni-ponudnik.item', ['nastanitev' => $nastanitev])
                              </div>
                            @endforeach
                          @else
                            <div class="col-md-12">
                              <h5>Trenutno še ni dodanih nastanitev</h5>
                            </div>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if($ulica && $kraj && $postna_stevilka || $kontakti && count($kontakti))
                            <div class="card pl16 pr16 pt16 pb16 mb24">
                                <h4 class="mb16">Kontakti</h4>

                                @if($ulica && $kraj && $postna_stevilka)
                                    <div>
                                        <p>
                                            <span>{{ $ulica }}</span>,<br>
                                            <span>{{ $postna_stevilka }}</span> <span
                                                   >{{ $kraj }}</span>
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
                                <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.map-pin')
                                    </span>
                                    <a href="http://www.google.com/maps/place/{{$lokacija['lat']}},{{$lokacija['lng']}}"
                                       target="_blank" rel="noreferrer"
                                       class="link--reverse gtm-ponudnik-directions gtm-contact">
                                        Navodila za pot
                                    </a>

                                </div>
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
                                <h4 class="mb16">Lokacija</h4>
                                <div id="map" style="width: 100%; height: 260px"></div>
                            </div>
                        @endif
                            <div class="card pl16 pr16 pt16 pb16 mb24">
                                <h4 class="mb16">Deli z drugimi</h4>
                                <div class="footer__social flex flex--middle">
                                    <a title="Facebook share"
                                       aria-label="Facebook share"
                                       target="_blank"
                                       rel="noopener"
                                       class="btn btn--icon btn--small mr8"
                                       style="background: #1877F2"
                                       onclick="window.open(
                                               'https://www.facebook.com/sharer/sharer.php?u={{get_permalink()}}',
                                               'newwindow', 'width=600,height=400'); return false;">
                                        @include('icons.facebook')
                                    </a>
                                    <a target="_blank"
                                       rel="noopener"
                                       title="Twitter share"
                                       aria-label="Twitter share"
                                       class="btn btn--icon btn--small mr8"
                                       style="background: #1FA1F1"
                                       onclick="window.open(
                                               'https://twitter.com/intent/tweet?text={{the_title()}} {{ get_permalink() }}',
                                               'newwindow', 'width=600,height=400'); return false;">
                                        @include('icons.twitter')
                                    </a>
                                    <a target="_blank"
                                       rel="noopener"
                                       title="Twitter share"
                                       aria-label="Twitter share"
                                       class="btn btn--icon btn--small mr8"
                                       style="background: #ff4500"
                                       onclick="window.open(
                                               'https://www.reddit.com/submit?title={{the_title()}}&url={{ get_permalink() }}',
                                               'newwindow', 'width=600,height=400'); return false;">
                                        @include('icons.reddit')
                                    </a>
                                    <a target="_blank"
                                       href="mailto:?subject={{the_title()}}&body={{ get_permalink() }}"
                                       rel="noopener"
                                       title="Email share"
                                       aria-label="Email share"
                                       class="btn btn--icon btn--small">
                                        @include('icons.mail')
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if(count($kontakti) > 0)
      @php
        $phone = array_values(array_filter($kontakti, function ($kontakt){
        return $kontakt['vrsta'] == 'tel';
       }));
       $phone = count($phone) > 0 ? $phone[0]['kontakt'] : '';
       $email = array_values(array_filter($kontakti, function ($kontakt){
        return $kontakt['vrsta'] == 'email';
       }));
       $email = count($email) > 0 ? $email[0]['kontakt'] : '';
       $web = array_values(array_filter($kontakti, function ($kontakt){
        return $kontakt['vrsta'] == 'web';
       }));
       $web = count($web) > 0 ? $web[0]['kontakt'] : '';

      @endphp
      @include('partials.contacts', [
          'phone' => $phone,
          'email' => $email,
          'web' => $web,
          'location' => $lokacija
      ])
    @endif
@endsection
