@extends('layouts.app')


@section('content')
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">{{the_title()}}</h1>
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
        <div class="container pt24 pb48">
            <div class="row flex--center">
                <div class="col-md-6">
                    <h3 class="text-center pb16">Niste našli kar ste iskali?</h3>
                    <p class="text-center mb0">
                        Naša ekipa vam bo poskusila odgovoriti na vaše vprašanje v najkrajšem možnem času.
                    </p>
                    <div class="flex flex--center pt24">
                        <a href="https://e-kmetije.si/kontakt/" class="btn">
                            Kontaktirajte nas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
