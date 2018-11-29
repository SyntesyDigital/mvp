@extends('architect::layouts.master')

@section('content')

<div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h3 class="card-title">Candidatures de l'offre {{ $offer->title }}  <i class="offer-closed" id="offer-closed" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) style="display:none" @endif>Offre fermée </i></h3>
        </div>
        <br clear="all">
        <br clear="all">

        <div class="col-md-3">
            <div class="card">
                <div class="card-body div-dz-content">
                    <h4 class="card-title">Nouvelle</h3>
                    <div class="dz dz-pending" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event, '{{ App\Models\Offers\Application::STATUS_PENDING }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', App\Models\Offers\Application::TYPE_OFFER )->where('status', App\Models\Offers\Application::STATUS_PENDING )->get() as $oa)
                             <div class ="candidate-drop-item draggable" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true'  ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-success showHideDnD">Voir profile</a>
                                <a href="{{route('admin.candidates.downloadcv', $oa->candidate)}}" class="showHideDnD">Télécharger CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-danger  showHideDnD">Déplacer sur une<br/>autre annonce</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body div-dz-content">
                    <h4 class="card-title">A recontacter</h3>
                    <div class="dz dz-to-contact"   @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event, '{{ App\Models\Offers\Application::STATUS_TO_CONTACT }}')" ondragover="app.offerapplications.dragover(event)"  @endif  >
                        @foreach ($offer->applications()->where('type', App\Models\Offers\Application::TYPE_OFFER )->where('status', App\Models\Offers\Application::STATUS_TO_CONTACT )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true'  ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-success showHideDnD">Voir profile</a>
                                <a href="{{route('admin.candidates.downloadcv', $oa->candidate)}}" class="showHideDnD">Télécharger CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})" class="btn btn-sm btn-danger  showHideDnD">Déplacer sur une<br/>autre annonce</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-body div-dz-content">
                    <h4 class="card-title">Refusé</h3>
                    <div class="dz dz-refused" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event, '{{ App\Models\Offers\Application::STATUS_REFUSED }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', App\Models\Offers\Application::TYPE_OFFER )->where('status', App\Models\Offers\Application::STATUS_REFUSED )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true'  ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-success showHideDnD" style="display:none;">Voir profile</a>
                                <a href="{{route('admin.candidates.downloadcv', $oa->candidate)}}" class="showHideDnD" style="display:none;">Télécharger CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-danger  showHideDnD" style="display:none;">Déplacer sur une<br/>autre annonce</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-body div-dz-content">
                    <h4 class="card-title">Entretien</h3>
                    <div class="dz dz-interview" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event,'{{ App\Models\Offers\Application::STATUS_INTERVIEW }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', App\Models\Offers\Application::TYPE_OFFER )->where('status', App\Models\Offers\Application::STATUS_INTERVIEW )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true' ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-success showHideDnD" style="display:none;">Voir profile</a>
                                <a href="{{route('admin.candidates.downloadcv', $oa->candidate)}}" class="showHideDnD" style="display:none;">Télécharger CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-danger  showHideDnD" style="display:none;">Déplacer sur une<br/>autre annonce</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-body div-dz-content">
                    <h4 class="card-title">Accepter</h3>
                    <div class="dz dz-accepted" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event,'{{ App\Models\Offers\Application::STATUS_ACCEPTED }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', App\Models\Offers\Application::TYPE_OFFER )->where('status', App\Models\Offers\Application::STATUS_ACCEPTED )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true' ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-success showHideDnD" style="display:none;">Voir profile</a>
                                <a href="{{route('admin.candidates.downloadcv', $oa->candidate)}}" class="showHideDnD" style="display:none;">Télécharger CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-danger  showHideDnD" style="display:none;">Déplacer sur une<br/>autre annonce</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection

@push('javascripts-libs')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>
@endpush

@push('javascripts')
    {{ Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js') }}

    <script>
        var csrf_token = "{{csrf_token()}}",
        status_refused =  "{{App\Models\Offers\Application::STATUS_REFUSED}}",
        status_accepted =  "{{App\Models\Offers\Application::STATUS_ACCEPTED}}";
        status_interview =  "{{App\Models\Offers\Application::STATUS_INTERVIEW}}";

        var other_offer_options  ='';
        @foreach ($other_offers as $oo)
            other_offer_options += '<option value="{{$oo->id}}">{{$oo->title}}</option>';
        @endforeach
       $( document ).ready(function() {
            app.offerapplications.init();
        });
    </script>
    {{ Html::script('/js/admin/offers/app.js') }}
    {{ Html::script('/js/admin/offers/offerapplications.js') }}
@endpush
