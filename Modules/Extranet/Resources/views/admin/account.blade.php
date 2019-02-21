@extends('architect::layouts.master')

@push('stylesheets')
	{!! Html::style('/css/dropzone.min.css') !!}
@endpush

@section('content')
<div class="body">
    <div class="row">
		{!!
			Form::open([
				'url' => route('admin.account.save'),
				'files'=>true,
				'method' => 'POST'
			])
		!!}
		{{ csrf_field() }}
		<div class="col-md-offset-1 col-md-3">
			<div class="card">
				<div class="card-body">
					@include('components.dropzone-image',[
						'image' => isset($user) && isset($user->image) ? $user->image : null,
						'size' => 'avatar',
						'id' => 'dropzone-1',
						'name' => 'image',
						'resizeWidth' => 500
					])
					<h4 class="info-title text-center">{{$user->full_name or ''}}</h4>
				</div>
			</div>
		</div>

        <div class="col-md-7">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Mon compte</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Edition de mon compte</h6>
		            <div class="row">
		                <div class="col-md-6">
		                    <div class="form-group label-floating">
		                        <label class="control-label">Prénom</label>
		                        <input type="text" name="firstname" value="{{ $user->firstname or '' }}" class="form-control">
		                    </div>
		                </div>

		                <div class="col-md-6">
		                    <div class="form-group label-floating">
		                        <label class="control-label">Nom</label>
		                        <input type="text" name="lastname" value="{{ $user->lastname or '' }}" class="form-control"/>
		                    </div>
		                </div>
		            </div>

					<div class="form-group label-floating">
		                <label class="control-label">E-mail</label>
		                <input type="text" name="email" value="{{ $user->email or '' }}" class="form-control"/>
		            </div>

		            <div class="form-group label-floating">
		                <label class="control-label">Mot de passe</label>
		                <input type="password" name="password" value="" class="form-control"/>
		            </div>

		            <div class="form-group label-floating">
		                <label class="control-label">Confirmation du mot passe</label>
		                <input type="password" name="confirm_password" value="" class="form-control"/>
		            </div>

		            <div class="form-group label-floating text-left">
						<input type="submit" value="Envoyer" class="btn btn-success submit-form"/>
		            </div>
				</div>
			</div>
        </div>
		{!! Form::close() !!}
    </div>
</div>

@endsection

@push('javascripts-libs')
	{!! Html::script('/js/dropzone.min.js') !!}
	{!! Html::script('/js/libs/jquery.imageUploader.js') !!}
@endpush
