import moment from 'moment';

import TextField from './../fields/TextField';
import RichtextField from './../fields/RichtextField';
import DateField from './../fields/DateField';
import NumberField from './../fields/NumberField';
import SelectField from './../fields/SelectField';
import ListField from './../fields/ListField';
import FileField from './../fields/FileField';

import {
  HIDDEN_FIELD
} from './../constants';

const fieldComponents = {
    text: TextField,
    date: DateField,
    number: NumberField,
    select:SelectField,
    file:FileField,
    richtext:RichtextField,
    list:ListField
};

export function getFieldComponent(type) {

    return fieldComponents[type];
}

/**
*   Function to get current array position of the json.
*/
export function getArrayPosition(jsonResult,name) {

  name = name.slice(0,-2);

  console.log("getArrayPosition :: ",jsonResult,name);

  if(name == ""){
    //is root
    if(jsonResult instanceof Array){
      return jsonResult.length;
    }
    else if($.isEmptyObject(jsonResult)){
      //not yet set as array
      return 0;
    }
    else {
      console.error("getArrayPosition :: getting array position of non array");
    }


  }
  else {

    if(jsonResult[name] !== undefined){
      return jsonResult[name].length;
    }
  }

  return 0;
};


/**
*   Iterate recursively to make the json result.
*/
export function setupJsonResult(paramArray,index,jsonResult,name,value,arrayPosition) {

  console.log("setupJsonResult :: setup => ",paramArray,jsonResult,index,name,arrayPosition);

  if(jsonResult === undefined || $.isEmptyObject(jsonResult)){

    if(arrayPosition != null){
      console.log("setupJsonResult :: is array ");
      jsonResult = [{}];
    }
    else {
      jsonResult = {};
    }
  }

  if(paramArray.length > index && paramArray[index] != ''){
    //continue with the next step
    jsonResult[paramArray[index]] = setupJsonResult(
      paramArray,
      index+1,
      jsonResult[paramArray[index]],
      name,
      value,
      arrayPosition
    );
  }
  else {

    //FIXME remove this chage
    if(name == "Categ"){
      name = "categ";
    }

    if(arrayPosition != null){
      //is array
      if(jsonResult[arrayPosition] === undefined){
          jsonResult[arrayPosition] = {};
      }
      console.log("setupJsonResult :: put this var in this position ",arrayPosition,name);
      jsonResult[arrayPosition][name] = value;
    }
    else {
        jsonResult[name] = value;
    }
  }
  return jsonResult;
}

/**
*   Get json root and array position if necessary
*/
export function processJsonRoot(jsonRoot,jsonResult) {

  var paramArray = jsonRoot.split('.');
  var arrayPosition = null;
  var processedJsonRoot = "";
  var first = true;

  for(var key in paramArray){
    if(paramArray[key].indexOf('[]') != -1){
      //if is array
      arrayPosition = getArrayPosition(jsonResult,paramArray[key]);
      paramArray[key] = paramArray[key].slice(0,-2);
    }
    processedJsonRoot += (!first ? '.' : '')+paramArray[key];
    first = false;
  }

  return {
    arrayPosition : arrayPosition,
    jsonRoot : processedJsonRoot
  }
}

/**
*   Depending of the type of object and some values is necesary to process the value
*/
export function processObjectValue(object,values,formParameters) {

  const isRequired = object.OBL == "Y" ? true : false;
  const defaultValue = object.VALEUR;
  const type = object.NATURE;
  const isVisible = object.VIS;
  const isConfigurable = object.CONF == "Y" ? true : false;
  const isActive = object.ACTIF == "Y" ? true : false;

  console.log("processObjectValue :: ",object,values, formParameters);

  if(type == "INPUT"){

    //FIXME this not should be necessary
    if(defaultValue == "_id_per_ass"){
      //this needs to be changed to SYSTEM
      return ID_PER_ASS;
    }
    else if(defaultValue == "_id_per_user"){
      return ID_PER_USER;
    }
    else if(formParameters[defaultValue] !== undefined) {
      return formParameters[defaultValue];
    }
    else if(values[object.CHAMP] == HIDDEN_FIELD){
      //this field is hidden
      return  null;
    }
    else {
        //get value
        if(values[object.CHAMP] === undefined){
          if(isRequired){
            console.error("Field is required : "+object.CHAMP);
            //TODO dispatch error
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
    else if(defaultValue == "_timestamp"){
      //_time
      return moment().unix();
    }
    else if(defaultValue == "_id_per_user"){
      return ID_PER_USER;
    }
    else if(defaultValue == "_contentType"){
      return values['_contentType'] ? values['_contentType'] : '';
    }
    else if(formParameters[defaultValue] !== undefined){
      //check parameters

      //if is a date, and the date comes with timestamp convert to date
      var formValue = formParameters[defaultValue];
      if(object['FORMAT'] == "date" && formValue.indexOf('/') == -1){
        return moment.unix(formValue/1000).format("DD/MM/YYYY");
      }
      else {
        return formValue;
      }
    }
  }
  else if(type == "CTE") {
    return defaultValue;
  }
}

/**
* Process the object and return the json modified
*/
export function processObject(object,jsonResult,jsonRoot,arrayPosition,values, formParameters) {
  console.log("processObject :: ", jsonRoot,arrayPosition);

  var paramArray = jsonRoot.split('.');

  //conditionals to check what to do with this object
  const value = processObjectValue(object,values, formParameters);

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

export function validateField(field,values) {

  const isRequired = field.rules.required !== undefined ?
    field.rules.required : false;

  if(isRequired){

    //if is hidden, means during the form creation is defined as not needed
    if(values[field.identifier] !== undefined && values[field.identifier] == HIDDEN_FIELD){
      //is valid
      return true;
    }

    if(values[field.identifier] === undefined || values[field.identifier] == ''){
      return false;
    }
  }

  return true;
}

/**
*   Process the response of the POST to see if necessary to
*   to add a form parameter.
*/
export function processResponseParameters(response,service,formParameters) {

  if(service.REPONSE != ''){
    //there is parameters to process
    var parametersArray = service.REPONSE.split('&');

    for(var key in parametersArray){
      var parameter = parametersArray[key];

      var parameterArray = parameter.split('=');
      if(parameterArray.length > 1){
        // is a paramter , _id_sin=id, 0 : value, 1: response ocurrence
        var parameterIdentifier = parameterArray[0];
        var responseValue = parameterArray[1];

        formParameters[parameterIdentifier] = response[responseValue];
      }
    }
  }

  console.log("processResponseParameters :: form parameters => ",formParameters);

  return formParameters;
}

/**
*   Convert parameters string to array of key value
*/
export function parameteres2Array(paramString) {
  var result = {};

  if(paramString === undefined || paramString == '')
    return result;

  var paramsArray = paramString.split("&");
  for(var i=0;i<paramsArray.length;i++){
    var paramsSubArray = paramsArray[i].split("=");
    result[paramsSubArray[0]] = paramsSubArray[1];
  }

  return result;
}
