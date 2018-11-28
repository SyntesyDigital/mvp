$(function() {

    $('form.delete-user-form').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir supprimer cette utilisateur ?',
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
                    $('form.delete-user-form')
                        .off('submit')
                        .trigger('submit');
                }
            }
        });
    });

    $('form.check-incative-user-form').on('submit', function(e){
        e.preventDefault();
        if($('#old_status').val() != inactive_value && $('#status').val() == inactive_value ){
            bootbox.confirm({
                message: 'Etes-vous sur de vouloir sauvegarder cette utilisateur comme inactif?',
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
                        $('form.check-incative-user-form')
                            .off('submit')
                            .trigger('submit');
                    }
                }
            });
        }else{
            $('form.check-incative-user-form')
                        .off('submit')
                        .trigger('submit');                        
        }
        
    });

});
