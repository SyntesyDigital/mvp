import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

import ListSelectedSummary from './ListSelectedSummary';
import CountriesSelect from './CountriesSelect';

export default class ModalFormWithSelection extends Component {

  constructor(props)
  {
      super(props);

      var initProgram = props.initProgram != null && props.initProgram != '' ?
        props.initProgram : null;

      var programCheckboxes = {};
      if(initProgram != null && initProgram != ''){
        programCheckboxes[initProgram] = true;
      }

      this.state = {
        fields : {
          firstname : '',
          lastname : '',
          email : '',
          country : '',
          company : '',
          comment : '',
          privacity : false,
          newsletter : false,
          conditions : false,
          programCheckboxes : programCheckboxes,
          initProgram : initProgram,
        },
        programs : [],
        savig : false,
        errors : {},
      }

      this.isIn = false;

      this.hideModal = this.hideModal.bind(this);
      this.onFieldChange = this.onFieldChange.bind(this);
      this.onCheckboxChange = this.onCheckboxChange.bind(this);


  }

  componentDidMount() {
    //this.openModal();
  }

  componentWillReceiveProps(nextProps) {
    if(nextProps.display){
      this.openModal();
    }
    else {
      this.hideModal()
    }
  }

  getFormData()
  {

      const {fields} = this.state;

      fields['_token'] = this.props.csrf_token;
      fields['items'] = this.props.items;

      return fields;
  }

  onFieldChange(event) {

    const {fields} = this.state;

    fields[event.target.name] = event.target.value;

    this.setState({
      fields : fields
    });

  }

  onCheckboxChange(event) {

    const {fields} = this.state;

    fields[event.target.name] = event.target.checked;

    this.setState({
      fields : fields
    });

  }

  handleSubmit(event) {
    event.preventDefault();

    this.setState({
      saving : true,
      errors : {}
    });

    var _this = this;
    axios.put(WEBROOT+'/contact/save-with-selection', this.getFormData())
        .then((response) => {
            if(response.data.success) {
                _this.onSaveSuccess(response.data);
            }
        })
        .catch((error) => {
            if (error.response) {
                _this.onSaveError(error.response.data);
            } else if (error.message) {
                //toastr.error(error.message);
            } else {
                console.log('Error', error.message);
            }
            //console.log(error.config);
        });

  }

  onSaveSuccess(response)
  {
      this.setState({
          errors : {},
          saving : false
      });

      this.props.onSubmitSuccess();
  }


 onSaveError(response)
 {

    console.log("onSaveError => ",response);

     var errors = response.errors ? response.errors : null;
     var _this = this;
     var stateErrors = this.state.errors;

     if(errors) {
         var fields = errors ? errors : null;

         if(fields) {
             Object.keys(fields).map(function(identifier){
                    stateErrors[identifier] = true;
              });
         }
     }

     this.setState({
       saving : false,
       errors : stateErrors
     });


     if(response.message) {
         //toastr.error(response.message);
     }
  }

  openModal() {

    if(!this.isIn){
      this.isIn = true;

      //console.log("openModal!");
      $("#modal-form-selection").css({
          display:"block",
          zIndex:1000
      });

      $('body').css({overflow:'hidden'});

      TweenMax.to($("#modal-form-selection"),1,{
          delay : 0.25,
          opacity:1,
          ease: Power2.easeInOut
      });
    }
  }

  onModalClose(e) {
    e.preventDefault();

    this.props.onModalClose();
  }

  hideModal() {

    if(this.isIn){

      this.isIn = false;

      //console.log("close modal!");
      TweenMax.to($("#modal-form-selection"),0.75,{opacity:0,ease: Power2.easeInOut,onComplete :function(){
            $("#modal-form-selection").css({
                opacity:0,
                display:'none',
                zIndex:0
            });
            $('body').css({overflow:'auto'});

        }});
    }
  }

  hasErrors(name){
    if(this.state.errors[name] !== undefined){
      return 'error';
    }

    return '';
  }

  renderSelectedItems(){
    var result = [];

    const items = this.props.items;

    for(var key in items){

      result.push(
        <li key={key} className="col-xs-12">
          <ListSelectedSummary
            field={items[key]}
          />
        </li>
      );
    }

    return result;
  }

  render() {

      const errors = Object.keys(this.state.errors).length > 0 ? true : false;
      const {programs,fields} = this.state;
      const initProgram = fields.initProgram;
      //console.log("Programs : ",programs,initProgram);

      return (
          <div className="custom-modal" id="modal-form-selection">
            <div className="modal-background"></div>
            <div className="modal-container">
              <div className="modal-content">

                <div className="modal-buttons">
                  <a className="close-button-modal" href="#" onClick={this.onModalClose.bind(this)}>
                    x
                  </a>
                </div>

                <div className="row">
                  <div className="col-xs-10 col-xs-offset-1">
                    <form className="nova-cerca contact-form" onSubmit={this.handleSubmit.bind(this)}>
                      <h2>Formulario de Contacto</h2>

                      <p>
                        Gracias por contactar con el <b>departamento de Promoción</b> de Turisme de Barcelona
                      </p>

                      <p>
                        Por favor, rellena el siguiente formulario:
                      </p>

                      <div className="separator" style={{height:30}}></div>

                      <div className="row">

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            {/*<label htmlFor="title" >Nombre</label>*/}
                            <input type="text" className={this.hasErrors('firstname')} name="firstname" value={fields.firstname} placeholder="Nombre" onChange={this.onFieldChange} />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('lastname')} name="lastname" value={fields.lastname} placeholder="Apellidos" onChange={this.onFieldChange} />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('email')} name="email" value={fields.email} placeholder="E-mail" onChange={this.onFieldChange}  />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <CountriesSelect
                                className={this.hasErrors('country')} name="country" value={fields.country} onChange={this.onFieldChange}
                            />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('company')} name="company" placeholder="Empresa" value={fields.company} onChange={this.onFieldChange} />
                          </div>
                        </div>

                      </div>

                      <div className="separator" style={{height:30}}></div>


                      <p>
                      Petición: Resumen de MI SELECCIÓN
                      </p>

                      <div className="summary-list">
                        <ul>
                          {this.renderSelectedItems()}
                        </ul>
                      </div>

                      <div className="separator" style={{height:30}}></div>

                      <div className="row">
                        <div className="col-xs-12">
                          <p>
                          Si deseas dejar un comentario:
                          </p>

                          <textarea className="col-xs-12" name="comment" value={fields.comment} onChange={this.onFieldChange} />

                        </div>
                      </div>

                      <div className="separator" style={{height:30}}></div>

                      <div className="row checkbox">

                        <div className="col-xs-12">

                          <label className={"col-xs-12 "+this.hasErrors('privacity')}>
                            <input type="checkbox" className={this.hasErrors('privacity')} name="privacity" value={fields.comment} onChange={this.onCheckboxChange}  />
                            He leído y acepto la política de privacidad (RGPD).
                          </label>

                          <label className={"col-xs-12 "+this.hasErrors('newsletter')}>
                            <input type="checkbox" className={this.hasErrors('newsletter')} name="newsletter" value={fields.newsletter} onChange={this.onCheckboxChange}  />
                            Quiero recibir más información de Turisme de Barcelona (NewsleJer Profesional)
                          </label>

                          <label className={"col-xs-12 "+this.hasErrors('conditions')}>
                            <input type="checkbox" className={this.hasErrors('conditions')} name="conditions" value={fields.conditions} onChange={this.onCheckboxChange}  />
                            Aceptación de las <a href="">Condiciones de uso (PDF)</a>.
                          </label>

                        </div>

                      </div>

                      <div className="separator" style={{height:40}}></div>

                      {errors &&
                        <p className="error-message">
                          El envio no ha sido completado. Por favor comprueva los campos en rojo.
                        </p>
                      }


                      <input type="submit" value="Enviar" className="btn" />

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>

      );
  }
}