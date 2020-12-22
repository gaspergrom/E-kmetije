@extends('layouts.app')

@section('content')
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">Sponzorji</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb80 pt48:sm pb64:sm">
            <div class="row">
                @if(have_posts())
                    @while(have_posts())
                        @php
                            the_post();
                        @endphp
                        @include('partials.list.sponzorji.hook')
                    @endwhile
                @else
                    <div class="col-md-12">
                        <h5>
                            Trenutno še ni sponzorjev
                        </h5>
                    </div>
                @endif
            </div>
            <div class="flex flex--center pt16">
                <div>
                    @php(the_posts_pagination([
                        'screen_reader_text' => ' ',
                         'prev_text'          => __('<div style="height: 20px;"><div style="height: 0px;width: 0; overflow: hidden; opacity: 0;">Prejšnji</div><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></div>'),
                         'next_text'          => __('<div style="height: 20px;"><div style="height: 0px;width: 0; overflow: hidden; opacity: 0;">Naslednji</div><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></div>'),
                    ]))
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pb120 pb64:sm">
            <div class="row flex--center">
                <div class="col-md-8">
                    <h2 class="text-center pb16">
                        Postani sponzor E-kmetij
                    </h2>
                    <p class="text-center">
                        E-kmetije je spletna platforma, ki želi spodbuditi prodajo lokalnim pridelovalcem in ponudnikom.
                        Za konstantni razvoj naše platforme potrebujemo finance, katere pridobimo preko sponzorjev in vsaka pomoč je dobrodošla.
                    </p>
                    <div class="flex flex--center pt8">
                        <a href="https://e-kmetije.si/kontakt" class="btn">
                            Postani sponzor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
