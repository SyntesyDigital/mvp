@php
    $fields = isset($content)
        ? $content->fieldsDefinition()
        : $typology->getDefinition();
@endphp

<!-- CUSTOMS FIELDS -->
@foreach($fields as $index => $d)

    @if($d->type == "select")
        {{-- FIELD SELECT --}}
        @include("admin.content.contents.fields.select", [
            "field" => isset($content) ? $content->field($d->name, $l->id) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

    @if($d->type == "select-multiple")
        {{-- FIELD SELECT MULTIPLE --}}
        @include("admin.content.contents.fields.select-multiple", [
            "field" => isset($content) ? $content->field($d->name, $l->id) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

    @if($d->type == "text")
        {{-- FIELD SIMPLE INPUT TEXT --}}
        @include("admin.content.contents.fields.text", [
            "field" => isset($content) ? $content->field($d->name, $l->id, true) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

    @if($d->type == "date")
        {{-- FIELD SIMPLE INPUT TEXT --}}
        @include("admin.content.contents.fields.date", [
            "field" =>  isset($content) ? $content->field($d->name, $l->id, true) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

    @if($d->type == "time")
        {{-- FIELD SIMPLE INPUT TEXT --}}
        @include("admin.content.contents.fields.time", [
            "field" =>  isset($content) ? $content->field($d->name, $l->id, true) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

    @if($d->type == "richtext")
        {{-- FIELD RICH TEXT --}}
        @include("admin.content.contents.fields.richtext", [
            "field" =>  isset($content) ? $content->field($d->name, $l->id) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif


    @if($d->type == "image")
        {{-- FIELD IMAGE --}}
        @include("admin.content.contents.fields.image", [
            "field" =>  isset($content) ? $content->field($d->name, $l->id) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif


    @if($d->type == "images")
        {{-- FIELD IMAGES --}}
        @include("admin.content.contents.fields.images", [
            "field" =>  isset($content) ? $content->field($d->name, $l->id) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

    @if($d->type == "file")
        {{-- FIELD FILE --}}
        @include("admin.content.contents.fields.file", [
            "field" => isset($content) ? $content->field($d->name, $l->id) : null,
            "fieldname" => "inputs[" . $l->id . "][" . $d->name . "]",
            "definition" => $d,
            "index" => $index
        ])
    @endif

@endforeach

<!-- END CUSTOMES FIELDS -->


@push('javascripts')
<script>
    $(".image-toogle-remove").on('click',function(e){
        e.preventDefault();
        $(this).parent().find('input').val("");
        $(this).parent().find('.img-preview').empty();
    });

    $('.image-toogle').on("click", function(e){
        e.preventDefault();

        var el = $(this);

        app.mediaSelector.init({
            onSubmit : function(obj) {

                if(app.mediaSelector.isCropped) {
                    app.mediaSelector.image.cropper('getCroppedCanvas').toBlob(function (blob) {

                        var formData = new FormData();
                        formData.append('file', blob);
                        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));


                        $.ajax(app.mediaSelector.URLs.post, {
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                el.parent().find('input[type="hidden"]').val(response.stored_filename);

                                $(document).trigger("mainImageSelected", [response]);

                                var imagePreview = '<tr><td width="100" height="100">';
                                imagePreview  += '<img width="200px;" height="auto" src="/storage/medias/' + response.stored_filename + '" />';
                                imagePreview  += '</td><td></td><td width="100"></tr>';

                                el.parent().find('.img-preview').html(imagePreview);
                                app.mediaSelector.close();
                            },
                            error: function () {
                                console.log('Upload error');
                            }
                        });
                    });

                    return;
                } else {
                    el.parent().find('input[type="hidden"]').val(obj.file);

                    $(document).trigger("mainImageSelected", [obj]);

                    var imagePreview = '<tr><td width="100" height="100">';
                    imagePreview  += '<img width="200px;" height="auto" src="/storage/medias/' + obj.file + '" />';
                    imagePreview  += '</td><td></td><td width="100"></tr>';

                    el.parent().find('.img-preview').html(imagePreview);

                    app.mediaSelector.close();
                }


            }
        });
    });

</script>
@endpush()
