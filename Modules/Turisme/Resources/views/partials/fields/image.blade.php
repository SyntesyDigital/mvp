@php
  $crop = "original";

  if($field['settings']['cropsAllowed'] != null){
    $crop = $field['settings']['cropsAllowed'];
  }
@endphp
<div>
  <img
    id="{{$field['settings']['htmlId'] or ''}}"
    class="{{$field['settings']['htmlClass'] or ''}}"
    src="{{asset($field['value']->getUrlsAttribute()[$crop])}}"
    alt="{{$field['value']->metadata['fields']['alt'][App::getLocale()]['value'] or ''}}"
    title="{{$field['value']->metadata['fields']['title'][App::getLocale()]['value'] or ''}}"
  />
</div>
