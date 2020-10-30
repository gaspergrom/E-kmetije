{{--
  Template Name: Kontakt
--}}

@extends('layouts.app')

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
                <div class="col-md-4 mb24">
                    <div class="card pl16 pr16 pt16 pb8">
                        <h4 class="pb8">E-kmetije</h4>
                        <p>
                            <a href="mailto:info@e-kmetije.si">info@e-kmetije.si</a>
                        </p>
                        <p>
                            <a href="tel:+386 41 943 929">+386 41 943 929</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <form class="row" id="formkontakt" novalidate>
                        <div class="col-md-6 mb8">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="input mt4"
                                   placeholder="sample@gmail.com" required autocomplete="email">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="ime">Ime</label>
                            <input type="text" name="ime" id="ime" class="input mt4"
                                   placeholder="Ime Priimek" autocomplete="name" required>
                        </div>
                        <div class="col-md-12 mb8">
                            <label for="sporocilo">Sporočilo</label>
                            <textarea id="sporocilo" name="sporocilo" placeholder="Vaše sporočilo..." required class="input mt4"></textarea>
                        </div>
                        <div class="col-md-12 pt16">
                            <div>
                                <button type="submit" class="btn">
                                    Pošlji sporočilo
                                </button>
                                <div class="loading" style="display: none"></div>
                            </div>
                            <p id="message" class="error-text pt8"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
