@php
    $ponudniki = get_sub_field('ponudniki');

@endphp
<section>
    <div class="container pt120 pb120 pt80:sm pb24:sm">
        <h4 class="text-center mb8 h2">{{$ponudniki['naslov']}}</h4>
        <hr>
        <div class="row flex--center pt24 hide:sm">
            @if($ponudniki['ponudniki'])
                @foreach($ponudniki['ponudniki'] as $ponudnik)
                    <div class="col-lg-4 col-md-6 flex--one mb16">
                        @include('partials.list.ponudnik.item')
                    </div>
                @endforeach
            @else
                @php
                    $list = get_posts([
                        'post_type' => 'ponudniki',
                        'numberposts' => 3
                    ]);
                @endphp
                @foreach($list as $ponudnik)
                    <div class="col-lg-4 col-md-6 flex--one mb16">
                        @include('partials.list.ponudnik.item')
                    </div>
                @endforeach
            @endif
        </div>
        <div class="pt24 show-block:sm">
            <div class="owl owl-carousel" id="ponudnikicarousel">
                @if($ponudniki['ponudniki'])
                    @foreach($ponudniki['ponudniki'] as $ponudnik)
                        <div class="item pl16 pr16">
                            @include('partials.list.ponudnik.item', ['ponudnik' => $ponudnik])
                        </div>
                    @endforeach
                @else
                    @php
                        $list = get_posts([
                            'post_type' => 'ponudniki',
                            'numberposts' => 3
                        ]);
                    @endphp
                    @foreach($list as $ponudnik)
                        <div class="item pl16 pr16">
                            @include('partials.list.ponudnik.item', ['ponudnik' => $ponudnik])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
