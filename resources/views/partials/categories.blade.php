@php
    $vrste = get_terms([
        'taxonomy' => 'vrste-izdelkov',
        'hide_empty' => false,
    ]);
    $prikazi = get_query_var('prikazi');
@endphp
<div class="hide:sm">
    @if($prikazi==='ponudniki')
        <a href="{{get_post_type_archive_link('ponudniki')}}" class="category mb8 {{$active ? null : 'active'}}">
            <div class="flex flex--middle">
                <span class="pl4" style="width: calc(100% - 20px)">
                   Vsi ponudniki
                </span>
            </div>
        </a>
    @else
        <a href="{{get_post_type_archive_link('izdelki')}}" class="category mb8 {{$active ? null : 'active'}}">
            <div class="flex flex--middle">
                <span class="pl4" style="width: calc(100% - 20px)">
                   Vsi izdelki
                </span>
            </div>
        </a>
    @endif
    @foreach($vrste as $vrsta)
        <a href="{{get_term_link($vrsta->term_id)}}{{isset($append) ? $append : null}}"
           class="category mb8  @if(isset($active) && $vrsta->term_id === $active) active @endif gtm-category">
            <div class="flex flex--middle">
                <span class="pl4" style="width: calc(100% - 20px)">
                                    {!! $vrsta->name !!}
                                </span>
            </div>
        </a>
    @endforeach
</div>
<div class="show-block:sm mb24">
    <div class="select">
        <label for="categories" style="height: 0;width: 0; overflow: hidden; opacity: 0;display:block;">Poišči vrste
            izdelkov</label>
        <select onchange="if (this.value) window.location.href=this.value" id="categories">
            <option selected value="" disabled style="display:none">Izberi vrsto izdelkov</option>
            @foreach($vrste as $vrsta)
                <option value="{{get_term_link($vrsta->term_id)}}{{isset($append) ? $append : null}}"
                        class="gtm-category"
                        @if(isset($active) && $vrsta->term_id === $active) selected @endif>{!! $vrsta->name !!}</option>
            @endforeach
        </select>
    </div>
</div>
