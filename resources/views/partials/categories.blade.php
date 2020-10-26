@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
@endphp
<div class="hide:sm">
    @if(isset($type))
        <a href="{{get_post_type_archive_link('izdelki')}}" class="category mb8">
            <div class="flex flex--middle">
                @include('icons.chevron-right')
                <span class="pl4" style="width: calc(100% - 20px)">
                   @if($type==='ponudniki') Vsi ponudniki @else Vsi izdelki @endif
                </span>
            </div>
        </a>
    @endif
    @foreach($vrste as $vrsta)
        <a href="{{get_term_link($vrsta->term_id)}}{{isset($append) ? $append : null}}"
           class="category mb8  @if(isset($active) && $vrsta->term_id === $active) active @endif gtm-category">
            <div class="flex flex--middle">
                @include('icons.chevron-right')
                <span class="pl4" style="width: calc(100% - 20px)">
                                    {!! $vrsta->name !!}
                                </span>
            </div>
        </a>
    @endforeach
</div>
<div class="show-block:sm mb24">
    <div class="select">
        <select onchange="if (this.value) window.location.href=this.value">
            <option selected value="" disabled style="display:none">Izberi vrsto izdelkov</option>
            @foreach($vrste as $vrsta)
                <option value="{{get_term_link($vrsta->term_id)}}{{isset($append) ? $append : null}}" class="gtm-category"
                        @if(isset($active) && $vrsta->term_id === $active) selected @endif>{!! $vrsta->name !!}</option>
            @endforeach
        </select>
    </div>
</div>
