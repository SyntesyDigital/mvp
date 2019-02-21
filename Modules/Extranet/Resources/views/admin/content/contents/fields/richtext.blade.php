@if(isset($definition))
<div class="form-group">
	<label>{{ $definition->label }}</label>
    <textarea name="{{ $fieldname }}" id="{{ $fieldname }}_editor" rows="3">@if(isset($field)){{{ $field->value }}}@endif</textarea>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        app.editor.init('{{ $fieldname }}_editor', {
            height: '400px',
            toolbarGroups :  [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"links","groups":["links"]},
                {"name":"paragraph","groups":["list","blocks"]},
                {"name":"document","groups":["mode"]},
                {"name":"styles","groups":["styles"]},
                {"name":"architect","groups":["architect"]},
            ],
            removeButtons : 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
            extraPlugins: 'mediaSelector',
            allowedContent: true
        });
    });
</script>
@endif
