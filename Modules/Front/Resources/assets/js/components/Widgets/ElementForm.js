import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';
import moment from 'moment';

import {
  getArrayPosition,
  setupJsonResult,
  processJsonRoot,
  getFieldComponent,
  processObjectValue,
  processObject,
  validateField
} from './form/actions/';

export default class ElementForm extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;

        this.state = {
            field : field,
            elementObject : elementObject,
            values : this.initValues(elementObject),
            procedures : [],
            loading : true,

            currentProcedureIndex : 0,
            currentListIndex : 0,
            jsonResult : {},
            processing : false,
            complete : false,
            errors : {}
        };

        this.handleOnChange = this.handleOnChange.bind(this);

        this.loadProcedures();
    }

    initValues(elementObject) {
      //console.log("initValues => ",elementObject);

      var values = {};

      for(var key in elementObject.fields){
        var field = elementObject.fields[key];

        //TODO process different values depending of type ?
        values[field.identifier] = '';

      }

      return values;
    }

    getElementObjectField(identifier){
      const {fields} = this.state.elementObject;

      for(var key in fields) {
        if(fields[key].identifier == identifier){
          return fields[key];
        }
      }
      return null;
    }

    handleOnChange(field) {

      console.log("ElementForm :: handleOnChange",field);

      const {values} = this.state;

      values[field.name] = field.value;

      var self = this;

      this.setState({
        values : values
      },function(){
        self.validateFieldChange(
          self.getElementObjectField(field.name)
        )
      });
    }

    loadProcedures() {

      var self = this;

      axios.get('/architect/elements/procedures/'+this.state.elementObject.model_identifier)
        .then(function(response) {
          if(response.status == 200 && response.data.data !== undefined){
            self.setState({
              procedures : response.data.data,
              loading : false
            });
          }
        })
        .catch(function(error){
          console.error(error);
        });
    }

    renderItems() {

      if(this.state.elementObject.fields === undefined || this.state.elementObject.fields == null){
        return null;
      }

      var fields = [];

      for(var key in this.state.elementObject.fields) {
        var field = this.state.elementObject.fields[key];
        const FieldComponent = getFieldComponent(field.type);

        fields.push(<FieldComponent
            key={key}
            field={field}
            value={this.state.values[field.identifier]}
            error={this.state.errors[field.identifier] !== undefined ? true : false}
            onFieldChange={this.handleOnChange}
          />);

      }

      return fields;

    }

    handleSubmit(e) {
      e.preventDefault();

      //console.log("handleSubmit");

      const hasErrors = this.validateFields();

      if(hasErrors){
        toastr.error('Vous devez remplir tous les champs obligatoires.');
        console.log("handleSubmit :: Form has errors");
        return;
      }

      //start with the process
      if(this.state.procedures.length > 0){

        //start processing
        var self = this;

        this.setState({
          currentProcedureIndex : 0,
          jsonResult : {},
          processing : true,
          complete : false
        },function(){
          self.processProcedure();
        });

      }
      else {
        console.error("No procedures to process");
      }
    }

    /**
    * Process procedure with current step id
    */
    processProcedure() {

        const {procedures,currentProcedureIndex, values, currentListIndex} = this.state;
        let {jsonResult} = this.state;
        const procedure = procedures[currentProcedureIndex];

        const isRequired = procedure.OBL == "Y" ? true : false;
        const isConfigurable = procedure.CONF == "Y" ? true : false;
        const isRepetable = procedure.REP == "Y" ? true : false;

        console.log("processProcedure :: ",currentProcedureIndex,procedure, jsonResult);
        var self = this;

        if(!isRepetable){
          //normal procedure
          console.log("Process standard iteration => ",currentProcedureIndex, jsonResult);

          jsonResult = this.processStandardProcedure(currentProcedureIndex,procedure,jsonResult,values);

          //always pass to next procedure

          //if has values
              this.submitStandardProcedure(currentProcedureIndex,procedure,jsonResult);
          //else
              //if it is required
                //TODO error
              //else
                //TODO pass next procedure
        }
        else if(isConfigurable && isRepetable){
          //internal array, check for values list

          console.log("Process list iteration => ",currentProcedureIndex, currentListIndex, values[procedure.OBJID]);

          //check for value with id => procedure->OBJID
          if(values[procedure.OBJID] !== undefined && values[procedure.OBJID].length > 0){
            //there is values

            //check what is the current value index


            //process every values
            jsonResult = this.processListProcedure (
              currentProcedureIndex,
              procedure,
              values[procedure.OBJID][currentListIndex],
              jsonResult
            );

            //go to next value of this procedure of submit as standard procedure
            this.submitListProcedure(
              currentProcedureIndex,
              procedure,jsonResult,currentListIndex,
              values[procedure.OBJID]
            );

          }
          else {
            if(isRequired){
              //this is needed
              console.error("No list values and this procedure is required "+procedure.OBJID);
            }
            else {
              //TODO submit standard procedure
              this.submitStandardProcedure(currentProcedureIndex,procedure,jsonResult);
            }
          }

        }

        //after procedure is done we obtain a jsonResult, with this jsonResult decide what to Do.
    }


    processStandardProcedure(currentIndex,procedure,jsonResult,values) {

      console.log("processStandardProcedure :: ",currentIndex);

      //if conf == Y && repetable == N
        //if OBL == N , check for values, if not values, don't process de procedure
        //check for values
        //normal procedure
          //after procedure processed
            //check what to do
              //or next or finish

        const {arrayPosition, jsonRoot} = processJsonRoot(procedure.JSONP, jsonResult);

        for(var j in procedure.OBJECTS) {
          var object = procedure.OBJECTS[j];

          //process the object modifing the jsonResult
          jsonResult = processObject(object,jsonResult,jsonRoot, arrayPosition,values);
        }

        return jsonResult;

    }

    submitStandardProcedure(currentProcedureIndex,procedure,jsonResult) {

      const {procedures} = this.state;
      var self = this;

      var nextProcedure = null;
      if( currentProcedureIndex + 1 < procedures.length){
        //is the last one
        nextProcedure = procedures[currentProcedureIndex+1];
      }
      //console.log("nextProcedure => ",nextProcedure);

      //if next procedure is different -> submit
      if(nextProcedure == null) {
        //process this procedure

        this.submitProcedure(procedure,jsonResult, function(response){

          //finish!
          self.setState({
            currentProcedureIndex : 0,
            currentListIndex : 0,
            jsonResult : {},
            processing : false,
            complete : true
          });

          toastr.success('Contenu enregistré');

        },function(){
          //error
          self.setState({
            currentProcedureIndex : 0,
            currentListIndex : 0,
            jsonResult : {},
            processing : false,
            complete : false
          });
        });
      }
      else if(nextProcedure.SERVICE.ID != procedure.SERVICE.ID ){
        //the service is different, process the procedure

        this.submitProcedure(procedure,jsonResult,function(response){

          //TODO process response

          //continue next step
          self.setState({
            currentProcedureIndex : currentProcedureIndex + 1 ,
            currentListIndex : 0,
            jsonResult : {},
            processing : true,
            complete : false
          },function(){
              self.processProcedure();
          });

        },function(){
          //error restart to begining
          self.setState({
            currentProcedureIndex : 0,
            currentListIndex : 0,
            jsonResult : {},
            processing : false,
            complete : false
          });
        });

      }
      else {
        //we have next procedure and is the same service, continue same json
        this.setState({
          currentProcedureIndex : currentProcedureIndex + 1 ,
          currentListIndex : 0,
          jsonResult : jsonResult,
          processing : true,
          complete : false
        },function(){
            self.processProcedure();
        });
      }

    }

    submitListProcedure(currentProcedureIndex,procedure,jsonResult,currentListIndex, listValues) {



      const {procedures} = this.state;
      var self = this;

      //if we there is more values process next
      if(currentListIndex + 1 < listValues.length){
        //go to next procedure
        this.setState({
          currentListIndex : currentListIndex + 1,
          jsonResult : jsonResult,
          processing : true,
          complete : false
        },function(){
            self.processProcedure();
        });
      }
      else {
        //process this as standard procedure
        this.submitStandardProcedure(currentProcedureIndex,procedure,jsonResult);
      }
    }

    /**
    *   values = current list position with values of this item
    */
    processListProcedure (currentIndex,procedure,values,jsonResult) {

        console.log("processListProcedure :: ",currentIndex, values);

        const {arrayPosition, jsonRoot} = processJsonRoot(procedure.JSONP, jsonResult);

        for(var j in procedure.OBJECTS) {
          var object = procedure.OBJECTS[j];

          //process the object modifing the jsonResult
          jsonResult = processObject(object,jsonResult,jsonRoot, arrayPosition,values);
        }

        return jsonResult;

    }

    /**
    * Process the procedure, with the service and the json
    * Returns info for next Step
    */
    submitProcedure(procedure, jsonResult, successCallback, errorCallback) {

      console.log("submitProcedure :: ",procedure, jsonResult);

      if(procedure.SERVICE === undefined){
        console.error("procedure not defined => ",procedure);
      }

      var params = {
        method : procedure.SERVICE.METHODE,
        url : procedure.SERVICE.URL,
        data : jsonResult
      };

      axios.post('/architect/elements/form/process-service',params)
        .then(function(response) {
          console.log("response => ",response);
          if(response.status == 200 && response.data.result !== undefined){
              successCallback();
          }
          else {
              toastr.error(response.data.message);
              errorCallback();
          }
        })
        .catch(function(error){
          console.error("error => ",error.message);
          if(error.response.data.message !== undefined){
            toastr.error(error.response.data.message);
          }
          else {
            toastr.error(error.message);
          }
          errorCallback();
        });

      return jsonResult;

    }

    /**
    *   When field change
    */
    validateFieldChange(field) {
      const {errors,values} = this.state;

      var valid = validateField(field,values);

      if(!valid){
        errors[field.identifier] = true;
      }
      else {
        delete errors[field.identifier];
      }

      this.setState({
        errors : errors
      });
    }

    /**
    *   When submit is preseed
    */
    validateFields() {
        if(this.state.elementObject.fields === undefined || this.state.elementObject.fields == null){
          return {};
        }

        var fields = [];
        var errors = {};
        var hasErrors = false;

        for(var key in this.state.elementObject.fields) {
          var field = this.state.elementObject.fields[key];

            var valid = validateField(field,this.state.values);
            if(!valid)
              errors[field.identifier] = !valid;

            if(!hasErrors && !valid){
              hasErrors = true;
            }
        }

        this.setState({
          errors : errors
        });

        return hasErrors;
    }

    render() {
        return (
          <div className={"element-form-wrapper row "+(this.state.loading == true ? 'loading' : '')}>
            <form>
            {this.renderItems()}

            <div className="row element-form-row">
              <div className="col-md-4"></div>
              <div className="col-md-6 buttons">
                  <button
                    className="btn btn-primary right" type="submit"
                    onClick={this.handleSubmit.bind(this)}
                    disabled={this.state.processing}
                  >
                    <i className="fa fa-paper-plane"></i>Valider
                  </button>
                  {/*
                  <a className="btn btn-back left"><i className="fa fa-angle-left"></i> Retour</a>
                  */}
              </div>
            </div>

            </form>
          </div>
        );
    }
}

if (document.getElementById('elementForm')) {

   document.querySelectorAll('[id=elementForm]').forEach(function(element){
       var field = element.getAttribute('field');
       var elementObject = element.getAttribute('elementObject');

       ReactDOM.render(<ElementForm
           field={field}
           elementObject={elementObject}
         />, element);
   });
}
