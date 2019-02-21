@if(isset($definition))
    @if(isset($definition->options))
    <div class="row">

        <div class="form-group">
        
        	<label>{{ $definition->label }}</label>
          
          <select name="{{ $fieldname }}" class="form-control" />
              <option value="" >No selected</option>
              @foreach($definition->options as $option)
                  <option value="{{ $option->value }}" @if(isset($field)) @if($field->value == $option->value) selected @endif @endif>{{ $option->label }}</option>
              @endforeach
          </select>
        </div>
        
    </div>
    @endif
@endif
