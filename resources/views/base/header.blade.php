@php
    $cta = get_field('header_cta', 'options');
@endphp
<header class="header">
    <div class="container">
        <div class="flex flex--between flex--middle header__box">
            <a href="{{ home_url('/') }}" class="header__logo flex flex--middle gtm-header-logo" title="Home"
               aria-label="Home">
                <div>
                    <img src="https://e-kmetije.si//wp-content/uploads/2020/10/logo-1-latest.png" alt="E-kmetije">
                </div>
            </a>
            <div class="header__links">
                <nav>
                    {!!
                        wp_nav_menu([
                            'theme_location' => 'main',
                            'container' => false,
                        ])
                    !!}
                </nav>
                @if($cta)
                    <div class="flex flex--center show-flex:sm">
                        <a href="https://e-kmetije.si/wp-admin" target="_blank" class="header__login gtm-header-login">Prijava</a>
                    </div>
                    <div class="flex flex--center show-flex:sm">
                        <a href="{{$cta['url']}}" target="{{$cta['target']}}" class="btn gtm-header-cta">
                            {{$cta['title']}}
                        </a>
                    </div>
                @endif
            </div>
            @if($cta)
                <div class="flex flex--middle hide:sm">
                    <a href="https://e-kmetije.si/wp-admin" target="_blank" class="mr16 header__login gtm-header-login">Prijava</a>
                    <div>
                        <a href="{{$cta['url']}}" target="{{$cta['target']}}" class="btn gtm-header-cta">
                            {{$cta['title']}}
                        </a>
                    </div>
                </div>

            @endif
            <div class="header__btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
