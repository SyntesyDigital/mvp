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
						<p><i class="fa fa-star"></i> {{ Modules\RRHH\Entities\Tools\SiteList::getListValue($o->job_1, 'jobs1') }}</p>
						<p><i class="fa fa-file-o"></i> {{ Modules\RRHH\Entities\Tools\SiteList::getListValue($o->contract, 'contracts') }}</p>
		                @if(!Auth::user()->hasRole(['admin', 'recruiter']))
		                  @if($o->hasAlreadyCandidate())
		                    <button id="{{$o->id}}"  class="btn unactivated">Déjà postulé</button>
		                  @else
		                    <button id="{{$o->id}}"  class="btn application-btn">POSTULER</button>
		                  @endif
		                @endif
						<a href="{{ route('offer.show', [
								'job_1' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($o->job_1, 'jobs1'), '-'),
								'id' => $o->id
							]) }}"  class="btn btn-secondary">PLUS D'INFOS</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	@endif
