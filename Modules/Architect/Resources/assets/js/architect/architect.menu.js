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

architect.menu.form = {
    _settings: null,
    _defaults: {},

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
        this.initEvents();
        this.loadCategories();

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

          _this.deleteItem($(e.target).closest('.btn-delete'));
      });
    },

    refresh : function()
    {
      console.log("architect.menu.form :: refresh");
    },

    appendCategory : function(category)
    {
        var classSelector = "";

    		console.log(category);
    		console.log(category.parent_id);

        if(category.parent_id == null){
    			classSelector = ".sortable-list";
    		}
    		else {
    			classSelector = ".category-container-"+category.parent_id;
    		}

    		$(classSelector).append(''+
    			'<li class="item drag" data-id="'+category.id+'" data-class="category">'+
              '<div class="item-bar">'+
      	  			'<i class="fa fa-bars"></i> &nbsp; '+category.name+
      	  			'<div class="actions">'+
      		  			'<a href="'+routes.showItem.replace(':id',category.id)+'" class="btn btn-link"><i class="fa fa-pencil"></i> &nbsp; Editar</a>&nbsp;'+
      		  			'<a href="#" data-ajax="'+routes.deleteItem.replace(':id',category.id)+'" class="btn btn-link text-danger btn-delete"><i class="fa fa-trash"></i> &nbsp; Esborrar</a>'+
      		  		'</div>'+
              '</div>'+
    	  			'<ol class="category-container-'+category.id+'">'+
    			  	'</ol>'+
    	  		'</li>'
    		);
    },

    loadCategories : function() {

      var self = this;

      $.getJSON(routes.getData,function(data){

    		//create tree
    		var items = data;
        var item;

    		$(".sortable-list").empty();

    		for(var id in items){
    			item = items[id];
    			self.appendCategory(item);
    		}

        self.group = $("ol.sortable-list").sortable({
          onDrop: function ($item, container, _super) {

    			    var parent = container.el.parent();
              var data = self.group.sortable("serialize").get();
    			    _super($item, container);

              self.updateOrder();
    			}
    		});

      });

    },

    updateOrder() {

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

    deleteItem(item)
    {
        var ajax = item.data('ajax');

        architect.dialog.confirm("Estas segur ? ", function(result){
            if(result) {

                if(ajax) {
                    $.ajax({
                        method: 'DELETE',
                        url: ajax,
                        data: {
                            _token: csrf_token,
                        }
                    })
                    .done(function(response) {
                        if(response.success) {
                            toastr.success("Esborrat correctament", '', {timeOut: 3000});
                            window.location.href = "";

                        } else {
                            toastr.error("Error al esborrar", '', {timeOut: 3000});
                        }
                    }).fail(function(response){
                        toastr.error("Error al esborrar", '', {timeOut: 3000});
                    });
                    return;
                }

            }
        });
    }


}
