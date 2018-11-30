$(function() {
   $('#table-applications').DataTable({
        language: {
            "url": "/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: routes.data,
        columns: [
            {data: 'title', name: 'title', width: "40"},
            {data: 'done_at', name: 'done_at', width: "40"},
            {data: 'status', name: 'status', width: "40"},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ],
        initComplete: function () {

        }
   });
});
