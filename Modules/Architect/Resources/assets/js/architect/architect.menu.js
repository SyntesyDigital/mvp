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

            // FIXME : Find a better way :)
            table.find('[data-toogle="delete"]').each(function(k,v){
                DataTableTools._delete(datatable, $(this));
            });
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
        this.loadMenuItems();

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

    loadMenuItems : function() {

      var self = this;

      $.getJSON(routes.getData,function(data){

        console.log("architect.menu :: loadData :: ",data);

    		//create tree
    		var items = data;
        var item;

    		$(".sortable-list").empty();

    		for(var id in items){
    			item = items[id];
    			self.appendItem(item);
    		}

        self.group = $("ol.sortable-list").sortable({
          onDrop: function ($item, container, _super) {

    			    var parent = container.el.parent();
              var data = self.group.sortable("serialize").get();
    			    _super($item, container);

              console.log("architect.menu.form :: Data => ",data)

              //self.updateOrder();
    			}
    		});

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
    },

    updateOrder : function() {

      var self = this;

      var newOrder = this.group.sortable("serialize").get();

      console.log("update Order => ",newOrder);

      $.ajax({
            type: 'POST',
            url: routes.updateOrder,
            data: {
              _token: csrf_token,
              order : newOrder
            },
            dataType: 'html',
            success: function(data){

                var rep = JSON.parse(data);

                if(rep.success){
                    //change
                    toastr.success('Ordre guardat amb éxit', '', {timeOut: 3000});
                    //location.reload();
                }
                else {
                  //error
                  toastr.error('Error al guardar el nou ordre', '', {timeOut: 3000});
                }
            }
      });

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
            method: 'POST',
            url: routes.menuCreate,
            data: params
        })
        .done(function(response) {
            if(response.success) {
                self.onSaveSuccess(response);
            } else {
                self.onSaveError(response);
            }
        }).fail(function(response){
            self.onSaveError(response);
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
            self.onSaveError(response);
        });
    },

    onSaveSuccess : function(response)
    {
        toastr.success('Menu guardat correctament!');
    },


   onSaveError : function(response)
   {
       var errors = response.errors ? response.errors : null;

       if(response.message) {
           toastr.error(response.message);
       }
     }

}