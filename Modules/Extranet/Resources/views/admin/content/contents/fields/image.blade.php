@if(isset($definition))
<label>@if(isset($definition)){{ $definition->label }}@endif</label>
<div class="form-group">
    <input type="hidden" name="{{ $fieldname }}" value="{{ isset($field) ? $field->value : '' }}" class="form-control"  />

    <a href="#" class="btn btn-sm btn-success image-toogle">Ajouter</a>
    <a href="#" class="btn btn-sm btn-warning image-toogle-remove">Supprimer</a>

    <div class="img-preview">
        @if(isset($field))
          @if($field->value)
              <a href="{{ Storage::url('medias/' . $field->value) }}" target="_blank">
                  <img src="{{ Storage::url('medias/' . $field->value) }}" style="max-width:300px;" />
              </a>
          @endif
        @endif
    </div>
</div>
@endif
