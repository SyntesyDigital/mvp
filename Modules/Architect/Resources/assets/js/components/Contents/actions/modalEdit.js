import {
  EDIT_ITEM_CANCEL,
  EDIT_ITEM_SELECT,
  UPDATE_EDIT_ITEM,
  INIT_EDIT_ITEM_MODAL,
  EDIT_ITEM_UPDATE_CATEGORIES,
  EDIT_ITEM_UPDATE_ELEMENS,
  LOAD_PARAMETERS,
  UPDATE_PARAMETERS

} from "../constants/";

import axios from 'axios';

export function initEditItem(payload) {
  return { type: INIT_EDIT_ITEM_MODAL, payload : payload };
}

function pushCategories(categoriesFrom, level, categoriesTo){

   level++;
   for (var i = 0; i< categoriesFrom.length; i++ ){
        categoriesTo.push({
          value: categoriesFrom[i].id,
          name: this.printSpace(level)+categoriesFrom[i].name,
        });
       if(categoriesFrom[i].descendants.length > 0){
          pushCategories(categoriesFrom[i].descendants,level, categoriesTo);
       }
   }
}

export function loadCategories() {

  return (dispatch) => {
    axios.get(ASSETS+'api/categories/tree?accept_lang=es')
      .then(function (response) {
          if(response.status == 200
              && response.data.data !== undefined
              && response.data.data[0].descendants.length > 0)
          {

            ////console.log("original categories => ",response.data.data);

            var categories = [{
              value:'',
              name:'----'
            }];

            pushCategories(response.data.data, 0,categories);

            dispatch({
              type : EDIT_ITEM_UPDATE_CATEGORIES,
              payload : {
                originalCategories : response.data.data,
                categories : categories
              }
            })

          }

      }).catch(function (error) {
         //console.log(error);
       });
    }
}

function pushElements(elementsFrom, fileElementsTo, formElementsTo, tableElementsTo){
    for (var i = 0; i< elementsFrom.length; i++ ){

       if(elementsFrom[i].type == 'file'){
         fileElementsTo.push(processElement(elementsFrom[i]));
       }
       if(elementsFrom[i].type == 'form'){
         formElementsTo.push(processElement(elementsFrom[i]));
       }
       if(elementsFrom[i].type == 'table'){
         tableElementsTo.push(processElement(elementsFrom[i]));
       }
    }
 }

 function processElement(element) {
    var result = {
      value: element.id,
      name : element.name,
      parameters : []
    };

    if(element.attrs !== undefined){
      for(var key in element.attrs){
        var attribute = element.attrs[key];
        if(attribute.name == "parameter"){
          result.parameters.push(attribute.value);
        }
      }
    }

    return result;
 }

export function loadElements() {

  return (dispatch) => {

    axios.get(ASSETS+'api/elements')
      .then(function (response) {
          if(response.status == 200
              && response.data !== undefined
              && response.data.length > 0)
          {

            ////console.log("original elements => ",response.data);
            var fileElements = [{
              value:'',
              name:'----'
            }];

            var tableElements = [{
              value:'',
              name:'----'
            }];

            var formElements = [{
              value:'',
              name:'----'
            }];

            pushElements(response.data, fileElements,formElements, tableElements);

            dispatch({
              type : EDIT_ITEM_UPDATE_ELEMENS,
              payload : {
                originalElements : response.data,
                fileElements  : fileElements,
                tableElements : tableElements,
                formElements  : formElements
              }
            });

          }

      }).catch(function (error) {
         //console.log(error);
       });
    }
}

export function loadParameters() {

  return (dispatch) => {

    axios.get(ASSETS+'api/parameters')
      .then(function (response) {
          if(response.status == 200
              && response.data !== undefined
              && response.data.length > 0)
          {

            //console.log("loadParameters :: loadParameters",response.data);
            var parameters = {};
            for(var i=0;i<response.data.length;i++){
              //console.log("loadParameters :: key => ",i);
              var item = response.data[i];
              parameters[item.id] = item;
            }

            dispatch({
              type : LOAD_PARAMETERS,
              payload : parameters
            });

          }

      }).catch(function (error) {
         //console.log(error);
       });
    }
}

export function editItem(item) {

  return { type: EDIT_ITEM_SELECT, payload : item };
};

export function cancelEditItem() {

  return { type: EDIT_ITEM_CANCEL };
};

function parameterExist(id,pageParameters) {
  for(var i=0;i<pageParameters.length;i++){
    if(pageParameters[i].id == id){
      return true;
    }
  }
  return false;
}

/**
* Get the first default value with the same identifier from
* the array of elements.
*/
function getElementParameterOption(identifier,elements){
  for(var i=0;i<elements.length;i++){
    var element = elements[i];

    if(element.model_exemple !== undefined &&
      element.model_exemple != ''){
        var defaultArray=element.model_exemple.split('?');
        if(defaultArray.length == 2){
          var defaultParams = defaultArray[1].split('&');

          for(var j=0;j<defaultParams.length;j++){
            var defaultValue = defaultParams[j];
            var values = defaultValue.split('=');
            if(values[0] == identifier){
              return values[1];
            }
          }
        }
    }
  }

  return '';
}

export function updateParameters(layout, elements, pageParameters, parametersList) {

  //search for all hierarchy all widgets that has parameters
  //console.log("updateParameters :: ",layout, elements);

  var parameters = getParametersFromLayout(layout,[], elements);
  //console.log("getParametersFromLayout : pageParams : => ", pageParameters, parameters);
  var filterParameters = getFilterParametersFromLayout(layout,{});
  console.log("updateParameters :: filter parameters ",filterParameters);

  //add filter parameters into parameters array
  parameters = concatFilterParameters(parameters,filterParameters);
  console.log("updateParameters :: parameters after concat ",parameters);

  //console.log("getParametersFromLayout : init page parameters => ",pageParameters);
  //check existing parameters
  for(var j=pageParameters.length-1;j>=0;j--){
    //if not exist in array
    //console.log("getParametersFromLayout :: indexOf => ", parameters.indexOf(pageParameters[j].id.toString()));
    if(parameters.indexOf(pageParameters[j].id.toString()) == -1){
      //console.log("getParametersFromLayout :: delete => ", j);
      //remove it
      pageParameters.splice(j,1);
    }
  }
  //console.log("getParametersFromLayout : after clean => ",pageParameters);

  //add new parameters
  for(var i =0;i<parameters.length;i++){
    var id = parameters[i];
    //check if not already pushed to page
    if(!parameterExist(id, pageParameters)){
        //console.log("dont exist :: id => ", id,parametersList[id].identifier);

        //if parameters is a filter
        if(filterParameters[id] !== undefined){
          pageParameters.push({
              id : parseInt(id),
              default : filterParameters[id],
              identifier : parametersList[id].identifier,
              name : parametersList[id].name,
          });
        }
        else {
          pageParameters.push({
              id : parseInt(id),
              default : getElementParameterOption(parametersList[id].identifier, elements),
              identifier : parametersList[id].identifier,
              name : parametersList[id].name,
          });
        }
    }
  }

  console.log("getParametersFromLayout : after adding => ",pageParameters);

  return { type: UPDATE_PARAMETERS,payload : pageParameters };
}

/**
*    Filter parametres are an object. Need to convert parameters to array
*    and concat with parameters to allow the same process for filters.
*/
function concatFilterParameters(parameters,filterParameters) {

  for(var parameterId in filterParameters){
    if(parameters.indexOf(parameterId) == -1){
      //if don't exist to parameters
      parameters.push(parameterId);
    }
  }

  return parameters;
}

function getParametersFromLayout(layout,params, elements) {

  for(var i=0;i<layout.length;i++){
    var item = layout[i];
    //console.log("item => ",item);
    if(item.type == "item"){
      //process item, return params

      var widgetParams = getWidgetParams(item.field, elements);
      //console.log("item, widgetParams => ",item,widgetParams);
      params = Array.from(new Set(params.concat(widgetParams)));
      //console.log("item, params => ",params);
    }
    else if(item.children != null && item.children !== undefined &&
      item.children.length > 0){
      var childrenParams = getParametersFromLayout(item.children,params, elements);
      //merge with params
      params = Array.from(new Set(params.concat(childrenParams)));
      //console.log("row/col, params => ",params);
    }
  }

  return params;
}

/**
*   Function that iterate all widgets, and see if widget has a filter.
*   If has a filter add to array like this :
      params = {
        "param id" : "default value",
        "param id" : "default value"
      }
*/
function getFilterParametersFromLayout(layout,params) {

  for(var i=0;i<layout.length;i++){
    var item = layout[i];
    //console.log("item => ",item);
    if(item.type == "item"){
      //process item, return params

      var widgetParams = getWidgetFilterParam(item.field);
      if(widgetParams != null){
        params[widgetParams.id] = widgetParams.value;
      }
      //console.log("item, widgetParams => ",item,widgetParams);

    }
    else if(item.children != null && item.children !== undefined &&
      item.children.length > 0){
        params = getFilterParametersFromLayout(item.children,params);
      }
  }

  return params;
}

function getWidgetParams(field, elements) {

  if(field == null || field.settings === undefined){
    return [];
  }

  var value = null;

  if(field.settings['fileElements'] !== undefined){
    value = field.settings['fileElements'];
  }
  else if(field.settings['tableElements'] !== undefined){
    value = field.settings['tableElements'];
  }
  else if(field.settings['formElements'] !== undefined){
    value = field.settings['formElements'];
  }
  else {
    return [];
  }

  //console.log("Elements => ",value, elements);

  for(var i=0;i<elements.length;i++){
    var element = elements[i];
    if(element.id == value){
      var elementProcessed = processElement(element);
      return elementProcessed.parameters;
    }
  }
  return [];
}

/**
*   Check if filter exist in this widget.
*   Return {
*       id : "param id"
*       value : "selected value"
*    }
*/
function getWidgetFilterParam(field) {

  if(field == null || field.settings === undefined){
    return null;
  }

  if(field.settings['hiddenFilter'] !== undefined && field.settings['hiddenFilter'] != null
    && field.settings['hiddenFilter'] != ''){

    var paramArray = field.settings['hiddenFilter'].split(':');

    return {
      id : paramArray[0],
      value : paramArray[1]
    }
  }

  return null;
}
