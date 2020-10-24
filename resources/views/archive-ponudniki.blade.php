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
            <h1 class="h2 h1:sm">Razišči ponudnike</h1>
        </div>
    </section>
    <section>
        <div class="container pt64 pb120 pt48:sm pb64:sm">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="pb24">
                        <form class="relative" role="search" method="get" action="/">
                            <input type="search" name="s" value="@if(isset($search) && $search){{$search}}@endif" class="input pr48"
                                   placeholder="Poišči ponudnike..."
                                   required>
                            <input type="hidden" name="post_type" value="ponudniki">
                            <div class="absolute absolute--right absolute--top">
                                <button type="submit" class="btn btn--icon btn--square">
                                    @include('icons.search')
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="hide:sm">
                        @foreach($vrste as $vrsta)
                            <a href="{{get_term_link($vrsta->term_id)}}/prikazi/ponudniki" class="category mb8">
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
                            <select onchange="if (this.value) window.location.href=this.value">
                                <option selected value="" disabled style="display:none">Izberi vrsto izdelkov</option>
                                @foreach($vrste as $vrsta)
                                    <option value="{{get_term_link($vrsta->term_id)}}/prikazi/ponudniki">{!! $vrsta->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                                @include('partials.list.ponudnik.hook')
                            @endwhile
                        @else
                            <div class="col-md-12">
                                <h5>
                                    @if(isset($search) && $search)
                                        Za vaš iskalni niz ni najdenih ponudnikov
                                    @else
                                        Ni ponudnikov
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
