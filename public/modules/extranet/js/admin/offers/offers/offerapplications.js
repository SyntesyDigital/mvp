app.offerapplications = {

    source: '',
    actual_target: '',

    init: function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        $(document).ready(function() {
            $('.draggable')
                .attr('draggable', 'true')
                .bind('dragstart', function(e) {
                    var dt = e.originalEvent.dataTransfer;
                    dt.setData('text/html', null);
                })
                .bind('dragend', function(ev) {
                    return false;
                });
        });
    },


    dragstart: function(e) {
        source = e.target;
        if (source.nodeName == 'A') {
            source = source.parentNode.parentNode;
        } else {
            if (source.nodeName == "P") {
                source = source.parentNode;
            }
        }
        e.dataTransfer.effectAllowed = 'move';
    },

    dragover: function(e) {
        e.preventDefault();
        var targetelem = e.target;
    },

    drop: function(e, status) {

        var targetelem = e.target;
        if (targetelem.nodeName == 'A') {
            targetelem = targetelem.parentNode.parentNode.parentNode;
        } else {
            if (targetelem.nodeName == "P") {
                targetelem = targetelem.parentNode.parentNode;
            } else {
                if (targetelem.getAttribute('class') == 'candidate-drop-item') {
                    targetelem = targetelem.parentNode
                }
            }
        }

        var id = source.id
        var elements_hide_show = '';

        if (status == status_accepted) {
            e.preventDefault();
            bootbox.confirm({
                message: 'Etes-vous sur de vouloir accepter cette candidate?',
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
                callback: function(result) {
                    if (result) {

                        elements_hide_show = source.getElementsByClassName("showHideDnD");
                        for (var i = 0; i < elements_hide_show.length; i++) {
                            elements_hide_show[i].style.display = 'none';
                        }

                        $.ajax({
                            type: "POST",
                            url: "/architect/offers/application/" + source.id + "/update",
                            data: {
                                "status": status
                            },
                            success: function(data) {
                                toastr.success('L\'offre a eté fermée');
                            },
                            error: function() {
                                toastr.danger('Error');
                            }
                        });

                        var draggable_elements = document.getElementsByClassName("candidate-drop-item");
                        for (var i = 0; i < draggable_elements.length; i++) {
                            draggable_elements[i].removeAttribute("draggable");
                            draggable_elements[i].removeAttribute("ondragstart");
                        }
                        var dropable_columns = document.getElementsByClassName("dz");
                        for (var i = 0; i < dropable_columns.length; i++) {
                            dropable_columns[i].removeAttribute("ondrop");
                            dropable_columns[i].removeAttribute("ondragover");
                        }
                        $('#offer-closed').show();

                        targetelem.appendChild(source);
                    }
                }
            });
        } else {
            if (status == status_refused) {
                elements_hide_show = source.getElementsByClassName("showHideDnD");
                for (var i = 0; i < elements_hide_show.length; i++) {
                    elements_hide_show[i].style.display = 'none';
                }
            } else {
                elements_hide_show = source.getElementsByClassName("showHideDnD");
                for (var i = 0; i < elements_hide_show.length; i++) {
                    elements_hide_show[i].style.display = 'inline-block';
                }
            }

            $.ajax({
                type: "POST",
                url: "/architect/offers/application/" + source.id + "/update",
                data: {
                    "status": status
                },
                success: function(data) {
                    toastr.success('Candidat déplacé correctement');
                },
                error: function() {
                    toastr.danger('Error');
                }
            });

            targetelem.appendChild(source);
        }

    },

    changeOffer: function(e, application_id) {
        e.preventDefault();
        bootbox.confirm({
            message: '<form action="/architect/offers/application/' + application_id + '/move" method="post" id="changeOfferForm">' +
                '     Sélectionez l\'offre:<br />' +
                '     <select name="offer_select" id="offer_selec" class="form-control">' +
                other_offer_options +
                '     <select>' +
                '</form>',
            buttons: {
                confirm: {
                    label: 'Déplacer',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Annuler',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result) {

                    $.ajax({
                        type: "POST",
                        url: "/architect/offers/application/" + application_id + "/move",
                        data: {
                            "offer": document.getElementById("offer_selec").value
                        },
                        success: function(data) {
                            toastr.success('Le canddat a eté deplacé');
                            document.getElementById(application_id).style.display = 'none';
                        },
                        error: function() {
                            toastr.danger('Error');
                        }
                    });
                }
            }
        });
    }


}
