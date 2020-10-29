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
                <div class="flex flex--center pt16">
                    <div>
                        @php(the_posts_pagination([
                            'screen_reader_text' => ' ',
                             'prev_text'          => __('<div style="height: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></div>'),
                             'next_text'          => __('<div style="height: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></div>'),
                        ]))
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
