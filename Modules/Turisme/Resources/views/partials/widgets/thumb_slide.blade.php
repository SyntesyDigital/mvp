<div  id="{{$field['settings']['htmlId'] or ''}}" class="widget slider promo trade {{$field['settings']['htmlClass'] or ''}}">
  <h3>Per què Barcelona?</h3>
  <div id="carousel2" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner" role="listbox">

      <div class="item active">
        @include('turisme::partials.fields.'.$field['fields'][0]['type'],
          [
            "field" => $field['fields'][0],
            "settings" => $field['settings'],
            "div" => false,
            "class" => 'center-block'
          ]
        )

  		  <div class="carousel-caption">
  			  <p>
            @include('turisme::partials.fields.'.$field['fields'][1]['type'],
              [
                "field" => $field['fields'][1],
                "settings" => $field['settings'],
                "div" => false
              ]
            )
          </p>
  		  </div>
  		</div>

      <div class="item">
        @include('turisme::partials.fields.'.$field['fields'][0]['type'],
          [
            "field" => $field['fields'][0],
            "settings" => $field['settings'],
            "div" => false,
            "class" => 'center-block'
          ]
        )

  		  <div class="carousel-caption">
  			  <p>
            @include('turisme::partials.fields.'.$field['fields'][1]['type'],
              [
                "field" => $field['fields'][1],
                "settings" => $field['settings'],
                "div" => false
              ]
            )
          </p>
  		  </div>
  		</div>

	  </div>


    <a class="left carousel-control" href="#carousel2" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel2" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>

  </div>
</div>
