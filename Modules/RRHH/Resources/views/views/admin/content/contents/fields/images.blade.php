<div class="row">

    <div class="col-md-12">
        <a href="#" class="btn list-image-add" data-fieldname="{{ $fieldname }}">Insert image</a>
    </div>

    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="content">
                @if(isset($field))

                    @foreach(json_decode($field->value, true) as $i => $f)
                        {{--*/ $image = json_decode($f) /*--}}

                        @if(isset($image->id))
                        <tr>
                            <td><input type="hidden" name="{{ $fieldname }}[]" value='{{ $f }}' /></td>
                            <td><img src="https://s3-{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/{{ $image->file }}" width="100" /></td>
                            <td>{{ $image->title or '' }}</td>
                            <td>{{ $image->resume or '' }}</td>
                            <td><a href="#" class="remove-image-list-toogle"><icon class="fa fa-trash-o"></icon></a></td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>

    var listenListRemove = function() {

        var fieldName = $(".list-image-add").data('fieldname');

        $(".remove-image-list-toogle").unbind( "click" );

        $(".remove-image-list-toogle").on('click', function(e) {
            e.preventDefault();

            var row = $(this).parent().parent();
            var container = row.parent();

            row.remove();

            if(container.find("input").length <= 0) {
                container.append('<tr><td><input type="hidden" name="'+fieldName+'[]" value="" /></td></tr>');
            }
        });
    };

    $(".list-image-add").on('click', function(e) {
        e.preventDefault();

        var fieldName = $(this).data('fieldname');
        var el = $(this).parent().parent().find('.content');

        app.mediaSelector.init({
            onSubmit : function(obj) {

                var value = JSON.stringify(obj).replace(/'/g, "&#39;");

                var html = '<tr>';
                    html += '<td><input type="hidden" name="' + fieldName + '[]" value=\'' + value + '\' /></td>';
                    html += '<td><img src="https://s3-{{ config("filesystems.disks.s3.region") }}.amazonaws.com/{{ config("filesystems.disks.s3.bucket") }}/' + obj.file + '" width="100" /></td>';
                    html += '<td>' + obj.title + '</td>';
                    html += '<td>' + obj.resume + '</td>';
                    html += '<td><a href="#" class="remove-image-list-toogle"><span class="glyphicon glyphicon-remove"></span></a></td>';
                html += '</tr>';

                el.append(html);
                listenListRemove();

                app.mediaSelector.close();
            }
        });
    });

    listenListRemove();

</script>
