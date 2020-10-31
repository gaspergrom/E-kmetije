<form class="relative gtm-search-form-izdelki" role="search" method="get" action="/">
    <label for="search" style="height: 0px;width: 0; overflow: hidden; opacity: 0;display: block">Poišči izdelke</label>
    <input type="search" name="s" value="" class="input pr48" id="search"
           placeholder="Poišči izdelke..."
           required>
    <input type="hidden" name="post_type" value="izdelki">
    <div class="absolute absolute--right absolute--top">
        <button type="submit" class="btn btn--icon btn--square" aria-label="Poišči izdelke">
            @include('icons.search')
        </button>
    </div>
</form>
