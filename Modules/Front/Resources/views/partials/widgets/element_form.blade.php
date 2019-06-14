<!--h2>{{$content->title}}</h2-->

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
