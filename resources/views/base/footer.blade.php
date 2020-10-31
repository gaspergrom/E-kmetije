@php
    $splosno = get_field('splosni_podatki', 'option');
    $social = get_field('social_media', 'option');
    $description = get_field('footer_description', 'option');
    $povezave = get_field('footer_povezave', 'option');
@endphp
<footer class="footer">
    <div class="container">
        <div class="row pb64 pb24:sm">
            <div class="col-md-5 mb32:sm">
                <h6 class="text--white mb24 h2">
                    E-kmetije
                </h6>
                @if($description)
                <p class="text--white pb8">
                    {{$description}}
                </p>
                @endif
                @if($splosno['email'])
                    <p>
                    <span class="text--green-light" style="width: 70px;display: inline-block;">
                        Email:
                    </span>
                        <a href="mailto:{{$splosno['email']}}" class="gtm-footer-email">
                            {{$splosno['email']}}
                        </a>
                    </p>
                @endif
                @if($splosno['telefon'])
                    <p>
                    <span class="text--green-light" style="width: 70px;display: inline-block;">
                        Telefon:
                    </span>
                        <a href="tel:{{$splosno['telefon']}}" class="gtm-footer-tel">
                            {{$splosno['telefon']}}
                        </a>
                    </p>
                @endif
                <div class="flex pt16">
                    @if($social['instagram'])
                        <a href="{{$social['instagram']}}" target="_blank" rel="noreferrer" aria-label="Instagram"
                           class="btn btn--icon btn--small btn--white mr8 gtm-footer-social">
                            @include('icons.instagram')
                        </a>
                    @endif
                    @if($social['facebook'])
                        <a href="{{$social['facebook']}}" target="_blank" rel="noreferrer" aria-label="Facebook"
                           class="btn btn--icon btn--small btn--white gtm-footer-social">
                            @include('icons.facebook')
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-1"></div>
            @if($povezave)
                @foreach($povezave as $sekcija)
                    <div class="col-md-3 col-sm-6 pt16 mb32:sm">
                        <h6 class="text--white mb24 h3">{{$sekcija['naslov']}}</h6>
                        @if($sekcija['povezave'])
                            <nav class="flex flex--column">
                                @foreach($sekcija['povezave'] as $povezava)
                                    @if($povezava['link'])
                                        <a href="{{$povezava['link']['url']}}" target="{{$povezava['link']['target']}}" class="mb16 flex flex--middle gtm-footer-link">
                                            <span class="pr4">
                                                @include('icons.chevrons-right')
                                            </span>
                                            {{$povezava['link']['title']}}
                                        </a>
                                    @endif
                                @endforeach
                            </nav>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
        <div class="footer__copyright">
            <div class="flex flex--center pt16 pb16">
                <p class="mb0 text-center text--white small">
                    &copy; Copyright 2020 E-kmetije. Vse pravice pridržane
                </p>
            </div>
        </div>
    </div>
</footer>
