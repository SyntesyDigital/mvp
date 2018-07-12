{{-- ROW --}}
@if($node['type'] == "row")
    <div id="{{$node['settings']['htmlId'] or ''}}" class="row {{$node['settings']['htmlClass'] or ''}}">
      @if($node['settings']['hasContainer'])
        <div class="container">
      @endif
@endif

{{-- COL --}}
@if($node['type'] == "col")
    <div id="{{$node['settings']['htmlId'] or ''}}" class="{{$node['colClass']}} {{$node['settings']['htmlClass'] or ''}}">
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
      @if(isset($node['settings']['hasContainer']) && $node['settings']['hasContainer'])
        </div>
      @endif
    </div>
@endif
