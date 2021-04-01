@php
    $current = get_current_user_id();
    $id=null;
    $nastanitev = null;
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $nastanitev = get_post($id);
        $cena = get_field('cena', $id);
        $slike = get_field('slike', $id);
        $slike = $slike ? array_map(function ($slika){
            return $slika['slika']['ID'];
        }, $slike) : [];
        $nastanitevPonudnik = get_field('ponudnik', $id);
        $nastanitevPonudnik = property_exists($nastanitevPonudnik, 'ID') ? $nastanitevPonudnik->ID : $nastanitevPonudnik;
    }
    $ponudniki = get_posts([
        'author' => $current,
        'post_type' => 'turisticni-ponudniki',
        'numberposts' => -1,
        'post_status' => ['publish', 'pending']
    ]);
    $media = get_posts([
        'author' => $current,
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => null,
    ]);
@endphp
@if($id && $nastanitev)
    <section class="flex flex--center">
        <div class="width100 pt24" style="max-width: 900px">
            <a href="{{admin_url('admin.php?page=nastanitve')}}" class="flex flex--middle">
                @include('icons.chevron-left') Vse nastanitve
            </a>
            <h3 class="mb8">Uredi {{$nastanitev->post_title}}</h3>
            <div>
                <form class="row" id="formadminnastanitevedit" novalidate>
                    <div class="col-md-6 mb8">
                        <label for="name">Ime nastanitve<span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="input mt4" value="{{$nastanitev->post_title}}"
                               placeholder="Ime nastanitve" required>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mb8">
                        <label for="ponudnik">Ponudnik<span class="required">*</span></label>
                        <div class="select mt4">
                            <select id="ponudnik" name="ponudnik" required>
                                @foreach($ponudniki as $ponudnik)
                                    <option value="{{$ponudnik->ID}}"
                                            @if($nastanitevPonudnik &&  $nastanitevPonudnik == $ponudnik->ID) selected @endif
                                    >{!! $ponudnik->post_title !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  <div class="col-md-6 mb8">
                    <label for="cenavrednost">Cena na noč<span class="required">*</span></label>
                    <input type="number" name="cena" id="cenavrednost" class="input mt4"
                           placeholder="Cena v eur na noč" value="{{$cena}}" required>
                  </div>
                    <div class="col-md-12">
                        <label for="v" class="mb4">Opis</label>
                        <textarea id="tinymceeditor">{!! $nastanitev->post_content !!}</textarea>
                    </div>
                    <div class="pt24 pl24 pr24 width100">
                        <h4 class="">Slike nastanitve</h4>
                        <p>
                            Če želite dodati nove slike jo prosimo naložite <a href="{{admin_url('upload.php')}}" target="_blank" class="text-bold">tukaj</a>
                        </p>
                        <div class="fileselect row width100">
                            @foreach($media as $img)
                                <div class="col-md-3 mb16" style="padding: 0 8px">
                                    <label>
                                        <input type="checkbox" name="images" value="{{$img->ID}}" @if(count($slike) > 0 && in_array($img->ID, $slike)) checked @endif>
                                        <div class="card height100 mt0 mb16 pl0 pr0 pt0 pb0 quadric quadric--full" style="min-width: inherit; background-image: url({{wp_get_attachment_url($img->ID)}})"></div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="{{$id}}">
                    <input type="hidden" name="author" value="{{$current}}">
                    <div class="col-md-12 pt16">
                        <div>
                            <button type="submit" class="btn">
                                Uredi
                            </button>
                            <div class="loading" style="display: none"></div>
                        </div>
                        <p id="message" class="error-text pt8"></p>
                    </div>
                </form>

            </div>
        </div>
    </section>
@else
    <section class="pt40">
        <div class="row flex--center">
            <div class="col-md-8">
                <h3 class="text-center mb8">Nastanitev ne obstaja</h3>
                <div class="flex flex--center">
                    <a href="{{admin_url('admin.php?page=nastanitve')}}" class="btn" style="color: white !important;">
                        Nazaj na nastanitve
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
