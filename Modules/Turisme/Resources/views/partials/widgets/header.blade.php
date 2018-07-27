<div id="{{$field['settings']['htmlId'] or ''}}" class="grey-intro {{$field['settings']['htmlClass'] or ''}}">
  <div class="container">
      <div class="row">
	    <div class="claim trade col-md-9 col-sm-10 col-xs-12 centered">
			<h1>{{$content->getFieldValue('title')}}</h1>

      @include('turisme::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $field['settings'],
          "div" => false
        ]
      )

		  </div>
	  </div>
	</div>
</div>
