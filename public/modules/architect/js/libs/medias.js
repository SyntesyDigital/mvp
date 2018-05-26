var medias = {

    _dropzone: null,
    _settings: null,
    _defaults: {
        acceptedFiles : 'image/jpeg,image/png,image/gif',
        maxFilesize : 20, // MB
        paramName : 'file'
    },

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.initDropzone();
        this.setDatatable();
    },


    initDropzone: function()
    {
        var _this = this;

        var settings = {
            url: _this._settings.urls.store,
            uploadMultiple: false,
            parallelUploads: 1,
            // acceptedFiles: _this._settings.acceptedFiles,
            addRemoveLinks: false,
            maxFilesize: _this._settings.maxFilesize,
            paramName: _this._settings.paramName,
            thumbnail: function(file, dataUrl) {
                return false;
            }
        };

        this._dropzone = new Dropzone(_this._settings.identifier, settings);

        this._dropzone.on("error", function(file, response) {
            toastr.error(response.errors.file[0]);
        });

        this._dropzone.on("totaluploadprogress", function(progress) {
            $(".progress-bar").parent().addClass("progress-striped active");
            $(".progress-bar").width(progress + "%");
            $(".progress-bar").html(progress + "%");
        });

        this._dropzone.on("maxfilesreached", function() {
            toastr.error('Too many files added !');
        });

        this._dropzone.on("dragenter", function() {
            $('.medias-dropfiles').addClass("active");
        });

        this._dropzone.on("dragleave dragend dragover", function() {
            $('.medias-dropfiles').removeClass("active");
        });

        this._dropzone.on("maxfilesexceeded", function(file) {
            toastr.error('File ' + file.name + ' is too big !');
        });

        this._dropzone.on("queuecomplete", function(file, response) {
            setTimeout(function() {
                $(".progress-bar").parent().removeClass("progress-striped active");
                $(".progress-bar").width("0%");
                $(".progress-bar").html("");
            }, 2000);

            _this._dropzone.removeAllFiles(true);
        });


        this._dropzone.on("success", function(file, response) {
            _this.onSuccessUpload(_this);
        });
    },

    onSuccessUpload: function(_this)
    {
        toastr.success('File save correctly');
        _this._settings.table.DataTable().ajax.reload();
        _this.initEvents();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    	    language: {
    	        "url": "/modules/architect/plugins/datatables/locales/french.json"
    	    },
    		processing: true,
            serverSide: true,
    	    pageLength: 20,
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
    	        // {data: 'id', name: 'id', width: '40'},
                {data: 'preview', name: 'preview'},
    	        {data: 'uploaded_filename', name: 'uploaded_filename'},
                {data: 'type', name: 'type'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                _this.initEvents();

                DataTableTools.init(this, {
                    onDelete: function(response) {
                        _this._settings.table.DataTable().ajax.reload();
                        toastr.success(response.message, 'Succès !', {timeOut: 3000});
                        _this.initEvents();
                    }
                });
    	    }
        });
    },

    initEvents: function()
    {
        var _this = this;
        $('.toogle-edit').off('click').on('click', function(e) {
            e.preventDefault();
            _this._editModal.modalOpen($(this).data('id'));
        });
    }
}
