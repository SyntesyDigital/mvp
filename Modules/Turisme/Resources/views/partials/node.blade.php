{{-- ROW --}}
@if($node['type'] == "row")
    <div class="row">
@endif

{{-- COL --}}
@if($node['type'] == "col")
    <div class="{{$node['colClass']}}">
@endif


{{-- FIELDS --}}
@if($node['type'] == "item")
  @if(isset($node['field']))

    @if(isset($node['field']['type']) && isset($node['field']['value']))

      @include('turisme::partials.fields.'.$node['field']['type'],
        [
          "field" => $node['field'],
        ]
      )

    @endif

  @endif
@endif

{{-- RECURSIVE CALL --}}
@if(isset($node['children']))
    @foreach($node['children'] as $n)
        @include('turisme::partials.node', [
            'node' => $n
        ])
    @endforeach
@endif

{{-- CLOSE BOX --}}
@if($node['type'] == "box")
        </div>
    </div>
@endif

{{-- CLOSE ROW AND COL --}}
@if($node['type'] == "row" || $node['type'] == "col")
    </div>
@endif
