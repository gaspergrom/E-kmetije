@php
    $hasMenu = has_nav_menu('main');
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
            @if ($hasMenu)
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
                            <a href="{{$cta['url']}}" target="{{$cta['target']}}" class="btn">
                                {{$cta['title']}}
                            </a>
                        </div>
                    @endif
                </div>
            @endif
            @if($cta)
                <div class="@if ($hasMenu) hide:sm @endif">
                    <a href="{{$cta['url']}}" target="{{$cta['target']}}" class="btn">
                        {{$cta['title']}}
                    </a>
                </div>
            @endif
            @if($hasMenu)
                <div class="header__btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            @endif
        </div>
    </div>
</header>
