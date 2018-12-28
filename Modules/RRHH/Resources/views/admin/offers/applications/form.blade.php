@extends('architect::layouts.master')

@section('content')
<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('rrhh.admin.applications.index')}}" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
                <h1><i class="fa fa-newspaper-o"></i>&nbsp;Candidatures de l'offre {{ $offer->title }} </h1>
                <!--div class="float-buttons pull-right">
                    <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
                </div-->
            </div>
        </div>
    </div>
</div>

<div class="container rightbar-page">
    <div class="page-content kanban">
        <div class="card-container">
            <h4 class="card-title">Nouvelle</h4>
            <div class="card">
                <div class="card-body div-dz-content">

                    <div class="dz dz-pending" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event, '{{ Modules\RRHH\Entities\Offers\Application::STATUS_PENDING }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', Modules\RRHH\Entities\Offers\Application::TYPE_OFFER )->where('status', Modules\RRHH\Entities\Offers\Application::STATUS_PENDING )->get() as $oa)
                             <div class ="candidate-drop-item draggable" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true'  ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('rrhh.admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-default showHideDnD"><i class="fa fa-eye"></i> Profile</a>
                                <a href="{{route('rrhh.admin.candidates.downloadcv', $oa->candidate)}}" class="btn btn-sm btn-default showHideDnD"><i class="fa fa-download"></i> CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-default pink showHideDnD"><i class="fa fa-sign-out"></i> Déplacer</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <h4 class="card-title">A recontacter</h4>
            <div class="card">
                <div class="card-body div-dz-content">
                    <div class="dz dz-to-contact"   @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event, '{{ Modules\RRHH\Entities\Offers\Application::STATUS_TO_CONTACT }}')" ondragover="app.offerapplications.dragover(event)"  @endif  >
                        @foreach ($offer->applications()->where('type', Modules\RRHH\Entities\Offers\Application::TYPE_OFFER )->where('status', Modules\RRHH\Entities\Offers\Application::STATUS_TO_CONTACT )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true'  ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('rrhh.admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-default showHideDnD"><i class="fa fa-eye"></i> Profile</a>
                                <a href="{{route('rrhh.admin.candidates.downloadcv', $oa->candidate)}}" class="btn btn-sm btn-default showHideDnD"><i class="fa fa-download"></i> CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})" class="btn btn-sm btn-default  pink showHideDnD"><i class="fa fa-sign-out"></i> Déplacer</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <h4 class="card-title">Refusé</h4>
            <div class="card">
                <div class="card-body div-dz-content">
                    <div class="dz dz-refused" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event, '{{ Modules\RRHH\Entities\Offers\Application::STATUS_REFUSED }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', Modules\RRHH\Entities\Offers\Application::TYPE_OFFER )->where('status', Modules\RRHH\Entities\Offers\Application::STATUS_REFUSED )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true'  ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('rrhh.admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-default  showHideDnD" style="display:none;"><i class="fa fa-eye"></i> Profile</a>
                                <a href="{{route('rrhh.admin.candidates.downloadcv', $oa->candidate)}}" class="btn btn-sm btn-default  showHideDnD" style="display:none;"><i class="fa fa-download"></i> CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-default  pink showHideDnD" style="display:none;"><i class="fa fa-sign-out"></i> Déplacer</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <h4 class="card-title">Entretien</h4>
            <div class="card">
                <div class="card-body div-dz-content">
                    <div class="dz dz-interview" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event,'{{ Modules\RRHH\Entities\Offers\Application::STATUS_INTERVIEW }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', Modules\RRHH\Entities\Offers\Application::TYPE_OFFER )->where('status', Modules\RRHH\Entities\Offers\Application::STATUS_INTERVIEW )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true' ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('rrhh.admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-default  showHideDnD" style="display:none;"><i class="fa fa-eye"></i> Profile</a>
                                <a href="{{route('rrhh.admin.candidates.downloadcv', $oa->candidate)}}" class="btn btn-sm btn-default showHideDnD" style="display:none;"><i class="fa fa-download"></i> CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-default  pink showHideDnD" style="display:none;"><i class="fa fa-sign-out"></i> Déplacer</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card-container">
            <h4 class="card-title">Accepter</h4>
            <div class="card">
                <div class="card-body div-dz-content">
                    <div class="dz dz-accepted" @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) ondrop="app.offerapplications.drop(event,'{{ Modules\RRHH\Entities\Offers\Application::STATUS_ACCEPTED }}')" ondragover="app.offerapplications.dragover(event)" @endif >
                        @foreach ($offer->applications()->where('type', Modules\RRHH\Entities\Offers\Application::TYPE_OFFER )->where('status', Modules\RRHH\Entities\Offers\Application::STATUS_ACCEPTED )->get() as $oa)
                             <div class ="candidate-drop-item draggable"  @if($offer->status == Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE) draggable='true' ondragstart='app.offerapplications.dragstart(event)' @endif id="{{ $oa->id }}">
                                <p>{{ $oa->candidate->user->lastname.' '.$oa->candidate->user->firstname }}<p>
                                <p>{{ $oa->candidate->user->telephone }}<p>
                                <p>{{ $oa->candidate->user->email }}<p>
                                <a href="{{route('rrhh.admin.candidates.show', $oa->candidate->user_id)}}" class="btn btn-sm btn-default  showHideDnD" style="display:none;"><i class="fa fa-eye"></i> Profile</a>
                                <a href="{{route('rrhh.admin.candidates.downloadcv', $oa->candidate)}}" class="btn btn-sm btn-default  howHideDnD" style="display:none;"><i class="fa fa-download"></i> CV</a>
                                <a href="" onclick="app.offerapplications.changeOffer(event,{{ $oa->id }})"  class="btn btn-sm btn-default  pink showHideDnD" style="display:none;"><i class="fa fa-sign-out"></i> Déplacer</a>
                            </div>
                        @endforeach
                    </div>
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
    {{ Html::script('/modules/rrhh/plugins/dropzone/dropzone.js') }}

    <script>
        var csrf_token = "{{csrf_token()}}",
        status_refused =  "{{Modules\RRHH\Entities\Offers\Application::STATUS_REFUSED}}",
        status_accepted =  "{{Modules\RRHH\Entities\Offers\Application::STATUS_ACCEPTED}}";
        status_interview =  "{{Modules\RRHH\Entities\Offers\Application::STATUS_INTERVIEW}}";
        route_update = "{{route('rrhh.admin.applications.update')}}";
        var other_offer_options  ='';
        @foreach ($other_offers as $oo)
            other_offer_options += '<option value="{{$oo->id}}">{{$oo->title}}</option>';
        @endforeach
       $( document ).ready(function() {
            app.offerapplications.init();
        });
    </script>
    {{ Html::script('/modules/rrhh/js/admin/offers/app.js') }}
    {{ Html::script('/modules/rrhh/js/admin/offers/offerapplications.js') }}
@endpush
