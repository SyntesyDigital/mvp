$(function() {

    $('form.delete-customer-form').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir supprimer cette agence ?',
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
                    $('form.delete-customer-form')
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

function deleteFile(item){
    if(item == '1'){
        $('#image').val('');
    }
    $('.dz-div_'+item).show();
    $('#filename-p_'+item).html('');
    
}