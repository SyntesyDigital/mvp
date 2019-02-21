@if(isset($related_offers))
<div class="three-offers-container">
  <div class="horizontal-inner-container">
    <h2>CES OFFRES POURRAIENT VOUS INTÉRESSER</h2>

    @foreach($related_offers as $related_offer)

      <div class="col-md-4 ">
        <div class="offer-box">
            <div class="title">
              {{$related_offer->title}}
            </div>
            <p>Réf: {{$related_offer->id}} - Posté le {{$related_offer->start_at}}</p>
            @php
              $string = substr(strip_tags($related_offer->description), 0, 100);
              if(strlen($string) < strlen(strip_tags($related_offer->description))){
                $string = substr($string, 0, strrpos($string, ' ')) . " ...";
              }
            @endphp
            <div class="description">
            <p>{!! $string !!}</p>
            </div>
            @php
             $otags = $related_offer->tags()->get();
            @endphp
            <div class="buttons">
              @foreach($otags as $otag)
                <a href="#" class="btn btn-soft-gray tag">{{$otag->name}}</a>
              @endforeach
            </div>
            <a href="{{ route('offer.show', [
                                  'job_1' => str_slug(Modules\Extranet\Entities\Tools\SiteList::getListValue($related_offer->job_1, 'jobs1'), '-'),
                                  'id' => $related_offer->id
                              ]) }}" class="detail" >DÉTAIL DE L'OFFRE</a>
        </div>
      </div>
    @endforeach
    <br clear="all">
  </div>
</div>
@endif
