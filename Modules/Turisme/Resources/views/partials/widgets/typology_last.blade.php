<div id="{{$field['settings']['htmlId'] or ''}}" class="widget blog list-items image {{$field['settings']['htmlClass'] or ''}}">
  <h3>
    @include('turisme::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </h3>
  <ul>
      @if((isset($field["contents"])) && $field["contents"])
        @foreach($field["contents"] as $content)
        <!--
        <li>
            @php
            /*
            <p class="image"><img src="images/img-medium.png"  alt=""/></p>
            <p class="text"><span class="data">{{$content->created_at->format('Y-m-d')}}</span> | <span class="categoria">{{ $content->categories->first()->name }} </span></p>
            <a href="{{ route('content.show', $content->getFullSlug()) }}">{{$content->title}}</a>
            */
            @endphp
        </li>
        -->
        @endforeach()
    @endif

  </ul>
  <p class="button">
    @include('turisme::partials.fields.'.$field['fields'][1]['type'],
      [
        "field" => $field['fields'][1],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </p>
</div>
