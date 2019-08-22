
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
