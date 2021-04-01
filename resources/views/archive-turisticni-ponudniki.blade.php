@extends('layouts.app')

@section('content')
  <section class="bg--image"
           style="background-image: url(@asset('images/banner.jpg'))">
    <div class="container pt120 pb48 pt120:sm pb48:sm">
      <h1 class="h2 h1:sm">Turistični ponudniki</h1>
    </div>
  </section>
  <section>
    <div class="container pt24 pb120 pt48:sm pb64:sm">
      <div class="row pb24">
        <div class="col-md-4">
          @include('partials.search.turisticni-ponudniki')
        </div>
      </div>
      <div class="row">
        @if(have_posts())
          @while(have_posts())
            @php
              the_post();
            @endphp
              @include('partials.list.turisticni-ponudnik.hook')
          @endwhile
        @else
          <div class="col-md-12">
            <h5>

              Ni ponudnikov
            </h5>
          </div>
        @endif
      </div>
      <div class="flex flex--center pt16">
        <div>
          @php(the_posts_pagination([
              'screen_reader_text' => ' ',
               'prev_text'          => __('<div style="height: 20px;"><div style="height: 0px;width: 0; overflow: hidden; opacity: 0;">Prejšnji</div><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></div>'),
               'next_text'          => __('<div style="height: 20px;"><div style="height: 0px;width: 0; overflow: hidden; opacity: 0;">Naslednji</div><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></div>'),
          ]))
        </div>
      </div>
    </div>
  </section>
@endsection
