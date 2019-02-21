@php
	$title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('front::layouts.master',[
	'pageTitle' => $title,
	'htmlTitle' => 'Espace candidat'
])

@section('content')

  <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/front/images/offer-banner.jpg')}}')">
    <div class="horizontal-inner-container">
        <h1>BONJOUR {{Auth::user()->firstname}}</h1>
      </div>
    </div>
  </div>

  <div class="candidate-container">
		<div class="horizontal-inner-container">

			@include('front::candidate.partials.menu')

			<div class="candidate-list">
				<ol class="breadcrumb">
					<li><a href="{{route('home')}}">ACCUEIL</a></li>
					<li><a href="{{route('candidate.index')}}">ESPACE CANDIDAT</a></li>
					<li>CANDIDATURES</li>
				</ol>

        <div class="candidate-page-content">
  				<h2>Candidatures</h2>
  				<table class="table" id="table-applications">
             <thead>
                 <tr>
                    	<th>Titre</th>
                    	<th>Faite le</th>
                    	<th>Etat</th>
                     	<th></th>

                 </tr>
             </thead>
             <tfoot>
                 <tr>
                     	<th></th>
                    	<th></th>
                    	<th></th>
                    	<th></th>

                 </tr>
             </tfoot>
         </table>

  			</div>

      </div>

    </div>
  </div>


  <div class="three-colors-separator">
    <div class="separator-piece dark-gray"></div>
    <div class="separator-piece soft-gray"></div>
    <div class="separator-piece red"></div>
  </div>

  <div class="offers-3-container candidate-page">
      @include('front::partials.three-offers')
  </div>


@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/datatables.min.css') }}">
@endpush

@push('javascripts')
		<script src="{{ asset('modules/extranet/plugins/datatables/datatables.min.js') }}"></script>
    <script>
    var routes = $.extend(routes,{
        data : '{{ route("candidate.applications.data") }}',
    });

		$('#table-applications').DataTable({
        language: {
            "url": "/modules/extranet/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: routes.data,
        columns: [
            {data: 'title', name: 'title', width: "40"},
            {data: 'done_at', name: 'done_at', width: "40"},
            {data: 'status', name: 'status', width: "40"},
            {data: 'action', name: 'actions', orderable: false, searchable: false}
        ],
        initComplete: function () {

        }
   });

    </script>


@endpush
