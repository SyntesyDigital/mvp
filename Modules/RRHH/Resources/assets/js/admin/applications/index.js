$(function() {
	$('#table').DataTable({
	    language: {
	        "url": "/modules/rrhh/plugins/datatables/locales/french.json"
	    },
	    processing: true,
	    serverSide: true,
	    pageLength: 30,
	    ajax: $('#table').data('url'),
	    columns: [
	        {data: 'id', name: 'id', width: "40"},
	        {data: 'candidate', name: 'candidate'},
            {data: 'candidate_type', name: 'candidate_type'},
            {data: 'offer', name: 'offer'},
            {data: 'done_at', name: 'done_at'},
            {data: 'status', name: 'status'},
	        {data: 'action', name: 'action', orderable: false, searchable: false}
	    ],
	    initComplete: function () {
			var _this = this;
			DataTableTools.init(this);
			$('#actions-th').css('min-width', '80px');
	    }
    });
});
