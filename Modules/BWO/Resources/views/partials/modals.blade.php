    <!-- Modal Login -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="login-left">
                        <div class="modal-body sub-left-square">
                            <form role="form" method="POST" action="{{ route('login') }}">
                              {{ csrf_field() }}
                                <h3>VOUS AVEZ UN COMPTE</h3>
                                    <input type="text" id="log-email" name="email" value="" placeholder="Identifiant" class="form-control" />
                                    @if ($errors->has('email'))
                                      <p class="control-label error-login-p">{{ $errors->first('email') }}</p>
                                    @endif

                                    <input type="password" id="log-password" name="password" value="" placeholder="Mot de passe" class="form-control" />
                                    @if ($errors->has('password'))
                                      <p class="control-label error-login-p">{{ $errors->first('password') }}</p>
                                    @endif
                                    <a href="/password/reset">Mot de passe oublié ?</a>
                                    <br clear="all">

                                    <button type="submit" onclick="app.offerapplications.login()" id="loginButton" class="btn btn-red full-width mt-10"><i class="fa fa-user"></i>Se Connecter</button>
                                    <img class="loader" id="loginLoader" src="{{asset('modules/bwo/images/loader.gif')}}" />
                            </form>
                        </div>
                    </div>
                    <div class="register-right">
                        <div class="modal-body">
                            <form role="form" method="POST" action="">
                              {{ csrf_field() }}
                                <h3>VOUS N'AVEZ DE COMPTE</h3>
                                    <input type="text" id="reg-email" name="email" value="" placeholder="E-mail" class="form-control" />
                                    @if ($errors->has('email'))
                                      <p class="control-label error-login-p">{{ $errors->first('email') }}</p>
                                    @endif

                                    <input type="text" id="reg-lastname" name="lastname" value="" placeholder="Nom" class="form-control" />
                                    @if ($errors->has('lastname'))
                                      <p class="control-label error-login-p">{{ $errors->first('lastname') }}</p>
                                    @endif

                                    <input type="text" id="reg-firstname" name="firstname" value="" placeholder="Prénom" class="form-control" />
                                    @if ($errors->has('firstname'))
                                      <p class="control-label error-login-p">{{ $errors->first('firstname') }}</p>
                                    @endif

                                    <input type="text" id="reg-telephone" name="telephone" value="" placeholder="Téléphone" class="form-control" />
                                    @if ($errors->has('telephone'))
                                      <p class="control-label error-login-p">{{ $errors->first('telephone') }}</p>
                                    @endif

                                  <input type="text" id="reg-postal_code" name="postal_code" value="" placeholder="Code postal" class="form-control" />
                                  @if ($errors->has('postal_code'))
                                    <p class="control-label error-login-p">{{ $errors->first('postal_code') }}</p>
                                  @endif

                                 <input type="text" id="reg-location" name="location" value="" placeholder="Ville" class="form-control" />
                                 @if ($errors->has('location'))
                                   <p class="control-label error-login-p">{{ $errors->first('location') }}</p>
                                 @endif


                                  <button type="submit" onclick="app.offerapplications.register()" id="regButton" class="btn btn-dark-gray full-width"><i class="fa fa-user"></i>Créer un compte</button>
                                  <img class="loader" id="regLoader" src="{{asset('modules/bwo/images/loader.gif')}}" />
                            </form>
                        </div>
                    </div>
                    <div class="modal-error" id="loginModalError">
                        <p>Tous les champs sont obligatoires, merci de les compléter.</p>
                    </div>
                </div>

            </div>
        </div>
    <!-- End Modal Login -->

    <!-- Modal Postuled -->
        <div class="modal fade" id="postuledModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-message">
                        <div class="modal-body">
                                <div class="row">
                                    <h3>Votre candidaturea bien été enregistré</h3>
                                    <p>Notre équipe reviendra vers vous rapidement</p>
                                </div>
                                <br clear="all">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Modal Postuled -->

    <!-- Modal CV -->
        <div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-cv">
                        <div class="modal-body">
                            <form role="form" id="cv-form" method="POST" action="{{ route('candidate.addcv') }}" enctype="multipart/form-data">
                                <h3>Ajoutez votre CV pour créer votre compte</h3>

                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="fileinputs">
                                        <input type="file" id="resume_file" name="resume_file" class="file" onchange="app.offerapplications.addFileTofake()" />
                                        <div class="fakefile">
                                            <input id="fake-input" />
                                            <div class="button-upload-fake"><i class="fa fa-paperclip" aria-hidden="true"></i>CHOISIR UN FICHIER</div>
                                        </div>
                                    </div>
                                    <p><small>Fichier autorisés : .doc, .pdf, docx</small></p>
                                </div>


                                 <div class="row">
                                    <button type="submit" id="upload-button" class="btn btn-primary">ENVOYER MON CV</button>
                                    <img class="loader" id="upload-loader" src="{{asset('modules/bwo/images/loader.gif')}}" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-error" id="cvModalError">
                        <p>Le CV est obligatoire à la création du compte.</p>
                    </div>
                </div>

            </div>
        </div>
    <!-- End Modal CV -->

    <!-- Modal Alerts -->
        <div class="modal fade" id="alertsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-tags">
                        <div class="modal-body">
                            <form role="form" method="POST" action="">
                                <h3>Choisissez vos alertes</h3>
                                {{-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet </p> --}}
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="fileinputs">

                                    </div>
                                </div>

                                 <div class="row">
                                    <button type="button" class="btn btn-primary" onclick="app.offerapplications.addTag();app.offerapplications.goToApply()">CONTINUER</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-error" id="tagModalError">
                    </div>
                </div>

            </div>
        </div>

    <!-- End Modal Alerts -->

    <!-- Modal Registered -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-cv">
                        <div class="modal-body">
                                <h3>Est vous sur de vouloir postuler?</h3>
                                 <div class="row">
                                    <button type="button"  onclick="app.offerapplications.apply()" class="btn btn-primary  apply-btn">OUI</button>
                                    <button type="button"  onclick="$('#confirmationModal').modal('hide')" class="btn btn-secondary apply-btn" style="background-color: #394050;">NON</button>
                                    <img class="loader applyLoader" src="{{asset('modules/bwo/images/loader.gif')}}" />
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <!-- End Modal Registered -->


    <!-- Modal Registered -->
        <div class="modal fade" id="registeredModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-cv">
                        <div class="modal-body">
                                <h3>Votre compte a bien été créé</h3>
                                <p>Vous pouvez maintenant postuler aux offres </p>
                                 <div class="row">
                                    <button type="button"  onclick="app.offerapplications.apply()" class="btn btn-primary  apply-btn">POSTULER</button>
                                    <img class="loader applyLoader" src="{{asset('modules/bwo/images/loader.gif')}}" />
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <!-- End Modal Registered -->


       <!-- Modal Already Potuled -->
        <div class="modal fade" id="alreadyPostuledModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-message">
                        <div class="modal-body">
                                <div class="row">
                                    <h3>Vous êtes déjà postulé dans cette offre</h3>
                                    <p></p>
                                </div>
                                <br clear="all">
                                 <div class="row">
                                    <button type="button" class="btn btn-primary">Mon Compte</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Already Potuled  -->

    <!-- Modal Already Potuled -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-message">
                        <div class="modal-body">
                                <div class="row">
                                    <h3 id="error-msg-modal">Vous êtes déjà postulé dans cette offre</h3>
                                    <p></p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Already Potuled  -->


    @push('javascripts')
      <script>
          $(document).ready(function() {
              $('select#alerts').select2();
          });
      </script>
    @endpush
