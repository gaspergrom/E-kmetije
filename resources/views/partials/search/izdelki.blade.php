<form class="relative" role="search" method="get" action="/">
    <input type="search" name="s" value="" class="input pr48"
           placeholder="Poišči izdelke..."
           required>
    <input type="hidden" name="post_type" value="izdelki">
    <div class="absolute absolute--right absolute--top">
        <button type="submit" class="btn btn--icon btn--square">
            @include('icons.search')
        </button>
    </div>
</form>
