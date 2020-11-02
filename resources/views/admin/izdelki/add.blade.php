@php
    $current = get_current_user_id();
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    $ponudniki = get_posts([
        'author' => $current,
        'post_type' => 'ponudniki',
        'numberposts' => -1,
        'post_status' => ['publish']
    ]);
    $media = get_posts([
        'author' => $current,
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => null,
    ]);
@endphp
@if($ponudniki)
    <section class="flex flex--center">
        <div class="pt24 width100" style="max-width: 900px">
            <a href="{{admin_url('admin.php?page=izdelki')}}" class="flex flex--middle">
                @include('icons.chevron-left') Vsi izdelki
            </a>
            <h3 class="mb8">Dodaj izdelek</h3>
            <div>
                <form class="row" id="formadminizdelkiadd" novalidate>
                    <div class="col-md-6 mb8">
                        <label for="name">Ime izdelka<span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="input mt4"
                               placeholder="Ime izdelka" required>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mb8">
                        <label for="ponudnik">Ponudnik<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="ponudnik" name="ponudnik" required>
                                @foreach($ponudniki as $ponudnik)
                                    <option value="{{$ponudnik->ID}}">{!! $ponudnik->post_title !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="vrsta">Vrsta izdelka<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="vrsta" name="vrsta" required>
                                <option value="" selected disabled style="display: none;">Izberi vrsto izdelka</option>
                                @foreach($vrste as $vrsta)
                                    <option value="{{$vrsta->term_id}}">{!! $vrsta->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="cenavrsta">Cena<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="cenavrsta" name="cenavrsta" required>
                                <option value="brez">Brez cene</option>
                                <option value="dogovor">Po dogovoru</option>
                                <option value="cena" selected>Cena v €</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="cenavrednost">Cena izdelka</label>
                        <input type="number" name="cenavrednost" id="cenavrednost" class="input mt4"
                               placeholder="Cena izdelka v eur" required>
                    </div>
                    <div class="pt24 pl24 pr24 width100">
                        <h4 class="">Slika izdelka</h4>
                        <p>
                            Če želite dodati novo sliko jo prosimo naložite <a href="{{admin_url('upload.php')}}" target="_blank" class="text-bold">tukaj</a>
                        </p>
                        <div class="fileselect row width100">
                            @foreach($media as $img)
                                <div class="col-md-3 mb16" style="padding: 0 8px">
                                    <label>
                                        <input type="radio" name="image" value="{{$img->ID}}">
                                        <div class="card height100 mt0 mb16 pl0 pr0 pt0 pb0 quadric quadric--full" style="min-width: inherit; background-image: url({{wp_get_attachment_url($img->ID)}})"></div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="author" value="{{$current}}">
                    <div class="col-md-12 pt16">
                        <div>
                            <button type="submit" class="btn">
                                Dodaj izdelek
                            </button>
                            <div class="loading" style="display: none"></div>
                        </div>
                        <p id="message" class="error-text pt8"></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@else
    <section class="pt40">
        <div class="row flex--center">
            <div class="col-md-8">
                <h4 class="text-center mb16">Vnost izdelkov ni mogoč, ker še nimate ponudnikov</h4>
                <div class="flex flex--center">
                    <a href="{{admin_url('admin.php?page=izdelki')}}" class="btn" style="color: white !important;">
                        Nazaj na izdelke
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
