//------------------------------------------//
//      ARCHITECT DIALOG
//      @syntey-digital - 2018
//------------------------------------------//
architect.dialog = {

    confirm: function(msg, _callback) {
        bootbox.confirm({
            message: msg,
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                _callback(result);
            }
        });
    }

};
