{{--
  Template Name: Zemljevid
--}}

@extends('layouts.app')

@php
    $ponudniki = get_posts([
           'post_type' => 'ponudniki',
           'numberposts' => -1,
       ]);
       $ponudnikiJson = array_map(function($ponudnik){
               $dostava = (array) get_the_terms($ponudnik->ID, 'dostava');
               if(!($dostava && count($dostava) && $dostava[0])){
                       $dostava = [];
               }
               $vrste = get_the_terms($ponudnik->ID, 'vrste-izdelkov');
               if(!($vrste && count($vrste) && $vrste[0])){
                       $vrste = [];
               }
           return [
               'ID' => $ponudnik->ID,
               'title' => $ponudnik->post_title,
               'link' => get_permalink($ponudnik->ID),
               'kontakti' => get_field('kontakti', $ponudnik->ID),
               'kraj' => get_field('kraj', $ponudnik->ID),
               'lokacija' => get_field('lokacija', $ponudnik->ID),
               'dostava' => array_map(function($el){
                               return [
                                       'name' => $el->name,
                                       'ID' => $el->term_id,
                               ];
               }, $dostava),
               'vrste' => array_map(function($vrsta){
                               return [
                                       'name' => $vrsta->name,
                                       'ID' => $vrsta->term_id,
                               ];
               }, $vrste),
           ];
       }, $ponudniki);
  $vrste = get_terms([
            'taxonomy' => 'vrste-izdelkov',
            'hide_empty' => false,
        ]);
        $dostave = get_terms([
            'taxonomy' => 'dostava',
            'hide_empty' => false,
        ]);
@endphp
@section('content')
    <script>
        const locations = {!!  json_encode($ponudnikiJson) !!}
    </script>
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb40:sm">
            <h1 class="h2">{{the_title()}}</h1>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-6 pt40 pt16:sm">
                    <div class="category pl16 pr16 pt16 pb16 mb16 flex flex--middle show-flex:sm cursor select-none text-bold nohover" data-acc="#filterform" style="max-width: 210px">
                        @include('icons.filter')
                        <p class="mb0 ml8">Filtriraj ponudnike</p>
                    </div>
                    <form id="filterform" class="hide-plain:sm">
                        <div class="flex">
                            <div class="col-sm-6">
                                <article class="pb24">
                                    <h4 class="mb16">Vrste izdelkov</h4>
                                    @foreach($vrste as $vrsta)
                                        <div>
                                            <label class="checkbox pb8 gtm-zemljevid-vrste">
                                                <input type="checkbox" name="vrste" value="{{$vrsta->term_id}}">
                                                <span>
                                            {!! $vrsta->name !!}
                                        </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </article>
                            </div>
                            <div class="col-sm-6">
                                <article class="pb24">
                                    <h4 class="mb16">Vrste dostav</h4>
                                    <div>
                                        <label class="checkbox radio pb8 gtm-zemljevid-dostava">
                                            <input type="radio" name="dostava" value="0" checked>
                                            <span>
                                            Vse vrste dostav
                                        </span>
                                        </label>
                                    </div>
                                    @foreach($dostave as $dostava)
                                        <div>
                                            <label class="checkbox radio pb8 gtm-zemljevid-dostava">
                                                <input type="radio" name="dostava" value="{{$dostava->term_id}}">
                                                <span>
                                            {!! $dostava->name !!}
                                        </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </article>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-lg-7 col-md-6 pl0 pr0">
                    <div id="map" style="width: 100%; height: 66vh; max-height: 500px"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
