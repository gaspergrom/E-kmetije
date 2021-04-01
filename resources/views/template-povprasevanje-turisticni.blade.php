{{--
  Template Name: Povpraševanje turistični
--}}

@extends('layouts.app')

@php
    $regije = get_terms([
        'taxonomy' => 'regije',
        'hide_empty' => false,
    ]);
    $obcine = get_terms([
        'taxonomy' => 'obcine',
        'hide_empty' => false,
    ]);
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    $dostave = get_terms([
        'taxonomy' => 'dostava',
        'hide_empty' => false,
    ]);
@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb40:sm">
            <h1 class="h2">{{the_title()}}</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb64">
            <div class="row flex--center">
                <div class="col-md-9">
                  <div class="pb16">
                    <h5 class="mb8">Vrsta ponudnika</h5>
                    <div class="row">
                      <div class="col-md-4">
                        <a href="/postani-ponudnik" class="category mb8">
                              Ponudnik izdelkov
                        </a>
                        <div class="category active mb8">
                          Turistični ponudnik
                        </div>
                      </div>
                    </div>
                  </div>

                    <form class="row" id="formponudnikturisticni" novalidate>
                        <div class="col-md-12">
                            <h5 class="mb8">Dostopni podatki</h5>
                            <p class="pb8">
                                Dostopni podatki so potrebni za dostop do nadzorne plošče, ker lahko urejate vaše izdelke in informacije.
                            </p>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="email">E-mail<span class="required">*</span></label>
                            <input type="email" name="email" id="email" class="input mt4"
                                   placeholder="sample@gmail.com" required autocomplete="email">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="username">Uporabniško ime<span class="required">*</span></label>
                            <input type="text" name="username" id="username" class="input mt4"
                                   placeholder="uporabniskoime" required>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="geslo">Geslo<span class="required">*</span></label>
                            <input type="password" name="geslo" id="geslo" class="input mt4"
                                   placeholder="Geslo" required>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="ponovigeslo">Ponovi geslo<span class="required">*</span></label>
                            <input type="password" name="ponovigeslo" id="ponovigeslo" class="input mt4"
                                   placeholder="Ponovi geslo" required>
                        </div>

                        <div class="col-md-12 pt16">
                            <h5 class="mb16">Podatki ponudnika</h5>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="naziv">Naziv ponudnika<span class="required">*</span></label>
                            <input type="text" name="naziv" id="naziv" class="input mt4"
                                   placeholder="Turistična kmetija..." required autocomplete="off">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="ulica">Ulica<span class="required">*</span></label>
                            <input type="text" name="ulica" id="ulica" class="input mt4"
                                   placeholder="Naslov in številka" required autocomplete="street-address">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="postnastevilka">Poštna številka<span class="required">*</span></label>
                            <input type="text" name="postnastevilka" id="postnastevilka" class="input mt4"
                                   placeholder="1000" required autocomplete="postal-code">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="kraj">Kraj<span class="required">*</span></label>
                            <input type="text" name="kraj" id="kraj" class="input mt4"
                                   placeholder="Ljubljana" required autocomplete="locality">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="regija">Regija<span class="required">*</span></label>
                            <div class="select mt4">
                                <select id="regija" name="regija" required>
                                    <option value="" selected disabled style="display: none;">Izberi regijo</option>
                                    @foreach($regije as $regija)
                                        <option value="{{$regija->term_id}}">{!! $regija->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="obcina">Občina<span class="required">*</span></label>
                            <div class="select mt4">
                                <select id="obcina" name="obcina" required>
                                    <option value="" selected disabled style="display: none;">Izberi občino</option>
                                    @foreach($obcine as $obcina)
                                        <option value="{{$obcina->term_id}}">{!! $obcina->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb8">
                            <label for="opis">Opis</label>
                            <textarea id="opis" name="opis" placeholder="" class="input mt4"></textarea>
                        </div>



                        <div class="col-md-12 pt16">
                            <h5 class="mb16">Kontaktni podatki</h5>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="telefon">Telefon <small>(neobvezno)</small></label>
                            <input type="tel" name="telefon" id="telefon" class="input mt4"
                                   placeholder="031 123 123" autocomplete="tel">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="spletnastran">Spletna stran <small>(neobvezno)</small></label>
                            <input type="url" name="spletnastran" id="spletnastran" class="input mt4"
                                   placeholder="https://spletnastran.si">
                        </div>
                        <div class="col-md-12 pt8">
                            <div>
                                <label class="checkbox pb8">
                                    <input type="checkbox" required name="zasebnost">
                                    <span>
                                        Strinjam se s <a href="https://e-kmetije.si/politika-zasebnosti/" target="_blank" style="text-decoration: underline;" class="pl4 pr4">politiko zasebnosti</a> in <a href="https://e-kmetije.si/pogoji-uporabe/" target="_blank" style="text-decoration: underline;" class="pl4">pogoji uporabe</a>
                                    </span>
                                </label>
                            </div>
                        </div>


                        <div class="col-md-12 pt16">
                            <div>
                                <button type="submit" class="btn">
                                    Pošlji povpraševanje
                                </button>
                                <div class="loading" style="display: none"></div>
                            </div>
                            <p class="error-text pt8"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
