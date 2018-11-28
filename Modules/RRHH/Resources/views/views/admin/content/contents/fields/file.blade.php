@if(isset($definition))
<div class="row">
    <div class="col-md-1">
        <label>@if(isset($definition)){{ $definition->label }}@endif</label>
    </div>

    <div class="col-md-10">
        <div class="form-group">
            @if(isset($field))
                @if($field->value)
                    <a href="{{ env('MEDIA_PATH') }}{{ $field->value }}" class="field-file-name" target="_blank">{{ $field->value }}</a> &nbsp;&nbsp;
                    <a href="#" class="field-file-remove"><icon class="fa fa-trash-o"></icon></a>

                    <input type="hidden" name="{{ $fieldname }}" value="{{ $field->value }}" class="form-control"  />
                @else
                    <input type="file" name="{{ $fieldname }}" class="form-control"  />
                @endif
            @else
                <input type="file" name="{{ $fieldname }}" class="form-control"  />
            @endif
        </div>
    </div>
</div>

<script>
$('.field-file-remove').on("click", function(e){
    e.preventDefault();
    $(this).parent().find('input[type="hidden"]').attr("type", "file");
    $(this).parent().find('.field-file-name').remove();
    $(this).remove();
});
</script>
@endif
