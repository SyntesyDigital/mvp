CKEDITOR.plugins.add('mediaSelector', {
    icons: 'mediaselector',
    init: function(editor) {

        editor.addCommand('openMediaSelector', {
            exec: function(editor) {
                app.mediaSelector.init({
                    onSubmit: function(data) {

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
                                        var newElement = new CKEDITOR.dom.element('img');
                                        newElement.setAttributes({
                                            src: app.mediaSelector.url + response.stored_filename
                                        })
                                        editor.insertElement(newElement);
                                        app.mediaSelector.close();
                                    },
                                    error: function () {
                                        console.log('Upload error');
                                    }
                                });
                            });

                            return;
                        } else {
                            var newElement = new CKEDITOR.dom.element('img');
                            newElement.setAttributes({
                                src: app.mediaSelector.url + data.file
                            })
                            editor.insertElement(newElement);
                            app.mediaSelector.close();
                        }


                    }
                });
            }
        });

        editor.ui.addButton('mediaselector', {
            label: 'Insert media',
            command: 'openMediaSelector',
            toolbar: 'architect'
        });

    }
});


CKEDITOR.plugins.add('overlaySelector', {
    icons: 'overlayselector',
    init: function(editor) {

        editor.addCommand('openOverlaySelector', {
            exec: function(editor) {
                app.overlaySelector.init({
                    onItemClick: function(id) {

                        editor.applyStyle(new CKEDITOR.style({
                            element: 'span',
                            attributes: {
                                'class': 'overlay:' + id
                            }
                        }));

                        var writer = CKEDITOR.instances[editor.name];
                        var html = writer.getData();

                        var filter = new CKEDITOR.htmlParser.filter({
                            elements: {
                                span: function(element) {
                                    if (element.attributes.class !== undefined) {
                                        if (element.attributes.class == 'overlay:' + id) {
                                            element.children[0].value = '[overlay=' + id + ']' + element.children[0].value + '[/overlay]';
                                        }
                                    }
                                }
                            }
                        });

                        var fragment = CKEDITOR.htmlParser.fragment.fromHtml(html);
                        var writer = new CKEDITOR.htmlParser.basicWriter();
                        filter.applyTo(fragment);
                        fragment.writeHtml(writer);
                        writer.getHtml();

                        CKEDITOR.instances[editor.name].setData(writer.getHtml());

                        app.overlaySelector.close();
                    }
                });
            }
        });

        editor.ui.addButton('overlaySelector', {
            label: 'Insert overlay',
            command: 'openOverlaySelector',
            toolbar: 'architect'
        });
    }
});

CKEDITOR.editorConfig = function(config) {
    config.htmlEncodeOutput = false; //HTML encode
    config.entities = false;
}

app.editor = {

    ckeditor: null,

    init: function(id, options) {
        var self = this;
        self.ckeditor = CKEDITOR.replace(id, options);


    },


    // wrap: function(startTag, endTag) {
    //     var sel, range;
    //     var selectedText;
    //
    //     var range = app.editor.el.summernote('createRange');
    //
    //     //console.log(range.getStartPoint());
    //     //console.log(range.getEndPoint());
    //
    //
    //     //console.log(range);
    //
    //     var selection = document.getSelection();
    // 	var cursorPos = selection.anchorOffset;
    // 	var oldContent = selection.anchorNode.nodeValue;
    // 	var toInsert = startTag+endTag;
    // 	var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
    // 	selection.anchorNode.nodeValue = newContent;
    //
    //
    //     /*
    //
    //     if (window.getSelection) {
    //         sel = window.getSelection();
    //         if (sel.rangeCount) {
    //             range = sel.getRangeAt(0);
    //             selectedText = range.toString();
    //             range.deleteContents();
    //             range.insertNode(document.createTextNode(startTag + selectedText + endTag));
    //         }
    //     }
    //     else if (document.selection && document.selection.createRange) {
    //         range = document.selection.createRange();
    //         selectedText = document.selection.createRange().text + "";
    //         range.text = startTag + selectedText + endTag;
    //     }
    //     */
    //
    // },
    // overlaySelector: function(context) {
    //
    //     var ui = $.summernote.ui;
    //
    //     var button = ui.button({
    //         contents: 'Overlay',
    //         tooltip: 'Add overlay',
    //         click: function (context) {
    //             //app.editor.wrap("[overlay:1]", "[/overlay]");
    //
    //             app.overlaySelector.init({
    //                 onItemClick: function(id) {
    //
    //                 	//console.log(id);
    //
    //                 	/*
    //                     app.editor.wrap(
    //                     	'<span id="overlay-'+id+'" class="s-overlay"></span>',
    //                     	'<span id="overlay-'+id+'" class="end-overlay"></span>'
    //                     );
    //                     */
    //
    //                     app.editor.wrap(
    //                     	'[overlay='+id+']',
    //                     	'[/overlay='+id+']'
    //                     );
    //
    //                     app.overlaySelector.close();
    //                 }
    //             });
    //         }
    //     });
    //
    //     return button.render();
    // },

    // mediaSelector: function (context) {
    //     var ui = $.summernote.ui;
    //
    //     var button = ui.button({
    //         contents: '<i class="fa fa-camera"/>',
    //         tooltip: 'Add image',
    //         click: function () {
    //             app.mediaSelector.init({
    //                 onSubmit: function(data) {
    //                     app.editor.insert({
    //                         'src' : '/uploads/' + data.file,
    //                         'title' : data.title
    //                     }, 'image');
    //                     app.mediaSelector.close();
    //                 }
    //             });
    //         }
    //     });
    //
    //     return button.render();
    // },
    //
    // getHtml() {
    //     return this.el.summernote('code');
    // },

    // updateBeforeSave() {
    //     this.el.summernote('code', this.getHtml());
    // },
    //
    // insert: function(data, type) {
    //     switch(type) {
    //         case 'overlay':
    //
    //         break;
    //
    //         case 'image':
    //             var img = document.createElement('img');
    //
    //             img.setAttribute('src', data.src);
    //             img.setAttribute('title', data.title);
    //
    //             app.editor.el.summernote('insertNode', img);
    //         break;
    //
    //         case 'link':
    //             var link = document.createElement('a');
    //             link.setAttribute('href', data.url);
    //
    //             app.editor.el.summernote('insertNode', link);
    //         break;
    //     }
    // }

}
