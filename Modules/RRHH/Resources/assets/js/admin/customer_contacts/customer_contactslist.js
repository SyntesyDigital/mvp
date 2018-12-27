$(function() {
   $('#table-customer_contacts').DataTable({
        language: {
            "url": "/modules/rrhh/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: routes.data,
        columns: [
            {data: 'id', name: 'id', width: "40"},
            {data: 'name', name: 'name'},
            {data: 'function', name: 'function'},
            {data: 'email', name: 'email'},
            {data: 'phone_number_1', name: 'phone_number_1'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
			DataTableTools.init(this);
        }
   });
});
