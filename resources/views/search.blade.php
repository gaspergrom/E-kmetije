@php
    $prikazi = get_query_var('prikazi');
@endphp

@if($prikazi === 'ponudniki')
    @include('view.search.ponudniki')
@elseif($prikazi === 'izdelki')
    @include('view.search.izdelki')
@elseif($prikazi === 'turisticni-ponudniki')
    @include('view.search.turisticni-ponudniki')
@else
    @include('404')
@endif
