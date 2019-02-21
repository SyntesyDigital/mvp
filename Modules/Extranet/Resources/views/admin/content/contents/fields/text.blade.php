<div class="form-group">
    <label>@if(isset($definition)){{ $definition->label }}@endif</label>
    <input type="text" name="{{ $fieldname }}" value="{{ isset($field) ? $field->value : '' }}" class="form-control"  />
</div>
