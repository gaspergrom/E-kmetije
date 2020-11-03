@php
    $current = get_current_user_id();
    $id=null;
    $ponudnik = null;
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $ponudnik = get_post($id);
        $ulica = get_field('ulica', $id);
        $postnaStevilka = get_field('postna_stevilka', $id);
        $kraj = get_field('kraj', $id);
        $kontakti = get_field('kontakti', $id);
        $social = get_field('druzbena_omrezja', $id);
        $ponudnikRegije = get_the_terms( $id , 'regije' );
        $ponudnikObcine = get_the_terms( $id , 'obcine' );
        $ponVrsteIzdelkov = get_the_terms( $id , 'vrste-izdelkov' );
        if(!$ponVrsteIzdelkov){
            $ponVrsteIzdelkov = [];
        }
        $ponudnikVrsteIzdelkov = array_map(function ($term){return $term->term_id;}, $ponVrsteIzdelkov);
        $ponDostava = get_the_terms( $id , 'dostava' );
        if(!$ponDostava){
            $ponDostava = [];
        }
        $ponudnikDostava = array_map(function ($term){return $term->term_id;}, $ponDostava);
    }
        $regije = get_terms([
            'taxonomy' => 'regije',
            'hide_empty' => false,
        ]);
        $obcine = get_terms([
            'taxonomy' => 'obcine',
            'hide_empty' => false,
        ]);
        $vrste = get_terms([
            'taxonomy' => 'vrste-izdelkov',
            'hide_empty' => false,
        ]);
        $dostave = get_terms([
            'taxonomy' => 'dostava',
            'hide_empty' => false,
        ]);
@endphp
@if($id && $ponudnik)
    <section class="flex flex--center">
        <div class="width100 pt24" style="max-width: 900px">
            <a href="{{admin_url('admin.php?page=ponudniki')}}" class="flex flex--middle">@include('icons.chevron-left')
                Vsi ponudniki</a>
            <h3 class="mb8">Uredi {{$ponudnik->post_title}}</h3>
            <div>
                <form class="row" id="formadminponudnikedit" novalidate>
                    <div class="col-md-12 pt16">
                        <h5 class="mb16">Podatki ponudnika</h5>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="naziv">Naziv ponudnika<span class="required">*</span></label>
                        <input type="text" name="naziv" id="naziv" class="input mt4" value="{{$ponudnik->post_title}}"
                               placeholder="Kmetija pr'..." required autocomplete="off">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="ulica">Ulica<span class="required">*</span></label>
                        <input type="text" name="ulica" id="ulica" class="input mt4" value="{{$ulica}}"
                               placeholder="Naslov in številka" required autocomplete="street-address">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="postnastevilka">Poštna številka<span class="required">*</span></label>
                        <input type="text" name="postnastevilka" id="postnastevilka" class="input mt4"
                               value="{{$postnaStevilka}}"
                               placeholder="1000" required autocomplete="postal-code">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="kraj">Kraj<span class="required">*</span></label>
                        <input type="text" name="kraj" id="kraj" class="input mt4" value="{{$kraj}}"
                               placeholder="Ljubljana" required autocomplete="locality">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="regija">Regija<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="regija" name="regija" required>
                                <option value="" selected disabled style="display: none;">Izberi regijo</option>
                                @foreach($regije as $regija)
                                    <option value="{{$regija->term_id}}"
                                            @if($ponudnikRegije && $ponudnikRegije[0] && $ponudnikRegije[0]->term_id===$regija->term_id) selected @endif>{!! $regija->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="obcina">Občina<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="obcina" name="obcina" required>
                                <option value="" selected disabled style="display: none;">Izberi občino</option>
                                @foreach($obcine as $obcina)
                                    <option value="{{$obcina->term_id}}"
                                            @if($ponudnikObcine && $ponudnikObcine[0] && $ponudnikObcine[0]->term_id===$obcina->term_id) selected @endif>{!! $obcina->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="v" class="mb4">Opis</label>
                        <textarea id="tinymceeditor">{!! $ponudnik->post_content !!}</textarea>
                    </div>


                    <div class="col-md-12 pt16">
                        <h5 class="mb8">Vrste izdelkov</h5>
                        <p class="pb8">
                            Če za vaše izdelke ne najdete kategorije, pustite prazno in bomo mi umestili v primerno
                            kategorijo.
                        </p>
                    </div>
                    <div class="col-md-12 mb8">
                        <div class="row">
                            @foreach($vrste as $vrsta)
                                <div class="col-sm-6 col-lg-4 mb8">
                                    <label class="checkbox">
                                        <input type="checkbox" name="vrste" value="{{$vrsta->term_id}}"
                                               @if($ponudnikVrsteIzdelkov && in_array($vrsta->term_id ,$ponudnikVrsteIzdelkov)) checked @endif>
                                        <span>
                                            {!! $vrsta->name !!}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="col-md-12 pt16">
                        <h5 class="mb16">Vrste prevzema</h5>
                    </div>
                    <div class="col-md-12 mb8">
                        @foreach($dostave as $dostava)
                            <div>
                                <label class="checkbox pb8">
                                    <input type="checkbox" name="dostava" value="{{$dostava->term_id}}"
                                           @if($ponudnikDostava && in_array($dostava->term_id ,$ponudnikDostava)) checked @endif>
                                    <span>
                                            {!! $dostava->name !!}
                                        </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 pt40">
                            <h5 class="mr16">Kontaktni podatki</h5>
                    </div>
                    <div class="col-md-12" id="ponudnikkontaktiadd">
                        <div class="row mb16">
                            <div class="col-sm-4">
                                <div class="select mt4">
                                    <select required data-kontakt-add-vrsta>
                                        <option value="tel" selected>Telefon</option>
                                        <option value="email">Email</option>
                                        <option value="web">Spletna stran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="input mt4" placeholder="Kontakt" required data-kontakt-add-kontakt>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn" data-kontakt-add>Dodaj kontakt</button>
                            </div>
                        </div>
                    </div>

                    @if($kontakti)
                        <div data-kontakt='{!!  json_encode($kontakti) !!}' class="col-md-12"></div>
                    @else
                        <div class="col-md-12">
                            <h6>Ni dodanih Kontaktnih podatkov</h6>
                        </div>
                    @endif
                    <input type="hidden" name="author" value="{{$current}}">
                    <input type="hidden" name="post_id" value="{{$id}}">
                    <div class="col-md-12 pt16 pt32">
                        <div>
                            <button type="submit" class="btn">
                                Uredi ponudnika
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
                <h3 class="text-center mb8">Ponudnik ne obstaja</h3>
                <div class="flex flex--center">
                    <a href="{{admin_url('admin.php?page=ponudniki')}}" class="btn" style="color: white !important;">
                        Nazaj na ponudnike
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
