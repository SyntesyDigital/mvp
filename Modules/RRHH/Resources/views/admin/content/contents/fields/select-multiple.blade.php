@if(isset($definition))
    @if(isset($definition->options))
    <div class="row">
        <div class="col-md-1">
            <label>{{ $definition->label }}</label>
        </div>

        <div class="col-md-10">
            <div class="form-group">
              
              @foreach($definition->options as $index => $option)
              	<div class="checkbox block">
              		<label>
              			<input name="{{ $fieldname }}[{{$index + 1}}]" value="{{ $option->value }}" type="checkbox"  @if(isset($field)) @if($field->getValueFromJson($index + 1) == $option->value) checked @endif @endif>
              			 {{ $option->label }}
              		</label>
              	</div>
              @endforeach
              
            </div>
        </div>
    </div>
    @endif
@endif
