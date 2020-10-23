@php
    $organic = get_sub_field('organic')
@endphp
<section class="bg--image section__leaves"
         style="background-image: url(https://e-kmetije.si/wp-content/uploads/2020/10/banner-2.jpg)">
    <div class="container pt64 pb64">
        <div class="row flex--center">
            <div class="col-md-8">
                <h4 class="text-center text--white h2">
                    {{$organic['text']}}
                </h4>
                @if($organic['cta'])
                    <div class="flex flex--center pt16">
                        <a href="{{$organic['cta']['url']}}" target="{{$organic['cta']['target']}}" class="btn">
                            {{$organic['cta']['title']}}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
