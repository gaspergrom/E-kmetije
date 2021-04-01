@php
    $current = get_current_user_id();
    $ponudniki = get_posts([
        'author' => $current,
        'post_type' => 'turisticni-ponudniki',
        'numberposts' => -1,
        'post_status' => ['publish', 'pending']
    ])
@endphp

<section class="flex flex--center">
    <div class="pt24 width100" style="max-width: 900px;">
        <div class="flex flex--between mb16">
            <h3 class="mb8">Turisticni ponudniki</h3>
            <div class="mb8">
                <a href="{{admin_url('admin.php?page=turisticni-ponudniki-add')}}" class="btn btn--small btn--square"
                   style="color: white !important;">
                    Dodaj
                </a>
            </div>
        </div>

        <div>
            @if($ponudniki)
                @foreach($ponudniki as $ponudnik)
                    <div class="card pt8 pb8 pl16 pr16 mb16 mt0" style="max-width: 100%">
                        <div class="flex flex--middle flex--between" style="min-height: 38px">
                            <div style="width: calc(100% - 250px);">
                                <h6>{{$ponudnik->post_title}} @if($ponudnik->post_status==='pending')(v
                                    pregledu)@endif</h6>
                            </div>
                            @if($ponudnik->post_status !== 'pending')
                                <div class="flex">
                                    <a href="{{get_the_permalink($ponudnik->ID)}}" target="_blank"
                                       class="btn btn--small btn--info btn--square mr8" style="color: white !important;">
                                        Poglej
                                    </a>
                                    <a href="{{admin_url('admin.php?page=turisticni-ponudniki-edit&id='.$ponudnik->ID)}}"
                                       class="btn btn--small btn--square" style="color: white !important;">
                                        Uredi
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="text-center">Trenutno še nimate vnešenih turističnih ponudnikov</h5>
            @endif
        </div>
    </div>
</section>
