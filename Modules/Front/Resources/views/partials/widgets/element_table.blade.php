@php $num = rand(0,10000000) @endphp

<div id="{{$field['settings']['htmlId'] or ''}}" class="element-table-container {{$field['settings']['htmlClass'] or ''}}">
  @if($field['settings']['header'])
    @if(isset($field['settings']['excel']) && $field['settings']['excel'])
      <div class="title">
        <div class="title-btns title-btns-no-header">
          <div class="excel-btn">
            <a href="{{route('table.export', [$field['settings']['tableElements'], $field['settings']['pagination']] )}}" element="" class="">

              <i class="fas fa-download"></i>Exportation CSV
            </a>
          </div>
          <div class="add-btn">
            @include('front::partials.fields.'.$field['fields'][2]['type'],
              [
                "field" => $field['fields'][2],
                "settings" => $field['settings'],
                "div" => false,
                "icon" => "fas fa-plus-circle"
              ]
            )
        </div>
      </div>
      </div>
    @endif
    <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-table-container-head {{$field['settings']['collapsed']?'collapsed':''}}" @if($field['settings']['collapsable']) data-toggle="collapse" data-target="#collapsetable-{{$num}}" aria-expanded="true" aria-controls="collapsetable-{{$num}}"@endif>
      {{$field['fields'][0]['value'][App::getLocale()]}}

    </div>
  @else
    <div class="title">
      <h4>{{$field['fields'][0]['value'][App::getLocale()]}}</h4>
      @if(isset($field['settings']['excel']) && $field['settings']['excel'])
        <div class="title-btns">
          <div class="excel-btn">
            <a href="{{route('table.export', [$field['settings']['tableElements'], $field['settings']['pagination']] )}}" element="" class="">
              <i class="fas fa-download"></i>Exportation CSV
            </a>
          </div>
          <div class="add-btn">
            @include('front::partials.fields.'.$field['fields'][2]['type'],
              [
                "field" => $field['fields'][2],
                "settings" => $field['settings'],
                "div" => false,
                "icon" => "fas fa-plus-circle"
              ]
            )
          </div>
        </div>
      @endif
    </div>
  @endif
  <div id="collapsetable-{{$num}}" class=" collapse {{$field['settings']['collapsed']?'':'in'}} element-table-container-body">
      <div id="elementTable" class="elementTable {{$field['settings']['header']?'':'elementTableNoHeader'}}"
        field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
        itemsPerPage="{{$field['settings']['pagination']}}"
        maxItems = "{{$field['settings']['maxItems']}}"
        elementObject="{{$field['settings']['tableElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['tableElements'])->first()->load('fields'))):null}}"
      >
      </div>
      <div>
        <div class="more-btn">
          @include('front::partials.fields.'.$field['fields'][1]['type'],
            [
              "field" => $field['fields'][1],
              "settings" => $field['settings'],
              "div" => false,
              "icon" => "far fa-eye"
            ]
          )
        </div>
      </div>
  </div>
</div>
