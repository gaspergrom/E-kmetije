{{--
  Template Name: Kontakt
--}}

@extends('layouts.app')

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
                <div class="col-md-8">
                    <h3 class="mb16">Pošlji sporočilo</h3>
                    <form class="row" id="formkontakt" novalidate>
                        <div class="col-md-6 mb8">
                            <label for="email">E-mail<span class="required">*</span></label>
                            <input type="email" name="email" id="email" class="input mt4"
                                   placeholder="sample@gmail.com" required autocomplete="email">
                        </div>
                        <div class="col-md-6 mb8">
                            <label for="ime">Ime<span class="required">*</span></label>
                            <input type="text" name="ime" id="ime" class="input mt4"
                                   placeholder="Ime Priimek" autocomplete="name" required>
                        </div>
                        <div class="col-md-12 mb8">
                            <label for="sporocilo">Sporočilo<span class="required">*</span></label>
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
                <div class="col-md-4 mb24">
                    <div class="card pl16 pr16 pt16 pb16">
                        <h4 class="pb8">E-kmetije</h4>
                        <p class="mb0">
                            <a href="mailto:info@e-kmetije.si">info@e-kmetije.si</a>
                        </p>
                        <p class="mb0">
                            <a href="tel:+386 41 943 929">+386 41 943 929</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
