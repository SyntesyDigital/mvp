
@php
  $carbon = Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $field['value'], 'Europe/London');
  $value = $carbon->formatLocalized('%A %d %B %Y');
@endphp

<div id="{{$settings['htmlId'] or ''}}" class="{{$settings['htmlClass'] or ''}}">
  {{$value or ''}}
</div>
