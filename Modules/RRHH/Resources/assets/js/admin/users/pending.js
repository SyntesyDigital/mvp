$(function() {

    // Loading data
    var table = $('#table').DataTable({
        language: {
            "url": "/modules/rrhh/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: routes.data,
        columns: [
            {data: 'id', name: 'id', width: "40"},
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email'},
			      {data: 'telephone', name: 'telephone'},
            {data: 'created_at', name: 'created_at'},
            {data: 'partner', name: 'partner'},
			      {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {

            // Add filters columns
            // this.api().columns([5]).every(function() {
            //     var column = this;
            //     var select = $('<select><option value=""></option></select>')
            //         .appendTo($(column.footer()).empty())
            //         .on('change', function() {
            //             var val = $.fn.dataTable.util.escapeRegex($(this).val());
            //
            //             column
            //                 .search(val ? '^' + val + '$' : '', true, false)
            //                 .draw();
            //         });
            //
            //     column.data().unique().sort().each(function( d, j ) {
            //         select.append( '<option value="'+d+'">'+d+'</option>' )
            //     });
            // });
            initEvents(table);

        }
    });


    var initEvents = function(table) {

        $('#table').find('.trigger-partner')
        .off('change')
        .on('change', function(e){
            var user_id = $(this).data('id');
            var partner_id = $(this).val();

            $.ajax({
                method: 'POST',
                url: routes.partner,
                data: {
                    _token: csrf_token,
                    id: user_id,
                    partner_id : partner_id
                }
            })
            .done(function(response) {
                if(response.success) {
                    $('#table').DataTable().ajax.reload(function(response){
                        initEvents();
                    }, false);
                    toastr.success('Association mis à jours', 'Succès !', {timeOut: 3000});
                } else {
                    toastr.error('Une erreur s\'est produite', 'Erreur !', {timeOut: 3000});
                }
            }).fail(function(response){
                toastr.error('Une erreur s\'est produite', 'Erreur !', {timeOut: 3000});
            });

        });

        $('#table').find('.trigger-active')
            .off('click')
            .on('click', function(e){
                var id = $(this).data('id');

                $.ajax({
                    method: 'POST',
                    url: routes.active,
                    data: {
                        _token: csrf_token,
                        id: id
                    }
                })
                .done(function(response) {
                    if(response.success) {
                        $('#table').DataTable().ajax.reload(function(response){
                            initEvents();
                        }, false);
                        toastr.success('Utilisateur activé', 'Activé !', {timeOut: 3000});
                    } else {
                        toastr.error('Une erreur s\'est produite lors de l\'activation', 'Erreur !', {timeOut: 3000});
                    }
                }).fail(function(response){
                    toastr.error('Une erreur s\'est produite lors de l\'activation', 'Erreur !', {timeOut: 3000});
                });
            });


        $('#table').find('.trigger-refuse')
            .off('click')
            .on('click', function(e){
                var id = $(this).data('id');

                dialog.confirm('Etes-vous sur de vouloir refuser cet utilisateur ?', function(result){
                    if(result) {
                        $.ajax({
                            method: 'POST',
                            url: routes.refused,
                            data: {
                                _token: csrf_token,
                                id: id
                            }
                        })
                        .done(function(response) {
                            if(response.success) {
                                $('#table').DataTable().ajax.reload(function(response){
                                    initEvents();
                                }, false);
                                toastr.success('Cet utilisateur a été refusé ', 'Succès !', {timeOut: 3000});
                            } else {
                                toastr.error('Une erreur s\'est produite', 'Erreur !', {timeOut: 3000});
                            }
                        }).fail(function(response){
                            toastr.error('Une erreur s\'est produite', 'Erreur !', {timeOut: 3000});
                        });
                    }
                });

            });
    }

});
