$(function() {

    // Loading data
    var table = $('#table-credits').DataTable({
        language: {
            "url": "/modules/rrhh/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: routes.data,
        columns: [
            {data: 'done_at', name: 'done_at'},
            {data: 'quantity', name: 'quantity'},
            {data: 'type', name: 'type'},
            {data: 'status', name: 'status'}
        ],
        initComplete: function() {
            initEvents(table);
        }
    });


    var initEvents = function(table) {

    }

});
