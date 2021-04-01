@extends('layouts.app')

@php
    $thumbnail = get_the_post_thumbnail_url();
@endphp


@section('content')
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb40:sm">
            <div class="flex flex--middle">
                <div style="width: 150px" class="mr16">
                    <img src="{{$thumbnail}}" alt="{{the_title()}}">
                </div>
                <h1 class="h2">{{the_title()}}</h1>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt64 pb64 pt32:sm pb32:sm">
            <div class="row flex--center">
                <div class="col-md-9">
                    <div class="content">
                        {{the_content()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
      <div class="container pb120 pb64:sm">
        <div class="row flex--center">
          <div class="col-md-8">
            <h2 class="text-center pb16">
              Postani partner E-kmetij
            </h2>
            <p class="text-center">
              E-kmetije je spletna platforma, ki želi spodbuditi prodajo lokalnim pridelovalcem in ponudnikom.
              Za konstantni razvoj naše platforme potrebujemo finance, katere pridobimo preko sponzorjev in vsaka pomoč je dobrodošla.
            </p>
            <div class="flex flex--center pt8">
              <a href="https://e-kmetije.si/kontakt" class="btn">
                Postani partner
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
