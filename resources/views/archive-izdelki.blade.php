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
        <div class="container pt160 pb80 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">Poišči izdelke</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb120 pt48:sm pb64:sm">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="pb24">
                        @include('partials.search.izdelki')
                    </div>
                    @include('partials.categories')
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
                                @include('partials.list.izdelki.hook')
                            @endwhile
                        @else
                            <div class="col-md-12">
                                <h5>
                                    @if(isset($search) && $search)
                                        Za vaš iskalni niz ni najdenih izdelkov
                                    @else
                                        Ni izdelkov
                                    @endif
                                </h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.zemljevid')
@endsection
