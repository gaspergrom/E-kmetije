@extends('layouts.app')

@section('content')
    @include('partials.front-page.header')
    <section data-id="test">
        @while (the_flexible_field('sekcije'))
            @include('partials.front-page.sections.' . get_row_layout())
        @endwhile
    </section>
@endsection

