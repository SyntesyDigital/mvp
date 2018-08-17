import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

const programs = {
  'gastronomia' : 'Gastronomía y vino',
  'deportes' : 'Deportes',
  'mar' : 'Mar',
  'cultura' : 'Cultura y ocio',
  'pirineo' : 'Pirineo - Montaña y nieve',
  'bodas' : 'Bodas',
  'compras' : 'Compras',
  'premium' : 'Premium',
  'reuniones' : 'Reuniones',
  'sostenibilidad' : 'Sostenibilidad'
}

class ModalForm extends Component {

    constructor(props)
    {
        super(props);

        var initProgram = 'mar';

        var programCheckboxes = {};
        if(initProgram != '' && programs[initProgram] !== undefined){
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
            accept : false,
            conditions : false,
            programs : programCheckboxes
          },
          initProgram : initProgram,
          savig : false,
          errors : {}
        }

        this.hideModal = this.hideModal.bind(this);
        this.onFieldChange = this.onFieldChange.bind(this);
        this.onCheckboxChange = this.onCheckboxChange.bind(this);
    }

    componentDidMount() {
      this.openModal();
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

    onProgramChange(event) {

      const {fields} = this.state;

      if(event.target.checked){
          fields.programs[event.target.name] = event.target.checked;
      }
      else {
        delete fields.programs[event.target.name];
      }


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
      axios.put(WEBROOT+'/contact/save', this.getFormData())
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
        if(response.content) {
            this.setState({
                contact : response.contact,
                saving : false
            });
            //toastr.success('Contingut guardar correctament');
        }
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
      $(".custom-modal").css({
          display:"block",
          zIndex:1000
      });

      $('body').css({overflow:'hidden'});

      TweenMax.to($(".custom-modal"),1,{
          delay : 0.25,
          opacity:1,
          ease: Power2.easeInOut
      });
    }

    hideModal() {
      TweenMax.to($(".custom-modal"),0.75,{opacity:0,ease: Power2.easeInOut,onComplete :function(){
            $(".custom-modal").css({
                opacity:0,
                display:'none',
                zIndex:0
            });
            $('body').css({overflow:'auto'});
        }});
    }

    hasErrors(name){
      if(this.state.errors[name] !== undefined){
        return 'error';
      }

      return '';
    }

    renderCheckboxes() {

      var result = [];

      const programValues = this.state.fields.programs;

      for(var key in programs){
        result.push(
          <label className="col-xs-12 col-md-6" key={key}>
            <input type="checkbox" name={key} value="" id="checkbox_1" onChange={this.onProgramChange.bind(this)} checked={programValues[key] !== undefined} />
              {programs[key]}
          </label>
        );
      }

      return result;

    }

    render() {

        const fields = this.state.fields;
        const errors = Object.keys(this.state.errors).length > 0 ? true : false;

        return (
            <div className="custom-modal">
              <div className="modal-background"></div>
              <div className="modal-container">
                <div className="modal-content">

                  <div className="modal-buttons">
                    <a className="close-button-modal" href="#">
                      x
                    </a>
                  </div>

                  <div className="row">
                    <div className="col-xs-10 col-xs-offset-1">
                      <form className="nova-cerca contact-form" onSubmit={this.handleSubmit.bind(this)}>
                        <h2>Formulario de Contacto</h2>

                        <p>
                          Gracias por contactar con el Programa Cultura y ocio de Turisme de Barcelona <br/>
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
                              <select className={this.hasErrors('country')} name="country" value={fields.country} onChange={this.onFieldChange}>
                                <option value="">Nacionalidad</option>
                              </select>
                            </div>
                          </div>

                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <input type="text" className={this.hasErrors('company')} name="company" placeholder="Empresa" value={fields.company} onChange={this.onFieldChange} />
                            </div>
                          </div>

                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <select className={this.hasErrors('company_type')} name="company_type" value={fields.company_type} onChange={this.onFieldChange}>
                                <option value="">Tipo de empresa</option>
                                <option value="ttoo">TTOO</option>
                                <option value="aavv">AAVV</option>
                                <option value="otros">Otros</option>
                              </select>
                            </div>
                          </div>

                        </div>

                        <div className="separator" style={{height:30}}></div>

                        {this.state.initProgram != '' && programs[this.state.initProgram] !== undefined &&
                          <p>
                            Sector de interés: {programs[this.state.initProgram]}
                          </p>
                        }
                        <p>
                        Selecciona si te interesa otro sector de lo que Turisme de Barcelona trabaja:
                        </p>

                        <div className="separator" style={{height:30}}></div>

                        <div className="row checkbox">

                            <div className="col-xs-12 col-md-offset-1 col-md-10">

                              {this.renderCheckboxes()}

                            </div>

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

                            <label className={"col-xs-12 "+this.hasErrors('privacity')}>
                              <input type="checkbox" className={this.hasErrors('newsletter')} name="newsletter" value={fields.newsletter} onChange={this.onCheckboxChange}  />
                              Quiero recibir más información de Turisme de Barcelona (NewsleJer Profesional)
                            </label>

                            <label className={"col-xs-12 "+this.hasErrors('privacity')}>
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

export default ModalForm;
