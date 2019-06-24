<div id="{{$field['settings']['htmlId'] or ''}}" class="element-form-container row justify-content-center {{$field['settings']['htmlClass'] or ''}}">

  <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-form-container-head" @if($field['settings']['htmlClass']) data-toggle="collapse" data-target="#collapsetable" aria-expanded="true" aria-controls="collapsetable"@endif>
    {{$field['fields'][0]['value'][App::getLocale()]}}
  </div>

  <div id="elementForm" class="elementForm"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    collapsable="{{$field['settings']['collapsable']}}"
  >
  </div>

</div>


{{--
<div class="element-form-container container row justify-content-center">
  <form>
    <div class="col-md-offset-1 col-md-8">
      <div class="row element-form-row">
        <div class="col-sm-4">
          <label>Référence courtier</label>
        </div>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
        </div>
      </div>
      <div class="row element-form-row">
        <div class="col-sm-4">
          <label>Date de survenance <span>*</span></label>
        </div>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
        </div>
      </div>
      <div class="row element-form-row">
        <div class="col-sm-4">
          <label>Responsabilité <span>*</span></label>
        </div>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
        </div>
      </div>
      <div class="row element-form-row">
        <div class="col-sm-4">
          <label>Référence courtier</label>
        </div>
        <div class="col-xs-8">
          <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
        </div>
      </div>
      <div class="row element-form-row">
        <div class="col-sm-4">
          <label>Référence courtier</label>
        </div>
        <div class="col-sm-8">
          <textarea type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"></textarea>
        </div>
      </div>

      <div class="row element-form-row">
        <div class="col-md-4"></div>
        <div class="col-md-8 buttons">
            <button class="btn btn-primary right" type="submit"><i class="fa fa-paper-plane"></i>Valider</button>
            <a class="btn btn-back left"><i class="fa fa-angle-left"></i> Retour</a>
        </div>
      </div>
    </div>
  </form>
</div>
--}}
