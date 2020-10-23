@extends('layouts.app')

@php
    $vrstaIzdelka = get_queried_object();
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
 $izdelki = new WP_Query([
            'post_type' => 'izdelki',
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
                        <form class="relative" role="search" method="get" class="blog__search__form" action="/">
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
                    </div>
                    <div class="hide:sm">
                        <a href="{{get_post_type_archive_link('izdelki')}}" class="category mb8">
                            <div class="flex flex--middle">
                                @include('icons.chevron-right')
                                <span class="pl4" style="width: calc(100% - 20px)">
                                    Vsi izdelki
                                </span>
                            </div>
                        </a>
                        @foreach($vrste as $vrsta)
                            <a href="{{get_term_link($vrsta->term_id)}}"
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
                                        <option value="{{get_term_link($vrsta->term_id)}}"
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
                        @if($izdelki->have_posts())
                            @while($izdelki->have_posts())
                                @php
                                    $izdelki->the_post();
                                    $thumbnail = get_the_post_thumbnail_url();
                                    $opis = get_field('opis');
                                    $cena = get_field('cena');
                                @endphp

                                <div class="col-lg-4 col-sm-6">
                                    <a href="{{the_permalink()}}" class="card pt16 pl24 pr24 pb16 height100 width100">
                                        @if($thumbnail)
                                            <img src="{{$thumbnail}}"
                                                 alt="{{$title}}" loading="lazy" class="img">
                                        @endif
                                        <h4 class="mb16">
                                            {{the_title()}}
                                        </h4>
                                        @if($opis)
                                            <p>
                                                {{$opis}}
                                            </p>
                                        @endif
                                        @if($cena)
                                            <h5 class="text-right">
                                                {{$cena}}
                                            </h5>
                                        @endif
                                    </a>
                                </div>
                            @endwhile
                        @else
                            <div class="col-md-12">
                                <h5>
                                    Ni izdelkov te vrste
                                </h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
