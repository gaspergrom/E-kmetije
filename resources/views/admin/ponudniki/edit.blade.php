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
        $email = array_values(array_filter($kontakti, function ($el){
            return $el['vrsta'] === 'email';
        }))[0]['kontakt'];
        $spletnastran = array_values(array_filter($kontakti, function ($el){
            return $el['vrsta'] === 'web';
        }))[0]['kontakt'];
        $telefoni = array_values(array_filter($kontakti, function ($el){
            return $el['vrsta'] === 'tel';
        }));
        $telefon = $telefoni[0]['kontakt'];
        $stelefon = $telefoni[1]['kontakt'];
        $social = get_field('druzbena_omrezja', $id);
        $facebook = array_values(array_filter($social, function ($el){
            return $el['platforma'] === 'facebook';
        }))[0]['povezava'];
        $instagram = array_values(array_filter($social, function ($el){
            return $el['platforma'] === 'instagram';
        }))[0]['povezava'];
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
                    <div class="col-md-12 pt16">
                        <h5 class="mb16">Kontaktni podatki</h5>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="email">Email
                            <span class="required">*</span>
                        </label>
                        <input type="url" name="email" id="email" class="input mt4"
                               placeholder="ime@gmail.com" required value="{{$email}}">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="spletnastran">Spletna stran
                            <small>(neobvezno)</small>
                        </label>
                        <input type="url" name="spletnastran" id="spletnastran" class="input mt4"
                               placeholder="https://spletnastran.si" value="{{$spletnastran}}">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="telefon">Telefon
                            <small>(neobvezno)</small>
                        </label>
                        <input type="tel" name="telefon" id="telefon" class="input mt4"
                               placeholder="031 123 123" autocomplete="tel" value="{{$telefon}}">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="stelefon">Sekundarni telefon
                            <small>(neobvezno)</small>
                        </label>
                        <input type="tel" name="stelefon" id="stelefon" class="input mt4"
                               placeholder="031 123 123" autocomplete="tel" value="{{$stelefon}}">
                    </div>

                    <div class="col-md-12 pt16">
                        <h5 class="mb16">Družabna omrežja</h5>
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="facebook">Facebook
                            <small>(neobvezno)</small>
                        </label>
                        <input type="url" name="facebook" id="facebook" class="input mt4"
                               placeholder="https://facebook.com/vasastran" value="{{$facebook}}">
                    </div>
                    <div class="col-md-6 mb8">
                        <label for="instagram">Instagram
                            <small>(neobvezno)</small>
                        </label>
                        <input type="url" name="instagram" id="instagram" class="input mt4"
                               placeholder="https://instagram.com/uporabniskoime" value="{{$instagram}}">
                    </div>
                    <input type="hidden" name="post_id" value="{{$id}}">
                    <input type="hidden" name="author" value="{{$current}}">
                    <div class="col-md-12 pt16">
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
