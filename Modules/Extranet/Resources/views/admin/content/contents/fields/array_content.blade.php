<div class="row">

    <div class="col-md-12">
        <a href="#" class="btn content-group-add-toogle" data-fieldname="{{ $fieldname }}" data-typology="{{ $definition->typology_id or '' }}" data-language-id="{{ $language_id or '' }}">Add article</a>
    </div>


    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="content">
                @if(isset($field))

                    {{--*/ $field = json_decode($field->value) /*--}}

                    @foreach($field as $id)
                        {{--*/ $content = App\Models\Architect\Content::find($id) /*--}}
                        @if($content)
                        <tr>
                            <td>
                                <input type="hidden" name="{{ $fieldname }}[]" value="{{ $content->id }}" />
                                <img src="{{ env("MEDIA_PATH") }}/{{ $content->getFieldValue('banner', $language_id) }}" height="80" />
                            </td>
                            <td>
                                {{ $content->getFieldValue('title', $language_id) }}
                            </td>
                            <td>
                                <a href="#" class="content-group-remove-toogle" data-fieldname="{{ $fieldname }}"><icon class="fa fa-trash-o"></icon></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach()
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>

var listenListRemove = function() {
    $(".content-group-remove-toogle").unbind( "click" );

    $(".content-group-remove-toogle").on('click', function(e) {
        e.preventDefault();

        var row = $(this).parent().parent();
        var container = row.parent();
        var fieldName = $(this).data('fieldname') ? $(this).data('fieldname') : null;

        row.remove();

        if(container.find("input").length <= 0) {
            container.append('<tr><td><input type="hidden" name="' + fieldName + '[]" value="[]" /></td></tr>');
        }
    });
};

$('.content-group-add-toogle').on('click', function(e){
    e.preventDefault();

    var el = $(this).parent().parent().find('.content');

    var typology_id = $(this).data('typology') ? $(this).data('typology') : null;
    var language_id = $(this).data('language-id') ? $(this).data('language-id') : null;
    var fieldName = $(this).data('fieldname') ? $(this).data('fieldname') : null;

    app.contentSelector.init({
        URLs : {
            'index' : '{{ action('Architect\ContentController@index') }}?typology_id=' + typology_id
        },
        language_id : language_id,
        onClickAdd : function(id) {

            var url = '{{ action('Architect\ContentController@show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            $.ajax({
               url: url,
               type: 'GET',
               dataType: 'json',
               error: function() {
               },
               success: function(obj) {
                    var html = '<tr>';
                    html += '<input type="hidden" name="' + fieldName + '[]" value="' + obj.content.id + '" />';

                    $.each(obj.content.fields, function(index, field){
                        if(field.name == "banner" && field.language_id == language_id) {
                            html += '<td><img src="{{ env("MEDIA_PATH") }}/' + field.value + '" height="80" /></td>';
                        }
                    });

                    $.each(obj.content.fields, function(index, field){
                        if(field.name == "title" && field.language_id == language_id) {
                            html += '<td>' + field.value + '</td>';
                        }
                    });

                    html += '<td><a href="#" class="remove-content-list-toogle"><span class="glyphicon glyphicon-remove"></span></a></td>';
                    html += '</tr>';

                    el.append(html);
               }
            });
        }
    });
});

listenListRemove();

</script>
