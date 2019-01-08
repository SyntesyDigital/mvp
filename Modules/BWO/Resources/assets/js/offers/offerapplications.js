app.offerapplications = {

    offer_id: '',
    user_id: '',
    cv: '',

    init: function(user, offer, cv) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        offer_id = offer;
        user_id = user;
        cv_url = cv;

        console.log("init :: offer_id : ",offer);

        var _this = this;

        $('#cv-form').on('submit', function(e) {
            e.preventDefault();
            _this.addCV();
        });

    },

    apply: function() {

        console.log("apply :: ",
          routes['offer.applications.create'].replace(':offer_id',offer_id)
        );

        $('.apply-btn').hide();
        $('.applyLoader').show();
        $.ajax({
            type: "POST",
            url: routes['offer.applications.create'].replace(':offer_id',offer_id),
            data: {},
            success: function(data, textStatus, xhr) {
                $('.apply-btn').show();
                $('.applyLoader').hide();
                $('.modal').modal('hide');
                if (xhr.status == 304) {
                    $('#alreadyPostuledModal').modal('show');
                } else {
                    $('#postuledModal').modal('show');
                }
                setTimeout(function() {
                    location.reload();
                }, 7000);
            },
            error: function() {
                $('.apply-btn').show();
                $('.applyLoader').hide();
                $('.modal').modal('hide');
                $('#error-msg-modal').html('Il y a eu une erreur dans l\'application');
                $('#errorModal').modal('show');
            }
        });

    },

    register: function() {
        $('#loginModalError').hide();
        $('#regButton').hide();
        $('#regLoader').show();
        $('#loginModalError').css('display', 'none');

        $.ajax({
            type: "POST",
            url: routes['candidate.store'],
            data: {
                civility: civility_default,
                email: $('#reg-email').val(),
                lastname: $('#reg-lastname').val(),
                firstname: $('#reg-firstname').val(),
                telephone: $('#reg-telephone').val(),
                location: $('#reg-location').val(),
                postal_code: $('#reg-postal_code').val(),
            },
            success: function(data, textStatus, xhr) {
                user_id = data["data"][" user_id"];
                $('.modal').modal('hide');
                $('#cvModal').modal('show');
                $('#regButton').show();
                $('#regLoader').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var error_data = false;
                if (typeof(jqXHR.responseJSON.errors["email"]) !== 'undefined') {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["email"][0]);
                    error_data = true;
                }
                if (typeof(jqXHR.responseJSON.errors["lastname"]) !== 'undefined' && !error_data) {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["lastname"][0]);
                    error_data = true;
                }
                if (typeof(jqXHR.responseJSON.errors["firstname"]) !== 'undefined' && !error_data) {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["firstname"][0]);
                    error_data = true;
                }
                if (typeof(jqXHR.responseJSON.errors["telephone"]) !== 'undefined' && !error_data) {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["telephone"][0]);
                    error_data = true;
                }

                if (typeof(jqXHR.responseJSON.errors["postal_code"]) !== 'undefined' && !error_data) {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["postal_code"][0]);
                    error_data = true;
                }

                if (typeof(jqXHR.responseJSON.errors["location"]) !== 'undefined' && !error_data) {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["location"][0]);
                    error_data = true;
                }

                if (error_data) {
                    $('#loginModalError').css('display', 'inline-block');
                } else {
                    $('#loginModalError p').html('Il y a eu une erreur dans le registre');
                }

                $('#regButton').show();
                $('#regLoader').hide();
            }
        });
    },

    login: function() {

        $('#loginModalError').hide();
        $('#loginButton').hide();
        $('#loginLoader').show();
        $('#loginModalError').css('display', 'none');

        $.ajax({
            type: "POST",
            url: routes.login,
            data: {
                email: $('#log-email').val(),
                password: $('#log-password').val(),
            },
            success: function(data, textStatus, xhr) {

                if (xhr.status == 304) {
                    $('#loginModalError p').html('Mot de passe incorret');
                    $('#loginModalError').css('display', 'inline-block');
                    $('#loginButton').show();
                    $('#loginLoader').hide();
                } else {
                    user_id = data["data"][" user_id"];
                    cv_url = data["data"]["resume_file"];

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var error_data = false;
                if (typeof(jqXHR.responseJSON.errors["email"]) !== 'undefined') {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["email"][0]);
                    error_data = true;
                }
                if (typeof(jqXHR.responseJSON.errors["password"]) !== 'undefined' && !error_data) {
                    $('#loginModalError p').html(jqXHR.responseJSON.errors["password"][0]);
                    error_data = true;
                }
                if (error_data) {
                    $('#loginModalError').css('display', 'inline-block');
                } else {
                    $('#loginModalError p').html('Il y a eu une erreur dans la connexion');
                }
                $('#loginButton').show();
                $('#loginLoader').hide();
            }
        });
    },

    loginEnterprise: function() {

        $('#enterpriseError').hide();
        $('#loginButton').hide();
        $('#loginLoader').show();
        $('#enterpriseError').css('display', 'none');

        $.ajax({
            type: "POST",
            url: routes.login,
            data: {
                email: $('#enterprise-email').val(),
                password: $('#enterprise-password').val(),
            },
            success: function(data, textStatus, xhr) {

                if (xhr.status == 304) {
                    $('#enterpriseError p').html('Mot de passe incorret');
                    $('#enterpriseError').css('display', 'inline-block');
                    $('#enterpriseButton').show();
                    $('#enterpriseLoader').hide();
                } else {
                    user_id = data["data"][" user_id"];

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var error_data = false;
                if (typeof(jqXHR.responseJSON.errors["email"]) !== 'undefined') {
                    $('#enterpriseError p').html(jqXHR.responseJSON.errors["email"][0]);
                    error_data = true;
                }
                if (typeof(jqXHR.responseJSON.errors["password"]) !== 'undefined' && !error_data) {
                    $('#enterpriseError p').html(jqXHR.responseJSON.errors["password"][0]);
                    error_data = true;
                }
                if (error_data) {
                    $('#enterpriseError').css('display', 'inline-block');
                } else {
                    $('#enterpriseError p').html('Il y a eu une erreur dans la connexion');
                }
                $('#enterpriseButton').show();
                $('#enterpriseLoader').hide();
            }
        });
    },

    addFileTofake: function() {
        var aux = $('#resume_file').val();
        $('#fake-input').val(aux.replace(/^.*[\\\/]/, ''));
    },

    addCV: function() {
        $('#upload-button').hide();
        $('#upload-loader').show();
        $('#cvModalError').css('display', 'none');

        //event.preventDefault();
        if(typeof(document.getElementById("resume_file").files[0]) == 'undefined'){
            $('#cvModalError p').html('Fichier invalide');
            $('#cvModalError').css('display', 'inline-block');
            $('#upload-button').show();
            $('#upload-loader').hide();
        }else{
        var formData = new FormData();
            formData.append("resume_file", document.getElementById("resume_file").files[0]);

            $.ajax({
                type: "POST",
                url: routes['candidate.addcv'],
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(response, textStatus, xhr) {
                    cv_url = response["data"]["resume_file"];
                    $('.modal').modal('hide');
                    $('#alertsModal').modal('show');
                    $('#upload-button').show();
                    $('#upload-loader').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var error_data = false;
                    if (typeof(jqXHR.responseJSON.errors["resume_file"]) !== 'undefined') {
                        $('#cvModalError p').html(jqXHR.responseJSON.errors["resume_file"][0]);
                        error_data = true;
                    }
                    if (error_data) {
                        $('#cvModalError').css('display', 'inline-block');
                    } else {
                       $('#cvModalError p').html('Une erreur s\'est produite lors du chargement du CV');
                       $('#cvModalError').css('display', 'inline-block');
                    }
                    $('#upload-button').show();
                    $('#upload-loader').hide();
                },


            });
        }
    },

    addTag: function() {
        var tag = $('#alerts').val();
        $('#tagModalError').hide();
        if (tag != '') {
            $.ajax({
                type: "POST",
                url: routes['candidate.addtag'],
                data: {
                    tag: tag
                },
                success: function(data, textStatus, xhr) {
                    if (xhr.status == 304) {
                        $('#tagModalError').css('display', 'inline-block');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var message = 'Une erreur s\'est produite';
                    $('#tagModalError')
                        .show()
                        .html(message);
                },
            });
        }
    },

    goToApply: function() {
        $('.modal').modal('hide');
        $('#registeredModal').modal('show');
    },

    open: function() {
        if (user_id == 0) {
            $('#loginModal').modal('show');
        } else {
            if ('' == cv_url) {
                $('#cvModal').modal('show');
            } else {
                $('#confirmationModal').modal('show');
            }
        }
    },

    openEnterprise: function() {

        $('#enterprise').modal('show');

    },
}
