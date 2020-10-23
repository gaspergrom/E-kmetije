@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
@endphp
<section>
    <div class="container pt48 pb80 pt48:sm pb60:sm">
        <h2 class="text-center mb24">
            Razišči ponudbo
        </h2>
        <div class="row">
            @foreach($vrste as $vrsta)
                <div class="col-md-4">
                    <a href="{{get_term_link($vrsta->term_id)}}" class="category mb16 text-center">
                        {!! $vrsta->name !!}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
