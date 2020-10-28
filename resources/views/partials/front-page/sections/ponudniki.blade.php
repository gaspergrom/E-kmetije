@php
    $ponudniki = get_sub_field('ponudniki');

@endphp
<section>
    <div class="container pt120 pb120 pt80:sm pb24:sm">
        <h4 class="text-center mb8 h2">{{$ponudniki['naslov']}}</h4>
        <hr>
        <div class="row flex--center pt24">
            @if($ponudniki['ponudniki'])
                @foreach($ponudniki['ponudniki'] as $ponudnik)
                    @include('partials.list.ponudnik.item')
                @endforeach
            @else
                @php
                    $list = get_posts([
                        'post_type' => 'ponudniki',
                        'numberposts' => 3
                    ]);
                @endphp
                @foreach($list as $ponudnik)
                    @include('partials.list.ponudnik.item')
                @endforeach
            @endif
        </div>
    </div>
</section>
