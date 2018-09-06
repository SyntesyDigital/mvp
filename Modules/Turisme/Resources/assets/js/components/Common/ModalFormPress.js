import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from 'react-datepicker';
import moment from 'moment';

import 'react-datepicker/dist/react-datepicker.css';

import CountriesSelect from './CountriesSelect';

export default class ModalFormPress extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          fields : {
            media_type : '',
            media_name : '',
            media_distribution : '',
            media_country : '',
            media_web : '',
            media_email : '',
            media_comment : '',

            firstname : '',
            lastname : '',
            gender : '',
            country : '',
            occupation : '',
            email : '',
            web : '',
            language : '',
            dateStart : null,
            dateEnd : null,
            comment : '',

            privacity : false,
            newsletter : false,
          },
          saving : false,
          errors : {}
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

        return fields;
    }

    onFieldChange(event) {

      const {fields} = this.state;

      fields[event.target.name] = event.target.value;

      this.setState({
        fields : fields
      });

    }

    handleDateChange(name,date){
      console.log("handleDateChange => ",date,name);

      const {fields} = this.state;
      fields[name] = date;

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
          fields.programCheckboxes[event.target.name] = event.target.checked;
      }
      else {
        delete fields.programCheckboxes[event.target.name];
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
      axios.put(WEBROOT+'/contact/save-press', this.getFormData())
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

        const {fields} = this.state;

        fields['email'] = this.props.initEmail;

        this.setState({
          fields : fields
        });

        $("#modal-press").css({
            display:"block",
            zIndex:1000
        });

        $('body').css({overflow:'hidden'});

        TweenMax.to($("#modal-press"),1,{
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
        TweenMax.to($("#modal-press"),0.75,{opacity:0,ease: Power2.easeInOut,onComplete :function(){
              $("#modal-press").css({
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

    render() {

        const errors = Object.keys(this.state.errors).length > 0 ? true : false;
        const {programs,fields} = this.state;

        return (
            <div className="custom-modal" id="modal-press">
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
                        <h2>Formulario Prensa</h2>

                        <p>
                          Gracias por contactar con <b>Prensa</b> de Turisme de Barcelona
                        </p>
                        <p>
                          Por favor, rellena el siguiente formulario:
                        </p>

                        <div className="separator" style={{height:30}}></div>


                        <div className="col-xs-12">
                          <p>
                            DATOS DEL MEDIO
                          </p>
                        </div>

                        <div className="row">

                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <select className={this.hasErrors('media_type')} name="media_type" value={fields.media_type} onChange={this.onFieldChange}>
                                <option value="">Tipo de medio</option>
                                <option value="TV">TV</option>
                                <option value="Prensa">Prensa</option>
                                <option value="Prensa online">Prensa online</option>
                                <option value="Travel Blogger">Travel Blogger</option>
                                <option value="Travel Guide">Travel Guide</option>
                                <option value="Otros">Otros</option>
                              </select>
                            </div>
                          </div>

                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <input type="text" className={this.hasErrors('media_name')} name="media_name" value={fields.media_name} placeholder="Nombre del Medio" onChange={this.onFieldChange} />
                            </div>
                          </div>


                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <select className={this.hasErrors('media_distribution')} name="media_distribution" value={fields.media_distribution} onChange={this.onFieldChange}>
                                <option value="">Distribución</option>
                                <option value="ES">España</option>
                              </select>
                            </div>
                          </div>


                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">

                              <CountriesSelect
                                  className={this.hasErrors('media_country')} name="media_country" value={fields.media_country} onChange={this.onFieldChange}
                              />

                            </div>
                          </div>

                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <input type="text" className={this.hasErrors('media_web')} name="media_web" value={fields.media_web} placeholder="Web / Twitter del Medio" onChange={this.onFieldChange} />
                            </div>
                          </div>

                          <div className="col-xs-12 col-md-6">
                            <div className="form-group ">
                              <input type="text" className={this.hasErrors('media_email')} name="media_email" value={fields.media_email} placeholder="Email del medio" onChange={this.onFieldChange} />
                            </div>
                          </div>

                          <div className="row">
                            <div className="col-xs-12">
                              <p>
                              Temática o título del artículo:
                              </p>
                              <textarea className={"col-xs-12 "+this.hasErrors('media_comment')} name="media_comment" value={fields.media_comment} onChange={this.onFieldChange} />

                            </div>
                          </div>


                        </div>

                        <div className="separator" style={{height:30}}></div>


                        <div className="col-xs-12">
                          <p>
                            JOURNALIST DATA
                          </p>
                        </div>


                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
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
                            <select className={this.hasErrors('gender')} name="gender" value={fields.gender} onChange={this.onFieldChange}>
                              <option value="">Genero</option>
                              <option value="m">Masculino</option>
                              <option value="f">Femenino</option>
                            </select>
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
                            <input type="text" className={this.hasErrors('occupation')} name="occupation" placeholder="Cargo / posición" value={fields.occupation} onChange={this.onFieldChange} />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('email')} name="email" value={fields.email} placeholder="E-mail" onChange={this.onFieldChange}  />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('web')} name="web" value={fields.web} placeholder="Web / Twitter " onChange={this.onFieldChange} />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <select className={this.hasErrors('language')} name="language" value={fields.language} onChange={this.onFieldChange}>
                              <option value="">Preferencia idioma</option>
                              <option value="CA">Catalán</option>
                              <option value="ES">Castellano</option>
                              <option value="EN">Inglés</option>
                              <option value="FR">Francés</option>
                            </select>
                          </div>
                        </div>

                        <div className="separator" style={{height:30}}></div>

                        <div className="col-xs-12">
                          <p>
                            Fechas de estancia en Barcelona
                          </p>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <DatePicker
                                className={"input-date "+this.hasErrors('dateStart')}
                                selected={fields.dateStart ? fields.dateStart : moment()}
                                selectsStart
                                startDate={fields.dateStart}
                                endDate={fields.dateEnd}
                                onChange={this.handleDateChange.bind(this,'dateStart')}
                                locale="ca-es"

                            />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <DatePicker
                                className={"input-date "+this.hasErrors('dateEnd')}
                                selected={fields.dateEnd ? fields.dateEnd : moment()}
                                selectsEnd
                                startDate={fields.dateStart}
                                minDate={fields.dateStart}
                                endDate={fields.dateEnd}
                                onChange={this.handleDateChange.bind(this,'dateEnd')}
                                locale="ca-es"

                            />
                          </div>
                        </div>


                        <div className="separator" style={{height:30}}></div>

                        <div className="row">
                          <div className="col-xs-12">
                            <p>
                            Si deseas dejar un comentario:
                            </p>

                            <textarea className={"col-xs-12 "+this.hasErrors('comment')} name="comment" value={fields.comment} onChange={this.onFieldChange} />

                          </div>
                        </div>

                        <div className="separator" style={{height:30}}></div>

                        <div className="row checkbox">

                          <div className="col-xs-12">

                            <label className={"col-xs-12 "+this.hasErrors('privacity')}>
                              <input type="checkbox" className={this.hasErrors('privacity')} name="privacity" value={fields.comment} onChange={this.onCheckboxChange}  />
                              He leído y acepto la política de privacidad (RGPD).
                            </label>

                            {/*
                            <label className={"col-xs-12 "+this.hasErrors('newsletter')}>
                              <input type="checkbox" className={this.hasErrors('newsletter')} name="newsletter" value={fields.newsletter} onChange={this.onCheckboxChange}  />
                              Quiero recibir más información de Turisme de Barcelona (NewsleJer Profesional)
                            </label>
                            */}
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