{{--*/ $id = str_random(10); /*--}}

<div class="row">
    <div class="form-group">
        <label>@if(isset($definition)){{ $definition->label }}@endif</label>

    	<div class="row">
    		<div class="col-md-12">
                <div class='input-group date' id='{{ $id }}'>
                    @if(isset($field))
                        {{ Form::text($fieldname, $field->value, ["class" => 'form-control'])}}
                    @else
                    	{{ Form::text($fieldname, "", ["class" => 'form-control'])}}
                    @endif
                    
                    <!--
                        {{ Form::text($fieldname, Carbon\Carbon::now()->format('H:i'), ["class" => 'form-control'])}}
                    -->
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
	       </div>
        </div>

    </div>
</div>
<script type="text/javascript">
$(function () {
    $('#{{$id}}').datetimepicker({
        format: 'HH:mm'
    });
});
</script>
