@extends('layouts.app')

@php
  $id = get_the_ID();
  $ponudnik = get_field('ponudnik');
  $ponudnik = property_exists($ponudnik, 'ID') ? $ponudnik : get_post($ponudnik);
  $cena = get_field('cena');
  $slike = get_field('slike');
  $thumbnail = get_the_post_thumbnail_url();

  if($ponudnik){
      $kraj = get_field('kraj', $ponudnik->ID);
      $ulica = get_field('ulica', $ponudnik->ID);
      $postna_stevilka = get_field('postna_stevilka', $ponudnik->ID);
      $lokacija = get_field('lokacija', $ponudnik->ID);
      $kontakti = get_field('kontakti', $ponudnik->ID);
      $social = get_field('f', $ponudnik->ID);
  }
@endphp

@section('content')
  <div>
    @if($ponudnik)
      <section class="bg--image"
               style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb40 pt120:sm pb40:sm">
          <div class="row">
            <div class="col-md-8">
              <h1 class="mb16 h2">{{the_title()}}</h1>
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
              <div class="col-md-12">
                @if( !empty( get_the_content() ) )
                  <div class="content">
                    {{the_content()}}
                  </div>
                @endif
                @if($cena)
                  <h4 class="text-right">
                    {{$cena}}€ / noč
                  </h4>
                @endif

                @if($slike && count($slike))
                  <div class="row pt24">
                    @foreach($slike as $slika)
                      <div class="col-lg-4 col-sm-6">
                        <div class="quadric--full bg--image" style="background-image: url({{$slika['slika']['url']}})"></div>
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            </div>
          </div>
          @if($ponudnik)
            <div class="col-md-4">
              @if($ulica && $kraj && $postna_stevilka || $kontakti && count($kontakti))
                <div class="card pl16 pr16 pt16 pb16 mb24">
                  <h4 class="mb16">{{$ponudnik->post_title}}</h4>
                  @if($ulica && $kraj && $postna_stevilka)
                    <p>
                      {{ $ulica }},<br>
                      {{ $postna_stevilka }} {{ $kraj }}
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
                        <a href="mailto:{{$kontakt['kontakt']}}" target="_blank"
                           rel="noreferrer"
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
                  <div class="pt24">
                    <a href="{{get_permalink($ponudnik->ID)}}" class="btn">
                      Poglej ponudnika
                    </a>
                  </div>
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
          @endif
        </div>
      </div>
    </section>
  </div>
@endsection
