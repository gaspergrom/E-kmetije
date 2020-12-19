@extends('layouts.app')

@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-vprasanj',
        'hide_empty' => false,
    ]);
@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">Pogosta vprašanja</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb120 pt48:sm pb64:sm">
            <div class="row">
                @foreach($vrste as $vrsta)
                    @php
                        $vprasanja = get_posts([
                            'post_type' => 'pogosta-vprasanja',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'vrste-vprasanj',
                                    'field' => 'term_id',
                                    'terms' => $vrsta->term_id,
                                ]
                            ]
                        ])
                    @endphp
                    <div class="col-md-4 col-sm-6 pb32">
                        <h3 class="pb16">
                            {{$vrsta->name}}
                        </h3>
                        @foreach($vprasanja as $vprasanje)
                            <div class="pb8">
                                <a href="{{get_permalink($vprasanje->ID)}}">{{$vprasanje->post_title}}</a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
