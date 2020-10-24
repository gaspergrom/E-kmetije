@extends('layouts.app')

@php
    $vrstaIzdelka = get_queried_object();
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    $prikazi = get_query_var('prikazi');

@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt160 pb80 pt120:sm pb48:sm">
            <h1 class="h2 h1:sm">{!! $vrstaIzdelka->name !!}</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb120 pt48:sm pb64:sm">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="pb24">
                        @if($prikazi === "ponudniki")
                            <form class="relative" role="search" method="get" action="/">
                                <input type="search" name="s" value="" class="input pr48"
                                       placeholder="Poišči ponudnike..."
                                       required>
                                <input type="hidden" name="post_type" value="ponudniki">
                                <div class="absolute absolute--right absolute--top">
                                    <button type="submit" class="btn btn--icon btn--square">
                                        @include('icons.search')
                                    </button>
                                </div>
                            </form>
                        @else
                            <form class="relative" role="search" method="get" action="/">
                                <input type="search" name="s" value="" class="input pr48"
                                       placeholder="Poišči izdelke..."
                                       required>
                                <input type="hidden" name="post_type" value="izdelki">
                                <div class="absolute absolute--right absolute--top">
                                    <button type="submit" class="btn btn--icon btn--square">
                                        @include('icons.search')
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="hide:sm">
                        @if($prikazi === "ponudniki")
                            <a href="{{get_post_type_archive_link('ponudniki')}}" class="category mb8">
                                <div class="flex flex--middle">
                                    @include('icons.chevron-right')
                                    <span class="pl4" style="width: calc(100% - 20px)">
                                    Vsi ponudniki
                                </span>
                                </div>
                            </a>
                        @else
                            <a href="{{get_post_type_archive_link('izdelki')}}" class="category mb8">
                                <div class="flex flex--middle">
                                    @include('icons.chevron-right')
                                    <span class="pl4" style="width: calc(100% - 20px)">
                                    Vsi izdelki
                                </span>
                                </div>
                            </a>
                        @endif
                        @foreach($vrste as $vrsta)
                            <a href="{{get_term_link($vrsta->term_id)}}{{$prikazi === 'ponudniki' ? '/prikazi/ponudniki' : null}}"
                               class="category mb8 @if($vrsta->term_id === $vrstaIzdelka->term_id) active @endif">
                                <div class="flex flex--middle">
                                    @include('icons.chevron-right')
                                    <span class="pl4" style="width: calc(100% - 20px)">
                                    {!! $vrsta->name !!}
                                </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="show-block:sm mb24">
                        <div class="select">
                            <label>
                                <select onchange="if (this.value) window.location.href=this.value">
                                    <option value="{{get_post_type_archive_link('izdelki')}}">Vsi izdelki</option>
                                    @foreach($vrste as $vrsta)
                                        <option value="{{get_term_link($vrsta->term_id)}}{{$prikazi === 'ponudniki' ? '/prikazi/ponudniki' : null}}"
                                                @if($vrsta->term_id === $vrstaIzdelka->term_id) selected @endif>
                                            {!! $vrsta->name !!}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        @if($prikazi === 'ponudniki')
                            @if(have_posts())
                                @while(have_posts())
                                    @php
                                        the_post();
                                    @endphp
                                    @include('partials.list.ponudnik.hook')
                                @endwhile
                            @else
                                <div class="col-md-12">
                                    <h5>
                                        Za izbrano vrsto ni ponudnikov
                                    </h5>
                                </div>
                            @endif
                        @elseif($prikazi === 'izdelki')

                        @else

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $ponudniki = get_posts([
            'post_type' => 'ponudniki',
            'orderby' => 'menu_order',
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












@extends('layouts.app')

@php
    $vrstaIzdelka = get_queried_object();
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    $prikazi = get_query_var('prikazi');

@endphp

@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt160 pb80 pt120:sm pb48:sm">
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



