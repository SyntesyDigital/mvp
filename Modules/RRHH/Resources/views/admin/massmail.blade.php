@extends('architect::layouts.master')

@push('stylesheets')
	{!! Html::style('/css/dropzone.min.css') !!}
@endpush

@section('content')
<div class="body">
    <div class="row">

		{!!
			Form::open([
				'url' => route('admin.sendmassmail'),
				'method' => 'POST',
            	'class' => 'toggle-sendmassmail'
			])
		!!}
		{{ csrf_field() }}

        <div class="col-md-offset-2 col-md-8">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Envoi d'email à la base</h3>
    				<!--h6 class="card-subtitle mb-2 text-muted">Edition de mon compte</h6-->
		            <div class="row">
		                <div class="col-md-6">
			                <div class="checkbox">
					            <label style="font-size: .8em">
					                <input type="checkbox" name="candidate" value="1">
					                Candidat ({{$count_normal}})
					            </label>
					        </div>
				       </div>
				       <div class="col-md-6">
			                <div class="checkbox">
					            <label style="font-size: .8em">
					                <input type="checkbox" name="interim" value="1">
					                Intérimaire ({{$count_interim}})
					            </label>
					        </div>
				       </div>
		            </div>

					<div class="form-group label-floating">
                        <label class="control-label">Sujet</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"/>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Répondre à</label>
                        <input type="text" name="reply_to" value="{{ old('reply_to')!=''?old('reply_to'):'noreply@menco.fr' }}" class="form-control"/>
                    </div>

		            <div class="form-group label-floating">
                        <label class="control-label">Message</label>
		                <textarea class="form-control" name="message">{{ old('message') }}</textarea>
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


@endsection
