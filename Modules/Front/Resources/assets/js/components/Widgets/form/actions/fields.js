import moment from 'moment';

import TextField from './../fields/TextField';
import RichtextField from './../fields/RichtextField';
import DateField from './../fields/DateField';
import NumberField from './../fields/NumberField';
import SelectField from './../fields/SelectField';
import ListField from './../fields/ListField';

const fieldComponents = {
    text: TextField,
    date: DateField,
    number: NumberField,
    select:SelectField,
    file:TextField,
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

  if(jsonResult[name] !== undefined){
    return jsonResult[name].length;
  }

  return 0;
};


/**
*   Iterate recursively to make the json result.
*/
export function setupJsonResult(paramArray,index,jsonResult,name,value,arrayPosition) {

  //console.log("setupJsonResult :: setup => ",paramArray,jsonResult,index,name,arrayPosition);

  if(jsonResult === undefined ){
    if(arrayPosition != null){
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
    else if(formParameters[defaultValue] !== undefined){
      //check parameters
      return formParameters[defaultValue];
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
  //console.log("processObject :: ", jsonResult,jsonRoot,arrayPosition);

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
    if(values[field.identifier] === undefined || values[field.identifier] == ''){
      return false;
    }
  }

  return true;
}
