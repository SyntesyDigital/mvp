@extends('architect::layouts.master')

@section('content')

    {!!
        Form::open([
            'url' => isset($user)
                ? route('rrhh.admin.candidates.update', $user)
                : route('rrhh.admin.candidates.store'),
            'method' => 'POST',
            'class' => 'check-inactive-candidate-form'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $user->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($user) ? 'PUT' : 'POST' }}">

        <div class="page-bar">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <a href="{{route('rrhh.admin.offers.index')}}" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
                <h1><i class="fa fa-newspaper-o"></i>&nbsp;Candidates</h1>
                <div class="float-buttons pull-right">

                  <div class="actions-dropdown">
                      <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
                        {{Lang::get('architect::fields.actions')}}
                        <b class="caret"></b>
                        <div class="ripple-container"></div>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-right default-padding">
                          <li class="dropdown-header"></li>
                          <!--li>
                              <a href="{{route('categories.create')}}">
                                  <i class="fa fa-plus-circle"></i>
                                  &nbsp;{{Lang::get('architect::fields.new')}}
                              </a>
                          </li-->
                          <li>
                              <a href="{{route('rrhh.admin.candidates.delete', $user->id)}}" class="text-danger">
                                  <i class="fa fa-trash text-danger"></i>
                                  &nbsp;
                                  <span class="text-danger">{{Lang::get('architect::fields.delete')}}</span>
                              </a>
                          </li>
                      </ul>
                    </div>


                  <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
                </div>
              </div>
            </div>
          </div>
        </div>


          <div class="container rightbar-page">

            <div class="col-md-9 page-content">

              <h3 class="card-title">Edition du candidat {{ isset($user) ? $user->full_name :'' }}</h3>

              <div class="form-group">
                  <label for="civility">Civilité</label>

                  <div class="radio" style="display: inline; margin-left:20px;">
                      <label style="font-size: .8em">
                           <input type="radio"  name="civility"  value="{{ Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE }}" {{isset($user) && $user->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE  ?'checked':'' }}>Monsieur
                      </label>
                      <label style="font-size: .8em">
                          <input type="radio" name="civility" value="{{ Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE }}" {{isset($user) && $user->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE  ?'checked':'' }}>Madame
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <label for="name">Nom</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="{{ $user->lastname or '' }}">
              </div>
              <div class="form-group">
                  <label for="name">Prénom</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="{{ $user->firstname or '' }}">
              </div>

              <div class="form-group">
                  <label for="name">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ $user->email or '' }}">
              </div>

              <div class="form-group">
                  <label for="name">Mot de passe</label>
                  <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="" value="{{ '' }}">
              </div>
              <div class="form-group">
                  <label for="name">Telephone</label>
                  <input type="text" class="form-control" id="telephone" name="telephone" placeholder="" value="{{ $user->telephone or '' }}">
              </div>

              <div class="form-group">
                  {!!Form::label('address', 'Adresse')!!}
                  {!!
                      Form::text('address', isset($user->candidate->address)? $user->candidate->address:'', [
                          'class' => 'form-control',
                          'id' => 'address'
                      ])
                  !!}
              </div>

              <div class="form-group">
                  {!!Form::label('postal_code', 'Code Postal')!!}
                  {!!
                      Form::text('postal_code', isset($user->candidate->postal_code) ?$user->candidate->postal_code:'', [
                          'class' => 'form-control',
                          'id' => 'postal_code'
                      ])
                  !!}
              </div>

              <div class="form-group">
                  {!!Form::label('location', 'Localité')!!}
                  {!!
                      Form::text('location', isset($user->candidate->location) ? $user->candidate->location:'', [
                          'class' => 'form-control',
                          'id' => 'location'
                      ])
                  !!}
              </div>

              <div class="form-group">
                  {!!Form::label('country', 'Pays')!!}
                  @include('rrhh::front.partials.countries', ['default' => isset($user->candidate->country) ? $user->candidate->country:null])
              </div>

              <div class="form-group">
                  {!!Form::label('birthday', 'Date de naissance')!!}
                  @if( isset($user) && $user->candidate->birthday != null)
                      @php
                          $date = explode('-',$user->candidate->birthday);
                          $date_formated = $date[2].'/'.$date[1].'/'.$date[0];
                      @endphp
                  @endif
                  {!!
                      Form::text('birthday', isset($user) && $user->candidate->birthday != null? $date_formated:'', [
                          'class' => 'form-control',
                          'id' => 'birthday'
                      ])
                  !!}
              </div>

              <div class="form-group">
                  {!!Form::label('birthplace', 'Ĺieu de naissance')!!}
                  {!!
                      Form::text('birthplace', isset($user->candidate->birthplace) ? $user->candidate->birthplace:'', [
                          'class' => 'form-control',
                          'id' => 'birthplace'
                      ])
                  !!}
              </div>

              <div class="form-group">
                  {!!Form::label('comment', 'Commentaire')!!}
                  {!!
                      Form::textarea('comment',  isset($user->candidate->comment) ? $user->candidate->comment:'', [
                          'class' => 'form-control',
                          'rows' => 3,
                          'id' => 'comment'
                      ])
                  !!}
              </div>

              <div class="form-group">
                  <label for="status">Etat</label>
                  <select name="status" id="status" class="form-control" >
                      <option value="{{App\Models\User::STATUS_ACTIVE}}" @if(isset($user)) @if($user->status == App\Models\User::STATUS_ACTIVE) selected @endif @endif>Actif</option>
                      <option value="{{App\Models\User::STATUS_INACTIVE}}" @if(isset($user)) @if($user->status == App\Models\User::STATUS_INACTIVE) selected @endif @endif>Désactivé</option>
                  </select>
              </div>

              @if(isset($user))
                  <div class="form-group">
                      <label for="registration_number" style="display: block;">Matricule</label>
                      @if($user->candidate->type == Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM)
                          <div class="row">
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{  $user->candidate->registration_number }}" >
                              </div>
                              <div class="col-sm-6">
                                  <p>Intérimaire depuis le {{ $user->candidate->registered_at }}</p>
                              </div>
                          </div>
                      @else
                          <div class="row">
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{  $user->candidate->registration_number or '' }}" >
                              </div>
                              <div class="col-sm-6">
                                  <input value="Convertir en intérimaire" type="button" class="btn btn-sm btn-primary pull-right convert_interimaire" />
                              </div>
                          </div>
                      @endif
                  </div>
              @else
                  <input type="hidden" name="registration_number" value="" >
              @endif
              <input type="hidden" name="type" id="type" value="{{ isset($user->candidate->type) && $user->candidate->type!=''?$user->candidate->type:Modules\RRHH\Entities\Offers\Candidate::TYPE_NORMAL}}" >

              <div class="form-group">
                  <label for="name">C.V.</label>

                  @if(isset($user) && $user->candidate->resume_file != '')
                      <?php $display_1 = 'display:none'; ?>
                      <small class="filename-small" id="filename-p_1">
                          <i class='fa fa-file'>
                              <a href="/storage/candidates/{{  $user->candidate->resume_file }}" target="_blank">{{ $user->candidate->resume_file }}</a>
                          </i>
                          <i class='fa fa-remove remove-file-click' onclick="deleteFile('1')"></i>
                      </small>
                  @else
                      <?php $display_1 = ''; ?>
                      <small class="filename-small" id="filename-p_1"></small>
                  @endif

                  <div class="medias-dropfiles medias-dropfiles_1 dz-div dz-div_1" style="{{ $display_1 }}">
                      <p align="center">
                          <strong>Déposez vos fichiers</strong> <br />
                          <small>ou cliquez-ici</small>
                      <p>
                  </div>
                  <div class="progress dz-div dz-div_1" style="{{ $display_1 }}">
                      <div class="progress-bar progress-bar_1" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      <span class="sr-only">70% Complete</span>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  <label for="name">Lettre de recommandation</label>

                  @if(isset($user) && $user->candidate->recommendation_letter != '')
                      <?php $display_2 = 'display:none'; ?>
                      <small class="filename-small" id="filename-p_2">
                          <i class='fa fa-file'>
                              <a href="/storage/candidates/{{  $user->candidate->recommendation_letter }}" target="_blank">{{ $user->candidate->recommendation_letter }}</a>
                          </i>
                          <i class='fa fa-remove remove-file-click' onclick="deleteFile('2')"></i>
                      </small>
                  @else
                      <?php $display_2 = ''; ?>
                      <small class="filename-small" id="filename-p_2"></small>

                  @endif

                  <div class="medias-dropfiles medias-dropfiles_2 dz-div dz-div_2" style="{{ $display_2 }}">
                      <p align="center">
                          <strong>Déposez vos fichiers</strong> <br />
                          <small>ou cliquez-ici</small>
                      <p>
                  </div>

                  <div class="progress dz-div dz-div_2" style="{{ $display_2 }}">
                    <div class="progress-bar progress-bar_2" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      <span class="sr-only">70% Complete</span>
                    </div>
                  </div>
                  <small id="filename-p_2"></small>
              </div>
              <input type="hidden" id="resume_file" name="resume_file" value="{{ $user->candidate->resume_file or '' }}" >
              <input type="hidden" id="recommendation_letter" name="recommendation_letter" value="{{ $user->candidate->recommendation_letter or '' }}" >
              <input type="hidden" name="old_status" id="old_status" value="{{ isset( $user) && $user->status == App\Models\User::STATUS_ACTIVE ? App\Models\User::STATUS_ACTIVE:App\Models\User::STATUS_INACTIVE}}" />
              <input type="hidden" name="role_id" id="role_id" value="{{App\Models\Role::where('name','candidate')->first()->id}}" />
          </div>

          <div class="sidebar">
          @if(isset($user))

          {!!
              Form::open([
                  'url' => route('rrhh.admin.candidates.updatetags', $user),
                  'method' => 'POST'
                  ])
          !!}
              <div class="card" style="margin-bottom:30px;">
                  <div class="card-body">
                      <h3 class="card-title">Tags</h3>
                      <textarea type="text" name="tags"  id="textarea" class="example" rows="1"></textarea>
                      <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                  </div>
              </div>

              <h3 class="card-title">Candidatures</h3>

              <table class="table" id="table-candidatures">
                 <thead>
                     <tr>
                         <th>Titre</th>
                         <th>Date de création</th>
                         <th>Etat</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th></th>
                         <th></th>
                         <th></th>
                     </tr>
                 </tfoot>
             </table>
          {{ Form::close()}}

          @endif
        </div>

        </div>

    {{ Form::close()}}



@endsection

@push('javascripts-libs')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>
@endpush


@push('javascripts')
    {{ Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js') }}

    <script>
        var inactive_value = '{{App\Models\User::STATUS_INACTIVE}}';
        var type_interim_value = '{{Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM}}';
        var csrf_token = "{{csrf_token()}}";
        var routes = '';
        var utags = [];
        var atags = [];

        $(document).on('click', ".btn-submit-primary", function(e){
            e.preventDefault();
            this.closest('form').submit()
        });
    </script>

    @if(isset($user))
        <script>
            var routes = {
                data : '{{ route("rrhh.admin.candidates.applications.data",  $user) }}',
            };
             @foreach ($userTags as $ut)
                utags.push('{{$ut}}');
            @endforeach
            @foreach ($allTAgs as $at)
                atags.push('{{$at}}');
            @endforeach
        </script>
    @endif

    {{ Html::script('/js/textext.core.js') }}
    {{ Html::script('/js/textext.plugin.autocomplete.js') }}
    {{ Html::script('/js/textext.plugin.tags.js') }}
    {{ Html::script('/js/admin/users/candidatesform.js') }}
@endpush
