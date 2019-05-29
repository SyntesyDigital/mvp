@extends('front::layouts.app')

@section('content')
<!-- ARTICLE -->
<article>
 <!-- Col 12 -->
 <div class="white no-margin">
    <div class="container-fluid">
      <div class="row">

        <div id="carousel-full" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-full" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-full" data-slide-to="1"></li>
            <li data-target="#carousel-full" data-slide-to="2"></li>
          </ol>

          <div class="carousel-inner" role="listbox">
            <div class="item active"><img src="modules/front/images/img-big.png" alt="First slide image" class="center-block">
              <div class="carousel-caption">
                <h3>Més de 5 km de platges per a gaudir-ne</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut dapibus est.tetur adipiscing elit. Donec ut dapibus est. </p>
              </div>
            </div>
            <div class="item"><img src="modules/front/images/img-big.png" alt="Second slide image" class="center-block">
              <div class="carousel-caption">
                <h3>Second slide Heading</h3>
                <p>Second slide Caption</p>
              </div>
            </div>
            <div class="item"><img src="modules/front/images/img-big.png" alt="Third slide image" class="center-block">
              <div class="carousel-caption">
                <h3>Third slide Heading</h3>
                <p>Third slide Caption</p>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-full" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-full" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>

      </div>
	</div>
</div>
 <!-- end COl 12 -->
 <!-- Col 4 -->
  <div class="white">
    <div class="container">
      <div class="row">
        <ul>
          <li class="col-md-3 col-sm-6 col-xs-12">
            <div class="promo-text trade">
              <h3><a href="#">Travel trade</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ut dapibus est.</p>
            </div>
            </li>
          <li class="col-md-3  col-sm-6 col-xs-12">
            <div class="promo-text mediac">
              <h3><a href="#">Media Center</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ut dapibus est.</p>
            </div>
            </li>
          <li class="col-md-3  col-sm-6 col-xs-12">
            <div class="promo-text corpo">
              <h3><a href="#" class="corpo">Corporate</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ut dapibus est.</p>
            </div>
            </li>
          <li class="col-md-3 col-sm-6 col-xs-12">
            <div class="promo-text blog">
              <h3><a href="#" class="blog">Blog</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Donec ut dapibus est.</p>
            </div>
            </li>
          </ul>
      </div>
      </div>
  </div>
  <!-- end Col 4 -->
  <!-- Col 5 -->
  <div class="grey">
    <div class="container">
      <div class="row">
       <div clas="destacats">
        <div class="col-md-12 col-sm-12 col-xs-12">
      	  <ul>
          <li class="col-5">
            <div class="promo-image-text">
              <p class="image"><img src="modules/front/images/idees-per-a-reportatges.png" width="73" height="54" alt=""/></p>
              <p class="link"><a href="">Idees per a reportatges</a>
            </div>
            </li>
          <li class="col-5">
            <div class="promo-image-text">
              <p class="image"><img src="modules/front/images/estudis-i-estadistiques.png" width="73" height="54" alt=""/></p>
              <p class="link"><a href="">Estudis i estadístiques</a>
            </div>
          </li>
          <li class="col-5">
            <div class="promo-image-text">
              <p class="image"><img src="modules/front/images/imatges-videos-i-cartografia.png" width="73" height="54" alt=""/></p>
              <p class="link"><a href="">Imatges, vídeos i cartografia</a>
            </div>
          </li>
          <li class="col-5">
            <div class="promo-image-text">
              <p class="image"><img src="modules/front/images/publicacions-turistiques-i-apps.png" width="73" height="54" alt=""/></p>
              <p class="link"><a href="">Publicacions turístiques i apps</a>
            </div>
          </li>
          <li class="col-5">
            <div class="promo-image-text">
              <p class="image"><img src="modules/front/images/calendri-de-congresos.png" width="73" height="54" alt=""/></p>
              <p class="link"><a href="">Calendari de congressos</a>
            </div>
          </li>
        </ul>
		</div>
		  </div>
        </div>
    </div>
  </div>
  <!-- end Col 5 -->
  <!-- Col 2 -->
  <div class="white">
    <div class="container">
      <div class="row">
      	<div class="col-md-4 col-sm-6 col-xs-12">
      		<div class="widget slider promo trade">
      		 <h3>Per què Barcelona?</h3>
      			<div id="carousel2" class="carousel slide" data-ride="carousel">

				  <div class="carousel-inner" role="listbox">
					<div class="item active"><img src="modules/front/images/img-medium.png" alt="First slide image" class="center-block">
					  <div class="carousel-caption">

						  <p><a href="">1-Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a></p>
					  </div>
					</div>
					<div class="item"><img src="modules/front/images/img-medium.png" alt="Third slide image" class="center-block">
					  <div class="carousel-caption">
						<p><a href="">2-Donec ut dapibus est.tetur adipiscing elit. </a></p>
					  </div>
					</div>
					<div class="item"><img src="modules/front/images/img-medium.png" alt="Second slide image" class="center-block">
					  <div class="carousel-caption">
						<p><a href="">3-Lorem ipsum dolor sit amet, consectetur adipiscing elit.  </a></p>
					  </div>
					</div>
					<div class="item"><img src="modules/front/images/img-medium.png" alt="Third slide image" class="center-block">
					  <div class="carousel-caption">
						<p><a href="">4-Donec ut dapibus est.tetur adipiscing elit. </a></p>
					  </div>
					</div>
				  </div>
				  <a class="left carousel-control" href="#carousel2" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel2" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
          		</div>
			</div>
		</div>
      	<div class="col-md-8 col-sm-6 col-xs-12">
      		<div class="widget video"><iframe  src="https://www.youtube.com/embed/rCNVcFQLfm8?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	  </div>
	</div>
  </div>
  <!-- end Col 2 -->
  <!-- Col 3 -->
  <div class="white">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="widget corpo">
            <p class="image"><img src="modules/front/images/img-medium.png"  alt=""/></p>
            <h3><a href="#" class="corpo">Fes-te membre</a></h3>
            <p><strong>Lorem ipsum dolor sit amet, consectetur  adipiscing elit.</strong> Cras ornare ex at urna cursus feugiat. Phasellus tincidunt pharetra euismod. Maecenas libero mi, consectetur at semper at, sagittis sed nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Más información </p>
          </div>
        </div>
        <div class="col-md-4  col-sm-4 col-xs-12">
          <div class="widget blog list-items image">
            <h3><a href="#">Actualitat al Blog</a></h3>
            <ul>
              <li>
                <p class="image"><img src="modules/front/images/img-medium.png"  alt=""/></p>
                <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
                <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
               </li>
              <li>
                <p class="image"><img src="modules/front/images/img-medium.png"  alt=""/></p>
                <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
                <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
               </li>
              <li>
                <p class="image"><img src="modules/front/images/img-medium.png"  alt=""/></p>
                <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
                <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
               </li>
              <li>
                <p class="image"><img src="modules/front/images/img-medium.png"  alt=""/></p>
                <p class="text"><span class="data">30-11-2016</span> | <span class="categoria">Categoria </span></p>
                <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
               </li>
            </ul>
            <p class="button"> <a href="#">Veure tots</a></p>
          </div>
        </div>
        <div class="col-md-4  col-sm-4 col-xs-12">
          <div class="widget twitter"><a class="twitter-timeline" data-theme="light" data-chrome="nofooter noborders noheader noscrollbar" data-tweet-limit="1" href="https://twitter.com/BarcelonaTurism" height="370">Tweets by @BarcelonaTurism</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>



</a></div>
        </div>
      </div>
      </div>
  </div>
  <!-- end Col 3 -->
  <!-- Col 3 -->
  <div class="white">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="banner banner-text mediac estadistiques">
            <h3><a href="#">Estadístiques</a></h3>
            <p>Ut enim ad minim veniam, quis  <br>
              nostrud exercitation ullamco <br>
              minim veniam.</p>
            </div>
        </div>
        <div class="col-md-4  col-sm-4 col-xs-12">
          <div class="banner banner-text blog newsletter">
            <h3><a href="#">Subscriu-te al Newsletter</a></h3>
            <form action="#"><input type="email"><input type="submit" ></form>
            </div>
        </div>
        <div class="col-md-4  col-sm-4 col-xs-12">
          <div class="banner banner-image">
            <p class="image"><span class="promo-text mediac"><img src="modules/front/images/img-medium.png"  alt=""/></span></p>
            </div>
        </div>
      </div>
      </div>
  </div>
  <!-- end Col 3 -->
</article>
<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    $(function(){

    });
</script>
@endpush
