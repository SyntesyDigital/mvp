	@if(count($related_offers)>0)
	<div class="horizontal-inner-container">
		<div class="offers-separator"></div>
	</div>
		

	<div class="horizontal-inner-container">
		<h4 class="related-offers-title">CES OFFRES POURRAIENT AUSSI VOUS INTÉRESSER</h4>
		<div class="offers">
			@foreach ($related_offers as $o)
				<div class="col-md-4 offer-container">
					<div class="offer-box" style="background-image:url('{{asset('images/offer-bk.jpg')}}')">
						<h4>{{ $o->title }}</h4>
						<p><i class="fa fa-map-marker"></i>{{ $o->address }}</p>
						<p><i class="fa fa-star"></i> {{ App\Models\Tools\SiteList::getListValue($o->job_1, 'jobs1') }}</p>
						<p><i class="fa fa-file-o"></i> {{ App\Models\Tools\SiteList::getListValue($o->contract, 'contracts') }}</p>
		                @if(!Auth::user()->hasRole(['admin', 'recruiter']))
		                  @if($o->hasAlreadyCandidate())
		                    <button id="{{$o->id}}"  class="btn unactivated">Déjà postulé</button>
		                  @else
		                    <button id="{{$o->id}}"  class="btn application-btn">POSTULER</button>
		                  @endif
		                @endif
						<a href="{{ route('offer.show', [
								'job_1' => str_slug(App\Models\Tools\SiteList::getListValue($o->job_1, 'jobs1'), '-'),
								'id' => $o->id
							]) }}"  class="btn btn-secondary">PLUS D'INFOS</a>
					</div>
				</div>			
			@endforeach
		</div>
	</div>
	@endif
	@push('javascripts')
	    <script>
	      var csrf_token = "{{csrf_token()}}";
	      var routes = {
	          data : '{{ route("candidate.applications.data") }}',
	      };
	    
	      var civility_default = "{{ App\Models\Offers\Candidate::CIVILITY_MALE }}"


	      $(document).ready(function() {
	         $(".application-btn").on('click',function(e){
	            app.offerapplications.init(
	                "{{ Auth::check() ? Auth::user()->id : 0 }}",
	                this.id,
	                "{{ Auth::check() && (Auth::user()->candidate) ? Auth::user()->candidate->resume_file : '' }}"
	              );
	            app.offerapplications.open();  

	          });
	        });
	    </script>
	    {{ Html::script('/js/candidateapplicationslist.js') }}
	    {{ Html::script('/js/admin/offers/app.js') }}
    {{ Html::script('/js/front/offers/offerapplications.js') }}
	@endpush
	@push('javascripts')
	  
	    </script>

	@endpush
	@push('modals')
	  @include('front.partials.modals')
	@endpush