@extends('layouts.app')

@php
    $vrsta = get_queried_object();
    $ponudniki = new WP_Query([
            'post_type' => 'ponudniki',
            'orderby' => 'menu_order',
            'tax_query' => array(
                array(
                    'taxonomy' => 'vrste',
                    'field' => 'term_id',
                    'terms' => $vrsta->term_id,
                ),
            ),
        ]);
@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt160 pb80 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">{{$vrsta->name}}</h1>
        </div>
    </section>

    <section>
        <div class="container pt120 pb120 pt48:sm pb64:sm">
            <div class="row">
                @if($ponudniki->have_posts())
                    @while($ponudniki->have_posts()) @php $ponudniki->the_post() @endphp
                    @php
                        $dostava = get_the_terms( get_the_ID() , 'dostava' );
                        $kraj = get_field('kraj');
                    @endphp
                    <div class="col-md-4 col-sm-6 flex--one mb16">
                        <a href="{{the_permalink()}}" class="card pt32 pl24 pr24 pb32 width100 height100">
                            <h4 class="mb16">{{the_title()}}</h4>
                            @if($kraj)
                                <div class="flex flex--middle mb8">
                            <span class="text--green mr4">
                                @include('icons.map-pin')
                            </span>
                                    <span>
                                {{$kraj}}
                            </span>
                                </div>
                            @endif
                            @if($dostava)
                                @foreach($dostava as $vrsta)
                                    <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.'.get_field('ikona', 'term_'.$vrsta->term_id))
                                    </span>
                                        <span>
                                        {{$vrsta->name}}
                                    </span>
                                    </div>
                                @endforeach
                            @endif

                            <div class="flex pt16">
                                <button class="btn">
                                    Poglej več
                                </button>
                            </div>
                        </a>
                    </div>
                    @endwhile
                @else
                    <div class="col-md-12">
                        <h3 class="text-center">Trenutno še ni ponudnikov te vrste</h3>
                    </div>
                @endif
            </div>

        </div>
    </section>
@endsection
