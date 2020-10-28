@extends('layouts.app')

@php
    $dostava = get_queried_object();
    $ponudniki = get_posts([
        'post_type' => 'ponudniki',
        'orderby' => 'menu_order',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'dostava',
                'field' => 'term_id',
                'terms' => $dostava->term_id,
            ),
        ),
    ]);
@endphp
@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">{!! $dostava->name !!}</h1>
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
                            Ni ponudnikov ki omogočajo to vrsto dostave
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('partials.zemljevid', ['ponudniki' => $ponudniki])
@endsection



