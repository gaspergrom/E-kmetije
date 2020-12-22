@extends('layouts.app')

@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-vprasanj',
        'hide_empty' => false,
    ]);
@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">Pogosta vprašanja</h1>
        </div>
    </section>
    <section itemtype="http://schema.org/FAQPage" itemscope>
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
                            <div itemprop="mainEntity" itemtype="http://schema.org/Question" itemscope>
                                <meta itemprop="name" content="{{$vprasanje->post_title}}" />
                                <div itemprop="acceptedAnswer" itemtype="http://schema.org/Answer" itemscope>
                                    <meta itemprop="text" content="{{wp_strip_all_tags($vprasanje->post_content)}}" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
