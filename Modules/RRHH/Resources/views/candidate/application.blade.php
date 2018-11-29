@php
  $title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('layouts.frontend',[   'pageTitle' => $title,
                'htmlTitle' => 'Menco Intérim | Espace candidat'
                 ])

@section('content')


<div class="candidate">
  <div class="bk-candidate-menu">
    <div class="horizontal-inner-container horizontal-inner-container-candidate-profile" >

      @include('candidate.partials.candmenu')

			<div class="candidate-page-content">
				<h2>Candidatures</h2>
				<table class="table" id="table-applications">
                   <thead>
                       <tr>
                          	<th>Titre</th>
                          	<th>Faite le</th>
                          	<th>Etat</th>
                           	<th>Action</th>

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


	<div class="offers-separator"></div>
	@include('candidate.partials.related')
</div>

@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/datatables.min.css') }}">

@endpush

@push('javascripts-libs')
    <script src="{{ asset('/plugins/datatables/datatables.min.js') }}"></script>
@endpush

@push('javascripts')
    <script>
    var csrf_token = "{{csrf_token()}}";
    var routes = {
        data : '{{ route("candidate.applications.data") }}',
    };
    </script>


@endpush
