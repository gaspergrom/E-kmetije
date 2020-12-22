@extends('layouts.app')

@section('content')
    <section class="bg--image"
             style="background-image: url(@asset('images/banner.jpg'))">
        <div class="container pt120 pb48 pt120:sm pb40:sm">
            <h1 class="h2">{{the_title()}}</h1>
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
