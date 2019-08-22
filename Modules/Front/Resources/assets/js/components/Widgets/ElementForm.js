import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';
import moment from 'moment';

import {
  getArrayPosition,
  setupJsonResult,
  processJsonRoot,
  getFieldComponent
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
            jsonResult : {},
            processing : false,
            complete : false
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

    handleOnChange(field) {

      console.log("ElementForm :: handleOnChange",field);

      const {values} = this.state;

      values[field.name] = field.value;

      this.setState({
        values : values
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
            onFieldChange={this.handleOnChange}
          />);

      }

      return fields;

    }

    handleSubmit(e) {
      e.preventDefault();

      //console.log("handleSubmit");


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

        const {procedures,currentProcedureIndex, values} = this.state;
        let {jsonResult} = this.state;
        const procedure = procedures[currentProcedureIndex];

        console.log("processProcedure :: ",currentProcedureIndex,procedure, jsonResult);
        var self = this;

        //process json root
        const {arrayPosition, jsonRoot} = processJsonRoot(procedure.JSONP, jsonResult);
        //console.log("processProcedure :: Array position => ",jsonRoot, arrayPosition);

        for(var j in procedure.OBJECTS) {
          var object = procedure.OBJECTS[j];

          //process the object modifing the jsonResult
          jsonResult = this.processObject(object,jsonResult,jsonRoot, arrayPosition,values);
        }

        //console.log("processProcedure :: Result => ",jsonResult);

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
              jsonResult : {},
              processing : false,
              complete : true
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
              jsonResult : {},
              processing : true,
              complete : false
            },function(){
                self.processProcedure();
            });

          });

        }
        else {
          //we have next procedure and is the same service, continue same json
          this.setState({
            currentProcedureIndex : currentProcedureIndex + 1 ,
            jsonResult : jsonResult,
            processing : true,
            complete : false
          },function(){
              self.processProcedure();
          });
        }
    }





    /**
    * Process the object and return the json modified
    */
    processObject(object,jsonResult,jsonRoot,arrayPosition,values) {
      //console.log("processObject :: ", jsonResult,jsonRoot,arrayPosition);

      var paramArray = jsonRoot.split('.');

      //conditionals to check what to do with this object
      const value = this.processObjectValue(object,values);

      jsonResult = setupJsonResult(
        paramArray,
        1,
        jsonResult,
        object.CHAMP,
        value,
        arrayPosition
      );

      //console.log("paramArray => ",paramArray);
      //console.log("setupJsonResult :: RESULT => ",jsonResult);

      return jsonResult;
    }

    /**
    *   Depending of the type of object and some values is necesary to process the value
    */
    processObjectValue(object,values) {

      const isRequired = object.OBL == "Y" ? true : false;
      const defaultValue = object.VALEUR;
      const type = object.NATURE;
      const isVisible = object.VIS;
      const isConfigurable = object.CONF == "Y" ? true : false;
      const isActive = object.ACTIF == "Y" ? true : false;


      if(type == "INPUT"){


        //FIXME this not should be necessary
        if(defaultValue == "_id_per_ass"){
          //this needs to be changed to SYSTEM
          return ID_PER_ASS;
        }
        else if(defaultValue == "_id_per_user"){
          return ID_PER_USER;
        }
        else {
            //get value
            if(values[object.CHAMP] === undefined){
              if(isRequired){
                console.error("Field is required : "+object.CHAMP);
              }
            }
            else {
              return values[object.CHAMP];
            }
        }

      }
      else if(type == "SYSTEM") {
        if(defaultValue == "_time"){
          //_time
          return moment().format("DD/MM/YYYY");
        }
        else if(defaultValue == "_id_per_ass"){
          return ID_PER_ASS;
        }
        else if(defaultValue == "_id_per_user"){
          return ID_PER_USER;
        }
      }
      else if(type == "CTE") {
        return defaultValue;
      }
    }



    /**
    * Process the procedure, with the service and the json
    * Returns info for next Step
    */
    submitProcedure(procedure, jsonResult, callback) {

      console.log("submitProcedure :: ",procedure, jsonResult);

      return jsonResult;

    }

    render() {
        return (
          <div className={"element-form-wrapper row "+(this.state.loading == true ? 'loading' : '')}>
            <form>
            {this.renderItems()}

            <div className="row element-form-row">
              <div className="col-md-4"></div>
              <div className="col-md-6 buttons">
                  <button className="btn btn-primary right" type="submit" onClick={this.handleSubmit.bind(this)}>
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
