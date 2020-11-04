@php
    $current = get_current_user_id();
@endphp
<section class="flex flex--center">
    <div class="pt24 width100" style="max-width: 900px">
        <div class="row flex--center">
            <div class="col-md-8">
                <h3 class="mb16">Pomoč</h3>
                <form class="row" id="formadminpomoc" novalidate>
                    <div class="col-md-12 mb8">
                        <label for="sporocilo">Sporočilo<span class="required">*</span></label>
                        <textarea id="sporocilo" name="sporocilo" placeholder="Vaše sporočilo..." required
                                  class="input mt4"></textarea>
                    </div>
                    <input type="hidden" name="author" value="{{$current}}">
                    <div class="col-md-12 pt16">
                        <div>
                            <button type="submit" class="btn">
                                Pošlji sporočilo
                            </button>
                            <div class="loading" style="display: none"></div>
                        </div>
                        <p id="message" class="error-text pt8"></p>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mb24">
                <div class="card pl16 pr16 pt16 pb16">
                    <h4 class="pb8">E-kmetije</h4>
                    <p class="mb0">
                        <a href="mailto:info@e-kmetije.si">info@e-kmetije.si</a>
                    </p>
                    <p class="mb0">
                        <a href="tel:+386 41 943 929">+386 41 943 929</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
