@php
    $prikazi = get_query_var('prikazi');
@endphp

@if($prikazi === 'ponudniki')
    @include('view.search.ponudniki')
@elseif($prikazi === 'izdelki')
    @include('view.search.izdelki')
@else
    @include('404')
@endif
