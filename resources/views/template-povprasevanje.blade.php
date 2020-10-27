{{--
  Template Name: Povpraševanje
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
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt120 pb48 pt120:sm pb40:sm">
            <h1 class="h2">{{the_title()}}</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb64">
            <div class="row flex--center">
                <div class="col-md-9">
                    <form class="row" id="formponudnik" novalidate>
                        <div class="col-md-12">
                            <h5 class="mb8">Dostopne podatki</h5>
                            <p class="pb8">
                                Dostopni podatki so potrebni za dostop do nadzorne plošče, ker lahko urejate vaše izdelke in informacije.
                            </p>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="input mt4"
                                   placeholder="sample@gmail.com" required autocomplete="email">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="username">Uporabniško ime</label>
                            <input type="text" name="username" id="username" class="input mt4"
                                   placeholder="uporabniskoime" required>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="geslo">Geslo</label>
                            <input type="password" name="geslo" id="geslo" class="input mt4"
                                   placeholder="Geslo" required>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="ponovigeslo">Ponovi geslo</label>
                            <input type="password" name="ponovigeslo" id="ponovigeslo" class="input mt4"
                                   placeholder="Ponovi geslo" required>
                        </div>

                        <div class="col-md-12 pt16">
                            <h5 class="mb16">Podatki ponudnika</h5>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="naziv">Naziv ponudnika</label>
                            <input type="text" name="naziv" id="naziv" class="input mt4"
                                   placeholder="Kmetija pr'..." required autocomplete="off">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="ulica">Ulica</label>
                            <input type="text" name="ulica" id="ulica" class="input mt4"
                                   placeholder="Naslov in številka" required autocomplete="street-address">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="postnastevilka">Poštna številka</label>
                            <input type="text" name="postnastevilka" id="postnastevilka" class="input mt4"
                                   placeholder="1000" required autocomplete="postal-code">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="kraj">Kraj</label>
                            <input type="text" name="kraj" id="kraj" class="input mt4"
                                   placeholder="Ljubljana" required autocomplete="locality">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="regija">Regija</label>
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
                            <label for="obcina">Občina</label>
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
                            <h5 class="mb8">Vrste izdelkov</h5>
                            <p class="pb8">
                                Če za vaše izdelke ne najdete kategorije, pustite prazno in bomo mi umestili v primerno kategorijo.
                            </p>
                        </div>
                        <div class="col-md-12 mb8">
                            <div class="row">
                                @foreach($vrste as $vrsta)
                                <div class="col-sm-6 col-lg-4 mb8">
                                    <label class="checkbox">
                                        <input type="checkbox" name="vrste" value="{{$vrsta->term_id}}">
                                        <span>
                                            {!! $vrsta->name !!}
                                        </span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="col-md-12 pt16">
                            <h5 class="mb16">Vrste prevzema</h5>
                        </div>
                        <div class="col-md-12 mb8">
                            @foreach($dostave as $dostava)
                            <div>
                                <label class="checkbox pb8">
                                    <input type="checkbox" name="dostava" value="{{$dostava->term_id}}">
                                    <span>
                                            {!! $dostava->name !!}
                                        </span>
                                </label>
                            </div>
                            @endforeach
                        </div>


                        <div class="col-md-12 pt16">
                            <h5 class="mb16">Kontaktni podatki</h5>
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="telefon">Telefon</label>
                            <input type="tel" name="telefon" id="telefon" class="input mt4"
                                   placeholder="031 123 123" autocomplete="tel">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="spletnastran">Spletna stran</label>
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
                            <button class="btn">
                                Pošlji povpraševanje
                            </button>
                            <p class="error-text pt8"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
