
<img
  src="{{asset($field['value']->getUrlsAttribute()['thumbnail'])}}"
  alt="{{$field['value']->metadata['fields']['alt'][App::getLocale()]['value'] or ''}}"
  title="{{$field['value']->metadata['fields']['title'][App::getLocale()]['value'] or ''}}"
/>
