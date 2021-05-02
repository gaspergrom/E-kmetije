<div class="contacts show-flex:sm">
  @if(isset($phone) && strlen($phone) > 0)
    <a href="tel:{{$phone}}" target="_blank">
      @include('icons.phone')
    </a>
  @endif
  @if(isset($email) && strlen($email) > 0)
    <a href="mailto:{{$email}}" target="_blank">
      @include('icons.mail')
    </a>
  @endif
  @if(isset($web) && strlen($web) > 0)
    <a href="{{$web}}" target="_blank">
      @include('icons.globe')
    </a>
  @endif
  @if(isset($location) && strlen($location['lat']) > 0 && strlen($location['lng']) > 0)
    <a href="http://www.google.com/maps/place/{{$location['lat']}},{{$location['lng']}}" target="_blank">
      @include('icons.map-pin')
    </a>
  @endif
</div>
