@extends('layouts.app')

@php
    $vrstaIzdelka = get_queried_object();
    $prikazi = get_query_var('prikazi');

@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">{!! $vrstaIzdelka->name !!}</h1>
        </div>
    </section>
    @if($prikazi === 'ponudniki')
        @include('view.taxonomy-vrste-izdelkov.ponudniki')
    @else
        @include('view.taxonomy-vrste-izdelkov.izdelki')
    @endif
    @php
        $ponudniki = get_posts([
            'post_type' => 'ponudniki',
            'orderby' => 'menu_order',
            'numberposts' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'vrste-izdelkov',
                    'field' => 'term_id',
                    'terms' => $vrstaIzdelka->term_id,
                ),
            ),
        ]);
    @endphp
    @include('partials.zemljevid', ['ponudniki' => $ponudniki])
@endsection



