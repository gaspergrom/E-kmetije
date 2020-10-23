<!doctype html>
<html {!! get_language_attributes() !!}>
@include('base.head')
<body @php body_class() @endphp>
@php do_action('get_header') @endphp
@include('base.header')
<main class="main">
    @yield('content')
</main>
@php do_action('get_footer') @endphp
@include('base.footer')

@php wp_footer() @endphp
{!! get_field('code_footer', 'options') !!}
</body>
</html>
