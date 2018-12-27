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
            {data: 'sent_at', name: 'sent_at'},
            {data: 'is_readed', name: 'is_readed'},
            {data: 'sender', name: 'sender'},
            {data: 'recipient', name: 'recipient'},
            {data: 'message', name: 'message'},
            {data: 'theme', name: 'theme'},
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

            dialog.confirm('Etes-vous sur de vouloir cette discussion ?', function(confirm){
                if(confirm) {
                    document.location.replace(self.attr('href'));
                }
            });
        });
    }
});
