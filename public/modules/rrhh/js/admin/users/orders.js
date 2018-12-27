$(function() {

    var table = $('#table').DataTable({
        language: {
            "url": "/modules/rrhh/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: routes.data,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'ordered_at', name: 'ordered_at'},
            {data: 'product.name', name: 'product.name'},
            {data: 'expert', name: 'expert'},
            {data: 'product.theme.name', name: 'product.theme.name'},
            {data: 'product.price', name: 'product.price'},
            {data: 'status', name: 'status'},
            {data: 'comment', name: 'comment'},
            {data: 'is_paid', name: 'is_paid'},
            {data: 'action', name: 'action'}
        ],
        initComplete: function() {
            initEvents(table);
        }
    });


    var initEvents = function(table) {
        $(document).on('click','#table .toggle-delete',function(e){
            var self = $(this);
            e.preventDefault();

            dialog.confirm('Etes-vous sur de vouloir cette commande ?', function(confirm){
                if(confirm) {
                    document.location.replace(self.attr('href'));
                }
            });
        });
    }
});
