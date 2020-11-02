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
        'post_status' => ['publish', 'pending']
    ])
@endphp
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
                    <label for="cenavrsta">Cena<span class="required">*</span></label>
                    <div class="select mt4">
                        <select id="cenavrsta" name="cenavrsta" required>
                            <option value="brez">Brez cene</option>
                            <option value="dogovor">Po dogovoru</option>
                            <option value="cena">Cena v €</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb8">
                    <label for="cenavrednost">Cena izdelka<span class="required">*</span></label>
                    <input type="number" name="cenavrednost" id="cenavrednost" class="input mt4"
                           placeholder="Cena izdelka v eur" required>
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
