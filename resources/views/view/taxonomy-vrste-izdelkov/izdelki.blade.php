@php
    $vrstaIzdelka = get_queried_object();
@endphp

<section>
    <div class="container pt64 pb120 pt48:sm pb64:sm">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="pb24">
                    @include('partials.search.izdelki')
                </div>
                @include('partials.categories', ['active' =>$vrstaIzdelka->term_id, 'type' => 'ponudniki'])
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    @if(have_posts())
                        @while(have_posts())
                            @php
                                the_post();
                            @endphp
                            @include('partials.list.izdelki.hook')
                        @endwhile
                    @else
                        <div class="col-md-12">
                            <h5>
                                Za izbrano vrsto ni izdelkov
                            </h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
