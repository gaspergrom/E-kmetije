@extends('layouts.app')

@php
    $regija = get_queried_object();
    $ponudniki = get_posts([
        'post_type' => 'ponudniki',
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'regije',
                'field' => 'term_id',
                'terms' => $regija->term_id,
            ),
        ),
    ]);
@endphp
@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt160 pb80 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">Ponudniki v regiji {!! $regija->name !!}</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb64 pt48:sm pb64:sm">
            <div class="row">
                @if($ponudniki && count($ponudniki))
                    @foreach($ponudniki as $ponudnik)
                        @include('partials.list.ponudnik.item', ['ponudnik' => $ponudnik])
                    @endforeach
                @else
                    <div class="col-md-12">
                        <h5>
                            Ni ponudnikov v te regiji
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('partials.zemljevid', ['ponudniki' => $ponudniki])
@endsection



