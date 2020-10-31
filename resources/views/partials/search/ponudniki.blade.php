<form class="relative gtm-search-form-ponudniki" role="search" method="get" action="/">
    <label for="search" style="height: 0;width: 0; overflow: hidden; opacity: 0;display:block;">Poišči ponudnike</label>
    <input type="search" name="s" value="" class="input pr48" id="search"
           placeholder="Poišči ponudnike..."
           required>
    <input type="hidden" name="post_type" value="ponudniki">
    <div class="absolute absolute--right absolute--top">
        <button type="submit" class="btn btn--icon btn--square" aria-label="Poišči ponudnike">
            @include('icons.search')
        </button>
    </div>
</form>
