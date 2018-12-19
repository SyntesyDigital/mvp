$(function() {
	$('#table').DataTable({
	    language: {
	        "url": "/modules/rrhh/plugins/datatables/locales/french.json"
	    },
		processing: true,
      	serverSide: true,
	    pageLength: 10,
		order: [ 1, "desc" ],
	    ajax: $('#table').data('url'),
	    columns: [
	        {data: 'id', name: 'id', width: "40"},
	        {data: 'name', name: 'name'},
	        {data: 'action', name: 'action', orderable: false, searchable: false}
	    ],
	    initComplete: function () {
			var _this = this;
			DataTableTools.init(this);
	    }
    });
});
