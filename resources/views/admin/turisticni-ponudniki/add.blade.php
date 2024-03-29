@php
    $current = get_current_user_id();
    $regije = get_terms([
            'taxonomy' => 'regije',
            'hide_empty' => false,
        ]);
        $obcine = get_terms([
            'taxonomy' => 'obcine',
            'hide_empty' => false,
        ]);
@endphp
<section class="flex flex--center">
    <div class="pt24 width100" style="max-width: 900px">
        <a href="{{admin_url('admin.php?page=turisticni-ponudniki')}}" class="flex flex--middle">@include('icons.chevron-left') Vsi turistični ponudniki</a>
        <h3 class="mb8">Dodaj turističnega ponudnika</h3>
        <div>
            <form class="row" id="formadminturisticniponudnikadd" novalidate>
                <div class="col-md-12 pt16">
                    <h5 class="mb16">Podatki</h5>
                </div>
                <div class="col-md-6 mb8">
                    <label for="naziv">Naziv ponudnika<span class="required">*</span></label>
                    <input type="text" name="naziv" id="naziv" class="input mt4"
                           placeholder="Turistična kmetija..." required autocomplete="off">
                </div>
                <div class="col-md-6 mb8">
                    <label for="ulica">Ulica<span class="required">*</span></label>
                    <input type="text" name="ulica" id="ulica" class="input mt4"
                           placeholder="Naslov in številka" required autocomplete="street-address">
                </div>
                <div class="col-md-6 mb8">
                    <label for="postnastevilka">Poštna številka<span class="required">*</span></label>
                    <input type="text" name="postnastevilka" id="postnastevilka" class="input mt4"
                           placeholder="1000" required autocomplete="postal-code">
                </div>
                <div class="col-md-6 mb8">
                    <label for="kraj">Kraj<span class="required">*</span></label>
                    <input type="text" name="kraj" id="kraj" class="input mt4"
                           placeholder="Ljubljana" required autocomplete="locality">
                </div>
                <div class="col-md-6 mb8">
                    <label for="regija">Regija<span class="required">*</span></label>
                    <div class="select mt4">
                        <select id="regija" name="regija" required>
                            <option value="" selected disabled style="display: none;">Izberi regijo</option>
                            @foreach($regije as $regija)
                                <option value="{{$regija->term_id}}">{!! $regija->name !!}</option>
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
                                <option value="{{$obcina->term_id}}">{!! $obcina->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="v" class="mb4">Opis</label>
                    <textarea id="tinymceeditor"></textarea>
                </div>

                <div class="col-md-12 pt16">
                    <h5 class="mb16">Kontaktni podatki</h5>
                </div>
                <div class="col-md-6 mb8">
                    <label for="telefon">Telefon
                        <small>(neobvezno)</small>
                    </label>
                    <input type="tel" name="telefon" id="telefon" class="input mt4"
                           placeholder="031 123 123" autocomplete="tel">
                </div>
                <div class="col-md-6 mb8">
                    <label for="spletnastran">Spletna stran
                        <small>(neobvezno)</small>
                    </label>
                    <input type="url" name="spletnastran" id="spletnastran" class="input mt4"
                           placeholder="https://spletnastran.si">
                </div>
                <div class="col-md-12 pt16">
                    <h5 class="mb16">Družabna omrežja</h5>
                </div>
                <div class="col-md-6 mb8">
                    <label for="facebook">Facebook
                        <small>(neobvezno)</small>
                    </label>
                    <input type="url" name="facebook" id="facebook" class="input mt4"
                           placeholder="https://facebook.com/vasastran">
                </div>
                <div class="col-md-6 mb8">
                    <label for="instagram">Instagram
                        <small>(neobvezno)</small>
                    </label>
                    <input type="url" name="instagram" id="instagram" class="input mt4"
                           placeholder="https://instagram.com/uporabniskoime">
                </div>
                <input type="hidden" name="author" value="{{$current}}">
                <div class="col-md-12 pt16">
                    <div>
                        <button type="submit" class="btn">
                            Dodaj
                        </button>
                        <div class="loading" style="display: none"></div>
                    </div>
                    <p id="message" class="error-text pt8"></p>
                </div>
            </form>
        </div>
    </div>
</section>
