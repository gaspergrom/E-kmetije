@php
    if (!(isset($ponudniki))){
    $ponudniki = get_posts([
               'post_type' => 'ponudniki',
               'post_per_page' => -1,
           ]);
    }

           $ponudnikiJson = array_map(function($ponudnik){
                   $dostava = (array) get_the_terms($ponudnik->ID, 'dostava');
                   if(!($dostava && count($dostava) && $dostava[0])){
                           $dostava = [];
                   }
                   $vrste = get_the_terms($ponudnik->ID, 'vrste-izdelkov');
                   if(!($vrste && count($vrste) && $vrste[0])){
                           $vrste = [];
                   }
               return [
                   'ID' => $ponudnik->ID,
                   'title' => $ponudnik->post_title,
                   'link' => get_permalink($ponudnik->ID),
                   'telefon' => get_field('telefon', $ponudnik->ID),
                   'email' => get_field('email', $ponudnik->ID),
                   'kraj' => get_field('kraj', $ponudnik->ID),
                   'lokacija' => get_field('lokacija', $ponudnik->ID),
                   'dostava' => array_map(function($el){
                                   return [
                                           'name' => $el->name,
                                           'ID' => $el->term_id,
                                   ];
                   }, $dostava),
                   'vrste' => array_map(function($vrsta){
                                   return [
                                           'name' => $vrsta->name,
                                           'ID' => $vrsta->term_id,
                                   ];
                   }, $vrste),
               ];
           }, $ponudniki);
@endphp
@if($ponudniki)
    <script>
        const locations = {!!  json_encode($ponudnikiJson) !!}
    </script>
    <section>
        <div id="map" style="width: 100%; height: 66vh; max-height: 500px"></div>
    </section>
@endif
