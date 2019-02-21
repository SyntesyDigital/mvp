$(function() {
   $('#table-agences').DataTable({
        language: {
            "url": "/modules/extranet/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: routes.data,
        columns: [
            {data: 'id', name: 'id', width: "40"},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
			DataTableTools.init(this);
        }
   });
});
