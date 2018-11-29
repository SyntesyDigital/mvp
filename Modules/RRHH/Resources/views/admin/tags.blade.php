@extends('architect::layouts.master')

@push('stylesheets')
	{!! Html::style('/css/bootstrap-tagsinput.css') !!}
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
		<?php $tags_string = '' ;
				$first = true;

		?>
		@foreach($tags as $tag)
			@if($first)
				<?php $tags_string .= $tag->name; 
					  $first = false;
				?>
			@else
				<?php $tags_string .= ','.$tag->name; ?>

			@endif
			
		@endforeach

        <div class="col-md-offset-2 col-md-8">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Tags</h3>
    				<!--h6 class="card-subtitle mb-2 text-muted">Edition de mon compte</h6-->

					<div class="form-group label-floating">
                        <input type="text" name="subject" value="{{$tags_string}}" data-role="tagsinput" class="form-control"/>
                    </div>


				</div>
			</div>
        </div>
		{!! Form::close() !!}
    </div>


</div>

<script>
    
</script>


@endsection


@push('javascripts')
    {{ Html::script('/js/bootstrap-tagsinput.min.js') }}
    <script type="text/javascript">
    	

    	
        var token = "{{ csrf_token() }}";

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });


		$( document ).ready(function() {
			$('input').on('beforeItemAdd', function(event) {
			   if (!event.options || !event.options.preventPost) {

					$.ajax( {
			            type: "POST",
			            url: "/admin/addtags",
			            data: {
			                "name" : event.item
			                },
			            success: function (data) {
			                if(data =='saved'){
			                    return true;
			                }else{
			                    return false;
			                }
			            },
			            error: function () {
			                return false;
			            }
			        });
			    }
			});

			$('input').on('beforeItemRemove', function(event) {
			   var tag = event.item;

			   if (!event.options || !event.options.preventPost) {
				     $.ajax( {
			            type: "POST",
			            url: "/admin/deltag",
			            data: {
			                "name" : event.item
			                },
			            success: function (data) {
			                if(data =='saved'){
			                    return true;
			                }else{
			                    return false;
			                }
			            },
			            error: function () {
			                return false;
			            }
		        	});
			    }
			}); 
		});
    </script>
@endpush