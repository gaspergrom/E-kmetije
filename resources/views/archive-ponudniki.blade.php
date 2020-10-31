@extends('layouts.app')

@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    if(isset($_GET['s'])){
        $search = $_GET['s'];
    }
@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">Razišči ponudnike</h1>
        </div>
    </section>
    <section>
        <div class="container-fluid pt64 pb120 pt48:sm pb64:sm">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="pb24">
                        @include('partials.search.ponudniki')
                    </div>
                    @include('partials.categories', ['append' => 'prikazi/ponudniki'])
                </div>
                <div class="col-lg-9 col-md-8">
                    @if(isset($search) && $search)
                        <p class="mb16">Rezultati iskanja za: <b>{{$search}}</b></p>
                    @endif
                    <div class="row">
                        @if(have_posts())
                            @while(have_posts())
                                @php
                                    the_post();
                                @endphp
                                <div class="col-lg-4 col-md-6 flex--one mb16">
                                    @include('partials.list.ponudnik.hook')
                                </div>
                            @endwhile
                        @else
                            <div class="col-md-12">
                                <h5>
                                    @if(isset($search) && $search)
                                        Za vaš iskalni niz ni najdenih ponudnikov
                                    @else
                                        Ni ponudnikov
                                    @endif
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
            </div>
        </div>
    </section>
    @include('partials.zemljevid')
@endsection
