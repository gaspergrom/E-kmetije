@php
    $current = get_current_user_id();
    $izdelki = get_posts([
        'author' => $current,
        'post_type' => 'izdelki',
        'numberposts' => -1,
        'post_status' => ['publish', 'pending', 'draft']
    ])
@endphp

<section class="flex flex--center">
    <div class="pt24 width100" style="max-width: 900px;">
        <div class="flex flex--between mb16">
            <h3 class="mb8">Izdelki</h3>
            <div class="mb8">
                <a href="{{admin_url('admin.php?page=izdelki-add')}}" class="btn btn--small btn--square"
                   style="color: white !important;">
                    Dodaj izdelek
                </a>
            </div>
        </div>

        <div>
            @if($izdelki)
                @foreach($izdelki as $izdelek)
                    <div class="card pt8 pb8 pl16 pr16 mb16 mt0" style="max-width: 100%">
                        <div class="flex flex--middle flex--between" style="min-height: 38px">
                            <div style="width: calc(100% - 220px);">
                                <h6>{{$izdelek->post_title}} @if($izdelek->post_status==='pending')(v
                                    pregledu)@endif</h6>
                            </div>
                            <div class="flex">
                                <a href="{{get_the_permalink($izdelek->ID)}}" target="_blank"
                                   class="btn btn--small btn--info btn--square mr8" style="color: white !important;">
                                    Poglej
                                </a>
                                <a href="{{admin_url('admin.php?page=izdelki-edit&id='.$izdelek->ID)}}"
                                   class="btn btn--small btn--square" style="color: white !important;">
                                    Uredi
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="text-center">Trenutno še nimate izdelkov</h5>
            @endif
        </div>
    </div>
</section>
