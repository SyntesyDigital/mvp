import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

import ListSelectedSummary from './ListSelectedSummary';
import CountriesSelect from './CountriesSelect';
import moment from 'moment';

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

  processText(fields,fieldName){
    return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
      fields[fieldName].values[LOCALE] : '' ;
  }

  processLanguages(inputs) {
    var result="";
    for(var key in inputs){
      result += key+" ("+inputs[key]+") ";
    }
    return result;
  }

  processPublication(field){
    const fields = field.fields;
    const inputs = field.inputs !== undefined ? field.inputs : null;
    const title = this.processText(fields,'title');
    const languages = inputs != null ? this.processLanguages(inputs) : '';

    return title+" - "+languages;

  }

  processCartografia(field){
    const fields = field.fields;
    const inputs = field.inputs !== undefined ? field.inputs : null;
    const title = this.processText(fields,'title');

    const size = inputs != null ? ' - '+inputs.size : '';
    const format = inputs != null ? ' - '+inputs.format : '';
    const resolution = inputs != null ? ' - '+inputs.resolution : '';

    return title+size+format+resolution;

  }

  processEstadistica(field){
    const fields = field.fields;
    var data = fields.data.values != null ? fields.data.values : null;
    if(data != null){
      data = moment(data).format('L');
    }

    const title = this.processText(fields,'title');
    return title+" - "+data;
  }

  processLogo(field){
    const fields = field.fields;
    const title = this.processText(fields,'title');
    return title;
  }

  processItems(items){

    var itemsProcessed = [];

    for(var key in items){

      //console.log("ModalFormWithSelection :: processItem => ",items[key]);

      switch(items[key].typology.identifier){
        case 'publication' :
          itemsProcessed.push(this.processPublication(items[key]));
          break;
        case 'cartografia' :
          itemsProcessed.push(this.processCartografia(items[key]));
          break;
        case 'estadistica' :
          itemsProcessed.push(this.processEstadistica(items[key]));
          break;
       case 'logo' :
         itemsProcessed.push(this.processLogo(items[key]));
         break;
       }
    }

    //console.log("ModalFormWithSelection :: itemsProcessed => ",itemsProcessed);

    return itemsProcessed;

  }

  getFormData()
  {
      const {fields} = this.state;

      fields['_token'] = this.props.csrf_token;
      fields['items'] = this.props.items;
      fields['items_value'] = this.processItems(this.props.items);
      fields['typology'] = parseInt(this.props.typology);

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
                      <h2>{ window.localization['SELECTED_LIST_FORM_TITLE'] }</h2>

                      <p dangerouslySetInnerHTML={{__html: window.localization['SELECTED_LIST_FORM_SUBTITLE'] }}>

                      </p>

                      <p>
                      { window.localization['SELECTED_LIST_FORM_SUBTITLE2'] }
                      </p>

                      <div className="separator" style={{height:30}}></div>

                      <div className="row">

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            {/*<label htmlFor="title" >Nombre</label>*/}
                            <input type="text" className={this.hasErrors('firstname')} name="firstname" value={fields.firstname} placeholder={ window.localization['GENERAL_FORM_NAME'] }   onChange={this.onFieldChange} />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('lastname')} name="lastname" value={fields.lastname} placeholder={ window.localization['GENERAL_FORM_SURNAME'] } onChange={this.onFieldChange} />
                          </div>
                        </div>

                        <div className="col-xs-12 col-md-6">
                          <div className="form-group ">
                            <input type="text" className={this.hasErrors('email')} name="email" value={fields.email} placeholder={ window.localization['GENERAL_FORM_MAIL'] } onChange={this.onFieldChange}  />
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
                            <input type="text" className={this.hasErrors('company')} name="company" placeholder={ window.localization['GENERAL_FORM_ENTERPRISE'] } value={fields.company} onChange={this.onFieldChange} />
                          </div>
                        </div>

                      </div>

                      <div className="separator" style={{height:30}}></div>


                      <p>
                      { window.localization['SELECTED_LIST_FORM_SUBTITLE3'] }

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
                          { window.localization['SELECTED_LIST_FORM_SUBTITLE4'] }
                          </p>

                          <textarea className="col-xs-12" name="comment" value={fields.comment} onChange={this.onFieldChange} />

                        </div>
                      </div>

                      <div className="separator" style={{height:30}}></div>

                      <div className="row checkbox">

                        <div className="col-xs-12">

                          <label className={"col-xs-12 "+this.hasErrors('privacity')}>
                            <input type="checkbox" className={this.hasErrors('privacity')} name="privacity" value={fields.comment} onChange={this.onCheckboxChange}  />
                            {window.localization['GENERAL_FORM_CHECKBOX_RGPD']}
                          </label>

                          <label className={"col-xs-12 "+this.hasErrors('newsletter')}>
                            <input type="checkbox" className={this.hasErrors('newsletter')} name="newsletter" value={fields.newsletter} onChange={this.onCheckboxChange}  />
                            {window.localization['GENERAL_FORM_CHECKBOX_NEWS']}
                          </label>

                          <label className={"col-xs-12 "+this.hasErrors('conditions')}>
                            <input type="checkbox" className={this.hasErrors('conditions')} name="conditions" value={fields.conditions} onChange={this.onCheckboxChange}  />
                            <div dangerouslySetInnerHTML={{__html: window.localization['GENERAL_FORM_CHECKBOX_PDF'] }}></div>.
                          </label>

                        </div>

                      </div>

                      <div className="separator" style={{height:40}}></div>

                      {errors &&
                        <p className="error-message">
                            {window.localization['GENERAL_FORM_ERROR']}
                        </p>
                      }


                      <div className="centered form-button-wrapper">
                        <input type="submit" disabled={this.state.saving} value={window.localization['GENERAL_FORM_SEND']} className="btn" />
                      </div>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>

      );
  }
}
