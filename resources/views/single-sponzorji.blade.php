@extends('layouts.app')

@php
    $thumbnail = get_the_post_thumbnail_url();
@endphp


@section('content')
    <section class="bg--image"
             style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/product_hero_section_bg-1.jpg)">
        <div class="container pt120 pb48 pt120:sm pb40:sm">
            <div class="flex flex--middle">
                <div style="width: 150px" class="mr16">
                    <img src="{{$thumbnail}}" alt="{{the_title()}}">
                </div>
                <h1 class="h2">{{the_title()}}</h1>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt64 pb64 pt32:sm pb32:sm">
            <div class="row flex--center">
                <div class="col-md-9">
                    <div class="content">
                        {{the_content()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
