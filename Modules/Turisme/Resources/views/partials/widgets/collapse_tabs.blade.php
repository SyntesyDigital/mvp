<div id="accordion1" class="panel-group {{$field['settings']['htmlClass'] or ''}}"  role="tablist" aria-multiselectable="true">

  @foreach($field['value'] as $index => $widget)

    <div class="panel panel-default">
      <div class="panel-heading" role="tab">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion1" href="#collapse-{{$index}}">
            @include('turisme::partials.fields.'.$widget['fields'][0]['type'],
              [
                "field" => $widget['fields'][0],
                "settings" => $field['settings'],
                "div" => false
              ]
            )
          </a>
        </h4>
      </div>
      <div id="collapse-{{$index}}" class="panel-collapse collapse">
        <div class="panel-body">
          @include('turisme::partials.fields.'.$widget['fields'][1]['type'],
            [
              "field" => $widget['fields'][1],
              "settings" => $field['settings'],
              "div" => false
            ]
          )
        </div>
      </div>
    </div>
  @endforeach

</div>
