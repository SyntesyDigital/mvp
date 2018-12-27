$(function() {

	var table = $('#table').DataTable({
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
					{data: 'postal_code', name: 'postal_code'},
					{data: 'location', name: 'location'},
          {data: 'candidate_type', name: 'candidate_type'},
           /* {data: 'cv', name: 'cv'},*/
          {data: 'done_at', name: 'done_at'},
          {data: 'status', name: 'status'},
	        {data: 'action', name: 'action', orderable: false, searchable: false}
	    ],
	    initComplete: function (settings, json ) {
			var _this = this;
			DataTableTools.init(this);

			// this.on('search.dt', function() {
			// 	setTimeout(function(){
			// 		DataTableTools.init(_this);
			// 	}, 500);
			// });
	    }
    });

	// table.ajax.reload(function(response){
	//    console.log('reload');
	// }, false);
});
