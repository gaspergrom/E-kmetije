@extends('layouts.app')

@section('content')
    <section class="">
        <div class="container pt160 pb120">
            <h1 class="text-center" style="font-size: 120px;">404</h1>
            <p class="text-center h6">
                Stran ni bila najdena
            </p>
            <div class="flex flex--center pt16">
                <a href="{{get_home_url()}}" class="btn">
                    Na domačo stran
                </a>
            </div>
        </div>
    </section>
@endsection
