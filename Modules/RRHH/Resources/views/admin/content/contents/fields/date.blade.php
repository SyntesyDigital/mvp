<div class="row">
    <div class="form-group">
        <label>@if(isset($definition)){{ $definition->label }}@endif</label>

    	<div class="row">
    		<div class="col-md-12">
                {{Form::date(
                        $fieldname,
                        isset($field->value) ? $field->value : \Carbon\Carbon::now(),
                        [
                            'class' => 'form-control date-field'
                        ]
                    )}}
	       </div>
	       <!--
	       <div class="col-md-2">
	       		<a class="image-date btn btn-default">Get from image</a>
	       </div>
	       -->
        </div>

    </div>
</div>
