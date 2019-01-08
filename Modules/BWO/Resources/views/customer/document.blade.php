@php
	$title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('bwo::layouts.master',[
	'pageTitle' => $title,
	'htmlTitle' => 'Espace candidat'
])

@section('content')

	<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
		<div class="horizontal-inner-container">
			<h1>BONJOUR {{Auth::user()->firstname}}</h1>
		</div>
	</div>


	<div class="candidate-container">
		<div class="horizontal-inner-container">

			@include('bwo::customer.partials.menu')

			<div class="candidate-list">
				<ol class="breadcrumb">
					<li><a href="{{route('home')}}">ACCUEIL</a></li>
					<li><a href="{{route('customer.index')}}">ESPACE ENTREPRISE</a></li>
					<li>DOCUMENTS</li>
				</ol>

				@if($errors->any())
						<ul class="alert alert-danger">
								@foreach ($errors->all() as $error)
										<li >{{ $error }}</li>
								@endforeach
						</ul>
				@endif

				@if (session('success'))
						<div class="alert alert-success">
								{{ session('success') }}
						</div>
				@endif

				@if (session('error'))
						<div class="alert alert-danger">
								{{ session('error') }}
						</div>
				@endif

			<div class="candidate-page-content">

				<h2>Documents</h2>

				<div class="row">
					<div class="col-md-12">

						<div
							id="customer_documents"
							config="{{ base64_encode(json_encode([
									'type' => 'ajax',
									'route' => route('rrhh.admin.customers.documents.data',Auth::user()->customer->first())
								], true))}}"
						></div>

					</div>
				</div>


		</div> <!-- end files -->

		<br/>

		</div>
		</div>
	</div>
</div>

@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')
	<script src="{{ asset('modules/architect/plugins/toastr/toastr.min.js') }}"></script>
	<link href="{{ asset('modules/architect/plugins/toastr/toastr.min.css')}}" rel="stylesheet" media="all"  />
	{{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
	<script>

	</script>
@endpush
