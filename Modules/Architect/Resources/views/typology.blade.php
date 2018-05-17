@extends('architect::layouts.master')

@section('content')


  



  <div class="page-bar">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <a href="" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
          <h1>
            Nova tipologia
          </h1>

          <div class="float-buttons pull-right">
            <a href="" class="btn btn-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Guardar </a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="container rightbar-page">
    <div class="col-md-9 page-content">

      <div class="typology-field">
        <div class="field-type">
          <i class="fa fa-align-left"></i> &nbsp; Text Enriquit
        </div>

        <div class="field-inputs">
          <div class="row">
            <div class="field-name col-xs-6">
              <input type="text" class="form-control" name="name" placeholder="Nom">
            </div>
            <div class="field-id col-xs-6">
              <input type="text" class="form-control" name="field_id" placeholder="Idenfiticador">
            </div>
          </div>
        </div>

        <div class="field-actions">
          <a href=""> <i class="fa fa-en"></i> Configuració</a>
        </div>
      </div>

      <div class="typology-field">
        <div class="field-type">
          <i class="fa fa-map-marker"></i> &nbsp; Localització
        </div>

        <div class="field-inputs">
          <div class="row">
            <div class="field-name col-xs-6">
              <input type="text" class="form-control" name="name" placeholder="Nom">
            </div>
            <div class="field-id col-xs-6">
              <input type="text" class="form-control" name="field_id" placeholder="Idenfiticador">
            </div>
          </div>
        </div>

        <div class="field-actions">
          <a href=""> <i class="fa fa-en"></i> Configuració</a>
        </div>
      </div>


      @for($i=0;$i<10;$i++)
        <div class="typology-field">
          <div class="field-type">
            <i class="fa fa-font"></i> &nbsp; Text
          </div>

          <div class="field-inputs">
            <div class="row">
              <div class="field-name col-xs-6">
                <input type="text" class="form-control" name="name" placeholder="Nom">
              </div>
              <div class="field-id col-xs-6">
                <input type="text" class="form-control" name="field_id" placeholder="Idenfiticador">
              </div>
            </div>
          </div>

          <div class="field-actions">
            <a href=""> <i class="fa fa-en"></i> Configuració</a>
          </div>
        </div>
      @endfor


      <div class="fields-list-container">

        <div class="list-container-content">
          Arrosega camps en aquesta zona
        </div>
      </div>

    </div>

    <div class="sidebar">
      <div class="form-group bmd-form-group">
         <label for="name" class="bmd-label-floating">Nom</label>
         <input type="text" class="form-control" id="name">
      </div>

      <div class="form-group bmd-form-group">
         <label for="icon" class="bmd-label-floating">Icone</label>
         <select class="form-control" id="icon">
            <option name="" value=""> <i fa="fa fa-envelope"></i> Icon </option>
            <option name="" value=""> <i fa="fa fa-envelope"></i> Icon </option>
            <option name="" value=""> <i fa="fa fa-envelope"></i> Icon </option>
         </select>
      </div>

      <hr/>

      <div class="togglebutton">
        <label>
            Accessible via URL
            <input type="checkbox" >
        </label>
      </div>

      <div class="form-group bmd-form-group">
         <input type="text" class="form-control" id="slug-ca" placeholder="Slug - català">
      </div>
      <div class="form-group bmd-form-group">
         <input type="text" class="form-control" id="slug-es" placeholder="Slug - español">
      </div>
      <div class="form-group bmd-form-group">
         <input type="text" class="form-control" id="slug-en" placeholder="Slug - english">
      </div>


      <hr/>

      <div class="togglebutton">
        <label>
            Categories
            <input type="checkbox" >
        </label>
      </div>

      <div class="togglebutton">
        <label>
            Etiquetes
            <input type="checkbox" >
        </label>
      </div>

      <hr/>

      <h3>Afegeix camps</h3>

      <div class="field-list">
        <div class="field">
          <i class="fa fa-font"></i> &nbsp; Text
        </div>

        <div class="field">
          <i class="fa fa-align-left"></i> &nbsp; Text Enriquit
        </div>

        <div class="field">
          <i class="fa fa-picture-o"></i> &nbsp; Imatge
        </div>

        <div class="field">
          <i class="fa fa-calendar"></i> &nbsp; Data
        </div>

        <div class="field">
          <i class="fa fa-map-marker"></i> &nbsp; Localització
        </div>

        <div class="field">
          <i class="fa fa-th-large"></i> &nbsp; Imatges
        </div>

        <div class="field">
          <i class="fa fa-file-o"></i> &nbsp; Continguts
        </div>

        <div class="field">
          <i class="fa fa-th-list"></i> &nbsp; Llista
        </div>

        <div class="field">
          <i class="fa fa-link"></i> &nbsp; Enllaç
        </div>

        <div class="field">
          <i class="fa fa-video-camera"></i> &nbsp; Video
        </div>
      </div>

    </div>

  </div>



@stop
