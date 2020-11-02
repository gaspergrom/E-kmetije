@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
        'number' => 8,
    ]);
@endphp
<section>
    <div class="container pt48 pb48 pt30:sm pb30:sm">
        <div class="row">
            <div class="pl8 pr8 flex width100">
                @foreach($vrste as $vrsta)
                    @php
                       $image = get_field('slika', 'term_'.$vrsta->term_id);
                    @endphp
                    <div class="col-lg-3 col-md-3 col-xs-6 mb16" style="padding: 0 8px;">
                        <a href="{{get_term_link($vrsta->term_id)}}" class="bg--zoom quadric relative block">
                            <div class="zoombg bg--image" style="background-image: linear-gradient(to top, rgba(0,0,0,0.6), rgba(0,0,0,0.3)), url('{{$image}}')"></div>
                            <div class="absolute absolute--full pl32 pr32 pl16:sm pr16:sm">
                                <div class="height100 width100 flex flex--center flex--middle">
                                    <h4 class="text--white text-center" style="text-shadow: 1px 0 7px rgba(0,0,0, 0.7);">{!! $vrsta->name !!}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex--center pt16">
            <a href="/izdelki" class="btn">
                Poglej vse vrste izdelkov
            </a>
        </div>
    </div>
</section>
