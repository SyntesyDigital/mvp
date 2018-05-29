
<div class="custom-modal no-buttons" id="new-content-modal">
  <div class="modal-background"></div>


    <div class="modal-container">

      <div class="modal-header">
        <h2></h2>

        <div class="modal-buttons">
          <a class="btn btn-default close-button-modal close-btn" >
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>

      <div class="modal-content">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

              <h3 class="card-title">Nou contingut</h3>
              <h6>Selecciona de la llista el tipus de contingut que vols crear : </h6>


              <div class="grid-items">
                <div class="row">
                  @for($i=0;$i<8;$i++)

                  <div class="col-xs-3">
                    <a href="{{route('contents.show')}}">
                      <div class="grid-item">
                        <i class="fa fa-file"></i>
                        <p class="grid-item-name">
                          Page
                        </p>
                      </div>
                    </a>
                  </div>

                  @endfor
                </div>
              </div>

            </div>
          </div>
        </div>


        <div class="modal-footer">
          <a href="" class="btn btn-default close-btn" > Cancel·lar </a>
        </div>

      </div>
  </div>
</div>
