@php
  $crop = "original";

  if(isset($settings) && isset($settings['cropsAllowed']) && $settings['cropsAllowed'] != null){
    $crop = $settings['cropsAllowed'];
  }
@endphp
@if(!isset($div))
<div>
@endif
  <img
    id="{{$settings['htmlId'] or ''}}"
    class="{{$settings['htmlClass'] or ''}}"
    src="{{asset($field['value']->getUrlsAttribute()[$crop])}}"
    alt="{{$field['value']->metadata['fields']['alt'][App::getLocale()]['value'] or ''}}"
    title="{{$field['value']->metadata['fields']['title'][App::getLocale()]['value'] or ''}}"
    width="{{$width or ''}}"
    height="{{$height or ''}}"
  />
@if(!isset($div))
</div>
@endif
