@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
		{!!
			Form::open([
				'url' => route('account.save'),
				'files'=>true,
				'method' => 'POST'
			])
		!!}
		{{ csrf_field() }}
		<div class="col-md-offset-1 col-md-3">
			<div class="card">
				<div class="card-body">

					@include('architect::components.dropzone-image',[
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
					<h3 class="card-title">Mi cuenta</h3>
    				{{-- <h6 class="card-subtitle mb-2 text-muted">Editar mi cuenta</h6> --}}
		            <div class="row">
		                <div class="col-md-6">
		                    <div class="form-group label-floating">
		                        <label class="control-label">Nombre</label>
		                        <input type="text" name="firstname" value="{{ $user->firstname or '' }}" class="form-control">
		                    </div>
		                </div>

		                <div class="col-md-6">
		                    <div class="form-group label-floating">
		                        <label class="control-label">Appellido</label>
		                        <input type="text" name="lastname" value="{{ $user->lastname or '' }}" class="form-control"/>
		                    </div>
		                </div>
		            </div>

					<div class="form-group label-floating">
		                <label class="control-label">E-mail</label>
		                <input type="text" name="email" value="{{ $user->email or '' }}" class="form-control"/>
		            </div>

		            <div class="form-group label-floating">
		                <label class="control-label">Contraseña</label>
		                <input type="password" name="password" value="" class="form-control"/>
		            </div>

		            <div class="form-group label-floating">
		                <label class="control-label">Confirmar la contraseña</label>
		                <input type="password" name="confirm_password" value="" class="form-control"/>
		            </div>

		            <div class="form-group label-floating text-left">
						<input type="submit" value="Enviar" class="btn btn-success submit-form"/>
		            </div>
				</div>
			</div>
        </div>
		{!! Form::close() !!}
    </div>
</div>
@endsection

@push('plugins')
	{!! Html::style('/modules/architect/plugins/dropzone/dropzone.min.css') !!}
    {!! Html::script('/modules/architect/plugins/dropzone/dropzone.min.js') !!}
@endpush

@push('javascripts-libs')

	{!! Html::script('/modules/architect/js/libs/jquery.imageUploader.js') !!}
@endpush
