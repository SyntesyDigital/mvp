@extends('architect::layouts.master')

@section('content')

<div class="container rightbar-page content">

  <div class="page-bar">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <a href="" class="btn btn-default btn-close"> <i class="fa fa-angle-left"></i> </a>
          <h1>
            <i class="fa fa-envelope"></i>
            Page Name
          </h1>

          <div class="float-buttons pull-right">

          <div class="actions-dropdown">
            <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
              Accions
              <b class="caret"></b>
              <div class="ripple-container"></div>
            </a>
              <ul class="dropdown-menu dropdown-menu-right default-padding">
                  <li class="dropdown-header"></li>
                  <li>
                      <a href="{{route('account')}}">
                          <i class="fa fa-plus-circle"></i>
                          &nbsp;Nou
                      </a>
                  </li>
                  <li>
                      <a href="{{route('account')}}">
                          <i class="fa fa-files-o"></i>
                          &nbsp;Duplicar
                      </a>
                  </li>
                  <li>
                      <a href="{{route('account')}}" class="text-danger">
                          <i class="fa fa-trash text-danger"></i>
                          &nbsp;
                          <span class="text-danger">Esborrar</span>
                      </a>
                  </li>
              </ul>
            </div>


            <a href="" class="btn btn-default" > <i class="fa fa-eye"></i> &nbsp; Previsualitzar </a>
            <a href="" class="btn btn-primary" onClick={this.props.onSubmitForm}> <i class="fa fa-cloud-upload"></i> &nbsp; Guardar </a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="sidebar">


    <div class="publish-form">
        <b>Estat</b> : <i class="fa fa-circle text-success"></i> Publicat <br/>

        <a class="btn btn-default"> Despublicar </a>

        <p class="field-help">Publicat el 14, Oct, 2018</p>
    </div>

    <!--
    <div class="publish-form sidebar-item">
        <b>Estat</b> : <i class="fa fa-circle text-warning"></i> Esborrany <br/>

        <a class="btn btn-success"> Publicar </a>

        <p class="field-help">Publicat el 14, Oct, 2018</p>
    </div>
    -->

    <hr/>

    <div class="form-group bmd-form-group sidebar-item">
       <label for="template" class="bmd-label-floating">Plantilla</label>
       <select class="form-control" id="template" name="template" value=""  onChange={this.handleChange}>
          <option name="" value="1"> Plantilla 1 </option>
          <option name="" value="2"> Plantilla 2 </option>
          <option name="" value="3"> Plantilla 3 </option>
       </select>
    </div>

    <hr/>

    <div class="form-group bmd-form-group">
       <label for="template" class="bmd-label-floating">Categoria</label>
       <select class="form-control" id="template" name="template" value=""  onChange={this.handleChange}>
          <option name="" value="1"> Categoria 1 </option>
          <option name="" value="2"> Categoria 2 </option>
          <option name="" value="3"> Categoria 3 </option>
       </select>
    </div>

    <hr/>

    <div class="form-group bmd-form-group sidebar-item">
       <label for="template" class="bmd-label-floating">Etiquetes</label>
       <input type="text" class="form-control" id="name" name="name" value="" onChange={this.handleChange} placeholder="Introduex etiquetes..." />
       <!--<a class="input-button"><i class="fa fa-plus"></i></a>-->

       <div class="tags">
         <span class="tag"> Tag 1 <a href="" class="remove-btn"> <i class="fa fa-times-circle"></i> </a> </span>
         <span class="tag"> Tag 2 <a href="" class="remove-btn"> <i class="fa fa-times-circle"></i> </a> </span>
         <span class="tag"> Tag 3 <a href="" class="remove-btn"> <i class="fa fa-times-circle"></i> </a> </span>
       </div>
    </div>

    <hr/>

    <div class="form-group bmd-form-group sidebar-item">
       <label class="bmd-label-floating">Traduccions</label>

      <div class="togglebutton">
        <label>
            Català
            <input type="checkbox" name="ca" checked="true" onChange="" />
        </label>
      </div>
      <div class="togglebutton">
        <label>
            Español
            <input type="checkbox" name="ca" checked="true" onChange="" />
        </label>
      </div>
      <div class="togglebutton">
        <label>
            English
            <input type="checkbox" name="ca" checked="true" onChange="" />
        </label>
      </div>

    </div>

    <hr/>

    <div class="form-group bmd-form-group sidebar-item">
       <label for="author" class="bmd-label-floating">Autor</label>
       <select class="form-control" id="author" name="author" value=""  onChange={this.handleChange}>
          <option name="" value="1"> Autor 1 </option>
          <option name="" value="2"> Autor 2 </option>
          <option name="" value="3"> Autor 3 </option>
       </select>

       <p class="field-help">Creat el 14, Oct, 2018</p>

    </div>


  </div>

  <div class="col-xs-9 page-content">

    <div class="field-group">

      <div class="field-item">

        <button id="headingOne" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <span class="field-type">
            <i class="fa fa-font"></i> Text
          </span>
          <span class="field-name">
            Title
          </span>
        </button>

        <div id="collapseOne" class="collapse in" aria-labelledby="headingOne">

          <div class="field-form">

            <div class="form-group bmd-form-group">
               <label htmlFor="name" class="bmd-label-floating">Title - ca</label>
               <input type="text" class="form-control" id="name" name="name" value="" onChange="" />
            </div>
            <div class="form-group bmd-form-group">
               <label htmlFor="name" class="bmd-label-floating">Title - ca</label>
               <input type="text" class="form-control" id="name" name="name" value="" onChange="" />
            </div>
            <div class="form-group bmd-form-group">
               <label htmlFor="name" class="bmd-label-floating">Title - ca</label>
               <input type="text" class="form-control" id="name" name="name" value="" onChange="" />
            </div>


          </div>

        </div>

      </div>


      <div class="field-item">

        <button id="headingOne" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <span class="field-type">
            <i class="fa fa-font"></i> Text
          </span>
          <span class="field-name">
            Title
          </span>
        </button>

        <div id="collapseTwo" class="collapse in" aria-labelledby="headingOne">

          <div class="field-form">

            <div class="form-group bmd-form-group">
               <label htmlFor="name" class="bmd-label-floating">Title - ca</label>
               <input type="text" class="form-control" id="name" name="name" value="" onChange="" />
            </div>
            <div class="form-group bmd-form-group">
               <label htmlFor="name" class="bmd-label-floating">Title - ca</label>
               <input type="text" class="form-control" id="name" name="name" value="" onChange="" />
            </div>
            <div class="form-group bmd-form-group">
               <label htmlFor="name" class="bmd-label-floating">Title - ca</label>
               <input type="text" class="form-control" id="name" name="name" value="" onChange="" />
            </div>


          </div>

        </div>

      </div>




    </div>


  </div>

</div>

@stop
