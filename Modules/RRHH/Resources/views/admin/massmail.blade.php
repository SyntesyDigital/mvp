@extends('architect::layouts.master')

@section('content')

{!!
	Form::open([
		'url' => route('rrhh.admin.massmail.send'),
		'method' => 'POST',
    	'class' => 'toggle-sendmassmail'
	])
!!}
{{ csrf_field() }}


<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('rrhh.admin.offers.index')}}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> {{ Lang::get('rrhh::settings.massmail') }}
                </h1>

                <div class="float-buttons pull-right">
                    {!!
                        Form::submit(Lang::get('architect::fields.save'), [
                            'class' => 'btn btn-primary submit-form'
                        ])
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page">

	{{-- RIGHT COLUMN --}}
	<div class="col-md-9 page-content">
		<div class="form-group label-floating {{$errors->has("subject") ? 'has-error' : ''}}">
			{!! Form::label('Sujet') !!}
			{!!
				Form::text('subject', old('subject'), [
					'class' => 'form-control'
				])
			!!}
	    </div>

	    <div class="form-group label-floating {{$errors->has("reply_to") ? 'has-error' : ''}}">
			{!! Form::label('Répondre à') !!}
			{!!
				Form::text('reply_to', old('reply_to', env('MAIL_NO_REPLY')), [
					'class' => 'form-control'
				])
			!!}
	    </div>

	    <div class="form-group label-floating {{$errors->has("message") ? 'has-error' : ''}}">
			{!! Form::label('Message') !!}
			{!!
				Form::textarea('message', old('message'), [
					'class' => 'form-control',
					'rows' => 15
				])
			!!}
	    </div>
	</div>

	{{-- SIDEBAR --}}
	<div class="sidebar">
		<h3>Candidats destinataires du message</h3>

		@foreach([
			Modules\RRHH\Entities\Offers\Candidate::TYPE_NORMAL,
			Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM
		] as $name)
		{!!
			Form::checkbox('recipients[]', $name, old('recipients[' . $name . ']') ? true : false)
		!!}

		{{ $name }} ({{ Modules\RRHH\Entities\Offers\Candidate::countByType($name) }})

		@endforeach



		{{-- <div class="checkbox">
			<label style="font-size: .8em">
				<input type="checkbox" name="candidate" value="1">
				Candidat ({{}})
			</label>

			<div class="checkbox">
				<label style="font-size: .8em">
					<input type="checkbox" name="interim" value="1">
					Intérimaire
				</label>
			</div>
		</div> --}}
	</div>

</div>

{!! Form::close() !!}
@endsection


@push('javascripts')
<script>
    $('form.toggle-sendmassmail').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir envoyer cet message ?',
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result) {
                    $('form.toggle-sendmassmail')
                        .off('submit')
                        .trigger('submit');
                }
            }
        });
    });
</script>
@endpush
