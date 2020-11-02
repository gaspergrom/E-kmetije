@php
    $current = get_current_user_id();
    $id=null;
    $izdelek = null;
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $izdelek = get_post($id);
        $cena = get_field('cena', $id);
        $izdelekPonudnik = get_field('ponudnik', $id);
        $izdelekPonudnik = property_exists($izdelekPonudnik, 'ID') ? $izdelekPonudnik->ID : $izdelekPonudnik;
    }
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    $ponudniki = get_posts([
        'author' => $current,
        'post_type' => 'ponudniki',
        'numberposts' => -1,
        'post_status' => ['publish', 'pending']
    ])
@endphp
@if($id && $izdelek)
    <section class="flex flex--center">
        <div class="width100 pt24" style="max-width: 900px">
            <a href="{{admin_url('admin.php?page=izdelki')}}" class="flex flex--middle">
                @include('icons.chevron-left') Vsi izdelki
            </a>
            <h3 class="mb8">Uredi {{$izdelek->post_title}}</h3>
            <div>
                <form class="row" id="formadminizdelkiedit" novalidate>
                    <div class="col-md-6 mb8">
                        <label for="name">Ime izdelka<span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="input mt4" value="{{$izdelek->post_title}}"
                               placeholder="Ime izdelka" required>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="ponudnik">Ponudnik<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="ponudnik" name="ponudnik" required>
                                @foreach($ponudniki as $ponudnik)
                                    <option value="{{$ponudnik->ID}}"
                                            @if($izdelekPonudnik &&  $izdelekPonudnik == $ponudnik->ID) selected @endif
                                    >{!! $ponudnik->post_title !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="cenavrsta">Cena<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="cenavrsta" name="cenavrsta" required>
                                <option value="brez" @if($cena && $cena['vrsta'] && $cena['vrsta'] === 'brez') selected @endif>Brez cene</option>
                                <option value="dogovor" @if($cena && $cena['vrsta'] && $cena['vrsta'] === 'dogovor') selected @endif>Po dogovoru</option>
                                <option value="cena" @if($cena && $cena['vrsta'] && $cena['vrsta'] == 'cena') selected @endif>Cena v €</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="cenavrednost">Cena izdelka</label>
                        <input type="number" name="cenavrednost" id="cenavrednost" class="input mt4"
                               placeholder="Cena izdelka v eur" value="{{$cena['vrednost']}}">
                    </div>
                    <input type="hidden" name="post_id" value="{{$id}}">
                    <input type="hidden" name="author" value="{{$current}}">
                    <div class="col-md-12 pt16">
                        <div>
                            <button type="submit" class="btn">
                                Uredi izdelek
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
                <h3 class="text-center mb8">Izdelek ne obstaja</h3>
                <div class="flex flex--center">
                    <a href="{{admin_url('admin.php?page=izdelki')}}" class="btn" style="color: white !important;">
                        Nazaj na izdelke
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
