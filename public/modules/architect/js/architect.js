//------------------------------------------//
//      BOOTSTRAP FOR ARCHITECT LIB
//      @syntey-digital - 2018
//------------------------------------------//
var architect = {

    currentUserHasRole: function(roleName) {
        var user = CURRENT_USER;

        if(!user) {
            return false;
        }

        var role = user.roles.filter(function(r){
            if(r.name == roleName) {
                return r;
            }
        });

        return role.length > 0 ? true : false;
    },

};

//------------------------------------------//
//      ARCHITECT DIALOG
//      @syntey-digital - 2018
//------------------------------------------//
architect.dialog = {

    confirm: function(msg, _callback) {
        bootbox.confirm({
            message: msg,
            buttons: {
                confirm: {
                    label: 'Sí',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                }
            },
            callback: function (result) {
                _callback(result);
            }
        });
    }

};

//------------------------------------------//
//      ARCHITECT MEDIAS MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.medias = {

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
            createImageThumbnails : false,
            // acceptedFiles: _this._settings.acceptedFiles,
            addRemoveLinks: false,
            maxFilesize: _this._settings.maxFilesize,
            paramName: _this._settings.paramName,
            /*
            thumbnail: function(file, dataUrl) {
                return false;
            }*/
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
        _this.refresh();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    	    language: {
    	        "url": "/modules/architect/plugins/datatables/locales/french.json"
    	    },
    		  processing: true,
          //serverSide: true, Disabled beacuse break the Order
          ordering: true,
    	    pageLength: 20,
          language: {
              url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
          },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
    	        // {data: 'id', name: 'id', width: '40'},
              {data: 'preview', name: 'preview'},
  	          {data: 'uploaded_filename', name: 'uploaded_filename'},
              {data: 'type', name: 'type'},
              {data: 'author', name: 'author'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {

                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Esborrat correctament!', {timeOut: 3000});
                        _this.refresh();
                    },

                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        /*
        datatable.ajax.reload(function(){
            _this.initEvents();
        });
        */
    },

    initEvents: function()
    {
        var table = this._settings.table;
        var datatable = table.DataTable();
        var _this = this;

        $(document).on('click','.toogle-edit', function(e) {
            e.preventDefault();

            if(_this._editModal !== undefined) {
                _this._editModal.modalOpen($(this).data('id'));
            }
        });

    }
}

//------------------------------------------//
//      ARCHITECT CONTENT MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.contents = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            //serverSide: true,
            order: [],
             pageLength: 30,
              language: {
                  url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
              },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'title', name: 'title'},
                {data: 'typology', name: 'typology'},
                {data: 'updated', name: 'updated'},
                {data: 'author', name: 'author'},
                {data: 'status', name: 'status'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Succès !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        var _this = this;
        _this._settings.table.find('.toogle-edit')
            .off('click')
            .on('click', function(e) {
                e.preventDefault();

                if(_this._editModal !== undefined) {
                    _this._editModal.modalOpen($(this).data('id'));
                }
            });
    }
}

//------------------------------------------//
//      ARCHITECT TAG MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.tags = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            serverSide: true,
    	    pageLength: 20,
              language: {
                  url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
              },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'name', name: 'name'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Success !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        var _this = this;
        _this._settings.table.find('.toogle-edit')
            .off('click')
            .on('click', function(e) {
                e.preventDefault();

                if(_this._editModal !== undefined) {
                    _this._editModal.modalOpen($(this).data('id'));
                }
            });
    }
}

//------------------------------------------//
//      ARCHITECT USERS MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.users = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            serverSide: true,
    	    pageLength: 20,
              language: {
                  url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
              },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'name', name: 'name'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Success !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        var _this = this;
        _this._settings.table.find('.toogle-edit')
            .off('click')
            .on('click', function(e) {
                e.preventDefault();

                if(_this._editModal !== undefined) {
                    _this._editModal.modalOpen($(this).data('id'));
                }
            });
    }
}

//------------------------------------------//
//      ARCHITECT PAGE LAYOUT MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.pageLayouts = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            serverSide: true,
    	    pageLength: 20,
              language: {
                  url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
              },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'name', name: 'name'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Success !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        var _this = this;
        _this._settings.table.find('.toogle-edit')
            .off('click')
            .on('click', function(e) {
                e.preventDefault();

                if(_this._editModal !== undefined) {
                    _this._editModal.modalOpen($(this).data('id'));
                }
            });
    }
}

//------------------------------------------//
//      ARCHITECT MENU MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.menu = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            //serverSide: true,
    	      pageLength: 20,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
            },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'name', name: 'name'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Success !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                //_this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        var _this = this;

        $(document).on('click','.toogle-edit', function(e) {
            e.preventDefault();

            if(_this._editModal !== undefined) {
                _this._editModal.modalOpen($(this).data('id'));
            }
        });


    }


}


//------------------------------------------//
//      ARCHITECT MENU FORM
//      @syntey-digital - 2018
//------------------------------------------//

architect.menu.form = {
    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.initEvents();

        if(this._settings.menuId != null){
          this.loadMenuItems();
        }
        else {
          this.initSortable(null);
        }

        this.currentId = 1000; // FIXME que sea otro valor

    },

    initEvents : function()
    {
      var _this = this;


      $(".add-new-item").click(function(e){

        e.preventDefault();

        console.log("architect.menu.form :: add-new-item",_this._editModal);

        if(_this._editModal !== undefined) {
            _this._editModal.modalOpen();
        }
      });

      $(document).on('click','.btn-delete',function(e){
          e.preventDefault();

          _this.deleteItem($(e.target).closest('.menu-item'));
      });

      $(document).on('click','.btn-edit',function(e){
          e.preventDefault();

          _this.editItem($(e.target).closest('.menu-item'));
      });

      $("#menu-form").submit(function(e){
        e.preventDefault();

        _this.submitForm();
      });


    },

    refresh : function()
    {
      console.log("architect.menu.form :: refresh");
    },

    appendItem : function(item)
    {
        var classSelector = "";

    		console.log("architect.menu :: appendItem => ",item);
    		//console.log(item.parent_id);

        if(item.parent_id == null){
    			classSelector = ".sortable-list";
    		}
    		else {
    			classSelector = ".category-container-"+item.parent_id;
    		}

        //var fieldJSON = JSON.stringify(item.field);
        //console.log("Field JSON => ",fieldJSON);

    		var divItem = $(classSelector).append(''+
    			'<li id="menu-'+item.id+'" class="item menu-item drag" data-id="'+item.id+'" data-class="category" >'+
              '<div class="item-bar">'+
      	  			'<i class="fa fa-bars"></i> &nbsp; <span id="item-name">'+item.name+'</span>'+
      	  			'<div class="actions">'+
      		  			'<a href="#" class="btn btn-link btn-edit"><i class="fa fa-pencil"></i> &nbsp; Editar</a>&nbsp;'+
      		  			'<a href="#" class="btn btn-link text-danger btn-delete"><i class="fa fa-trash"></i> &nbsp; Esborrar</a>'+
      		  		'</div>'+
              '</div>'+
    	  			'<ol class="category-container-'+item.id+'">'+
    			  	'</ol>'+
    	  		'</li>'
    		);

        $("#menu-"+item.id).data('field',JSON.stringify(item.field));
    },

    initSortable : function(items) {

      $(".sortable-list").empty();

      var self = this;

      if(items != null) {
        var item;
        for(var id in items){
          item = items[id];
          self.appendItem(item);
        }
      }

      self.group = $("ol.sortable-list").sortable({
        onDrop: function ($item, container, _super) {

            var parent = container.el.parent();
            var data = self.group.sortable("serialize").get();
            _super($item, container);

            console.log("architect.menu.form :: Data => ",data)
        }
      });

    },

    loadMenuItems : function() {

      var self = this;

      $.getJSON(routes.getData,function(data){

        console.log("architect.menu :: loadData :: ",data);

    		//create tree
    		var items = data;

        self.initSortable(items)

      });

    },

    createItem : function(field) {

      console.log("createItem : "+field);

      var data = {
      	"name": field.value.title['es'],
      	"id": this.currentId++,
      	"parent_id": null,
      	"order": null,
      	"level": null,
        "field" : field
      };

      this.appendItem(data);

      $(".add-row-block").removeClass('has-error');
    },

    editItem : function(item) {

      var itemId = item.attr('id').split('-')[1];
      console.log("architect.menu editItem => ",itemId);

      this._editModal.modalOpen(
        item.data('field'),
        item.attr('id').split('-')[1]
      );

    },

    updateItem : function(field,itemId) {

      console.log("architect.menu.updateItem => ",field,itemId);

      $("#menu-"+itemId).data('field',JSON.stringify(field));
      $("#menu-"+itemId+" #item-name").html(field.value.title['es']);

    },

    deleteItem : function(item)
    {
        var ajax = item.data('ajax');

        architect.dialog.confirm("Estas segur ? ", function(result){
            if(result) {

                var itemId = item.attr('id').split('-')[1];
                var parent = item.parent();

                item.find('.category-container-'+itemId).contents().appendTo(parent);
                item.remove();

            }
        });
    },


    /************** SAVE ***************/

    submitForm : function(){

      $("#name").closest('.form-group').removeClass('has-error');
      $(".add-row-block").removeClass('has-error');

      var params = {
        fields : this.group.sortable("serialize").get(),
        name : $("#name").val(),
        settings : null,
        _token: csrf_token
      }

      if(this._settings.menuId != null){
        this.update(params);
      }
      else {
        this.create(params);
      }

    },

    create : function(params)
    {
        var self = this;

        $.ajax({
            method: 'PUT',
            url: routes.menuStore,
            data: params
        })
        .done(function(response) {

            console.log("Response errors => ",response);

            if(response.success) {
                self.onSaveSuccess(response);

                setTimeout(function(){
                    window.location.href = routes.menuShow.replace(':id',response.menu.id);
                },1500);

            } else {
                self.onSaveError(response);
            }
        }).fail(function(response){
            self.onSaveError(response.responseJSON);
        });
    },

    update : function(params)
    {
        var self = this;

        $.ajax({
            method: 'PUT',
            url: routes.menuUpdate,
            data: params
        })
        .done(function(response) {
            if(response.success) {
                self.onSaveSuccess(response);
            } else {
                self.onSaveError(response);
            }
        }).fail(function(response){
            self.onSaveError(response.responseJSON);
        });
    },

    onSaveSuccess : function(response)
    {


        toastr.success('Menu guardat correctament!');
    },


   onSaveError : function(response)
   {
       var errors = response.errors ? response.errors : null;

       if(errors.name !== undefined){
         $("#name").closest('.form-group').addClass('has-error');
       }

       if(errors.fields !== undefined){
         $(".add-row-block").addClass('has-error');
       }

       toastr.error('Algun error al guardar');

     }

}

//------------------------------------------//
//      ARCHITECT LANGUAGES MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.languages = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            serverSide: true,
    	      pageLength: 20,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
            },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'default', name: 'default'},
                {data: 'name', name: 'name'},
                {data: 'iso', name: 'iso'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Success !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        //
    }
}

architect.languages.form = {
    settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.initEvents();
    },

    initEvents: function()
    {
        var self = this;

        $(document).on('click','[data-toogle="delete"]',function(e){
          e.preventDefault();
          var button = $(e.target).closest('[data-toogle="delete"]');
          self._delete(button);
        });
    },

    /*
     *  Delete toogle on button or link (<a href="">...</a>)
     *
     *  Toogle :
     *     data-toogle="delete"
     *  Params :
     *      data-confirm-message="Message we want to display for confirm"
     *      (optional) data-ajax="http://..."
     *      (optional) data-redirect="http://..."
     *
     */
    _delete: function( el)
    {
        var _this = this;

        var ajax = el.data('ajax');
        var redirect = el.data('redirect');
        var confirmMessage = el.data('confirm-message');

        architect.dialog.confirm(confirmMessage, function(result){
            if(result) {

                if(redirect) {
                    window.location = redirect;
                    return;
                }

                if(ajax) {
                    $.ajax({
                        method: 'DELETE',
                        url: ajax,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        }
                    })
                    .done(function(response) {
                        if(response.success) {
                            if(_this._settings.onDelete !== undefined) {
                                _this._settings.onDelete(response);
                            } else {
                                toastr.success(response.message, 'Correcte !', {timeOut: 3000});
                            }

                            window.location.href = _this._settings.reloadRoute;

                        } else {
                            toastr.error(response.message, 'Error !', {timeOut: 3000});
                        }
                    }).fail(function(response){
                        toastr.error(response.message, 'Error !', {timeOut: 3000});
                    });
                    return;
                }

            }
        });

    }
}

//------------------------------------------//
//      ARCHITECT TRADUCCIONS MANAGER
//      @syntey-digital - 2018
//------------------------------------------//
architect.translations = {

    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.setDatatable();
    },

    setDatatable: function()
    {
        var _this = this;

        var table = _this._settings.table.DataTable({
    		processing: true,
            serverSide: true,
    	      pageLength: 20,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
            },
    	    ajax: _this._settings.table.data('url'),
    	    columns: [
                {data: 'name', name: 'name'},
                {data: 'value', name: 'value'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Success !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    },

    refresh: function()
    {
        var _this = this;
        var table = this._settings.table;
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();
        });
    },

    initEvents: function()
    {
        //
    }
}

architect.translations.form = {
    settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.initEvents();
    },

    initEvents: function()
    {
        var self = this;

        $(document).on('click','[data-toogle="delete"]',function(e){
          e.preventDefault();
          var button = $(e.target).closest('[data-toogle="delete"]');
          self._delete(button);
        });
    },

    /*
     *  Delete toogle on button or link (<a href="">...</a>)
     *
     *  Toogle :
     *     data-toogle="delete"
     *  Params :
     *      data-confirm-message="Message we want to display for confirm"
     *      (optional) data-ajax="http://..."
     *      (optional) data-redirect="http://..."
     *
     */
    _delete: function( el)
    {
        var _this = this;

        var ajax = el.data('ajax');
        var redirect = el.data('redirect');
        var confirmMessage = el.data('confirm-message');

        architect.dialog.confirm(confirmMessage, function(result){
            if(result) {

                if(redirect) {
                    window.location = redirect;
                    return;
                }

                if(ajax) {
                    $.ajax({
                        method: 'DELETE',
                        url: ajax,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        }
                    })
                    .done(function(response) {
                        if(response.success) {
                            if(_this._settings.onDelete !== undefined) {
                                _this._settings.onDelete(response);
                            } else {
                                toastr.success(response.message, 'Correcte !', {timeOut: 3000});
                            }

                            window.location.href = _this._settings.reloadRoute;

                        } else {
                            toastr.error(response.message, 'Error !', {timeOut: 3000});
                        }
                    }).fail(function(response){
                        toastr.error(response.message, 'Error !', {timeOut: 3000});
                    });
                    return;
                }

            }
        });

    }
}
