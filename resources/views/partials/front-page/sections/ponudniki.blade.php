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
                    <div class="col-md-4 col-sm-6 flex--one mb16">
                        @if($ponudnik['ponudnik'])
                            @php
                                $dostava = get_the_terms( $ponudnik['ponudnik']->ID , 'dostava' );
                                $kraj = get_field('kraj', $ponudnik['ponudnik']->ID);
                            @endphp
                            <a href="{{get_permalink($ponudnik['ponudnik']->ID)}}"
                               class="card pt32 pl24 pr24 pb32 width100 height100">
                                <h4 class="mb16">{{$ponudnik['ponudnik']->post_title}}</h4>
                                @if($kraj)
                                    <div class="flex flex--middle mb8">
                            <span class="text--green mr4">
                                @include('icons.map-pin')
                            </span>
                                        <span>
                                {{$kraj}}
                            </span>
                                    </div>
                                @endif
                                @if($dostava)
                                    @foreach($dostava as $vrsta)
                                        <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.'.get_field('ikona', 'term_'.$vrsta->term_id))
                                    </span>
                                            <span>
                                        {{$vrsta->name}}
                                    </span>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="pt16">
                                    <button class="btn">
                                        Poglej več
                                    </button>
                                </div>
                            </a>

                        @endif
                    </div>
                @endforeach
            @else
                @php
                    $list = get_posts([
                        'post_type' => 'ponudniki',
                        'post_per_page' => 3
                    ]);
                @endphp
                @foreach($list as $ponudnik)
                    <div class="col-md-4 col-sm-6 flex--one mb16">
                        @php
                            $dostava = get_the_terms( $ponudnik->ID , 'dostava' );
                            $kraj = get_field('kraj', $ponudnik->ID);
                        @endphp
                        <a href="{{get_permalink($ponudnik->ID)}}"
                           class="card pt32 pl24 pr24 pb32 width100 height100">
                            <h4 class="mb16">{{$ponudnik->post_title}}</h4>
                            @if($kraj)
                                <div class="flex flex--middle mb8">
                            <span class="text--green mr4">
                                @include('icons.map-pin')
                            </span>
                                    <span>
                                {{$kraj}}
                            </span>
                                </div>
                            @endif
                            @if($dostava)
                                @foreach($dostava as $vrsta)
                                    <div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        @include('icons.'.get_field('ikona', 'term_'.$vrsta->term_id))
                                    </span>
                                        <span>
                                        {{$vrsta->name}}
                                    </span>
                                    </div>
                                @endforeach
                            @endif
                            <div class="pt16">
                                <button class="btn">
                                    Poglej več
                                </button>
                            </div>
                        </a>

                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
