$(function() {

    $('form.delete-customer_contact-form').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir supprimer ce contact ?',
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result) {
                    $('form.delete-customer_contact-form')
                        .off('submit')
                        .trigger('submit');
                }
            }
        });
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });



});
