import {
  EDIT_ITEM_CANCEL,
  EDIT_ITEM_SELECT,
  UPDATE_EDIT_ITEM,
  INIT_EDIT_ITEM_MODAL,
  EDIT_ITEM_UPDATE_CATEGORIES,
  EDIT_ITEM_UPDATE_ELEMENS

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
         fileElementsTo.push({
           value: elementsFrom[i].id,
           name : elementsFrom[i].name,
         });
       }
       if(elementsFrom[i].type == 'form'){
         formElementsTo.push({
           value: elementsFrom[i].id,
           name : elementsFrom[i].name,
         });
       }
       if(elementsFrom[i].type == 'table'){
         tableElementsTo.push({
           value: elementsFrom[i].id,
           name : elementsFrom[i].name,
         });
       }
    }
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

export function editItem(item) {

  return { type: EDIT_ITEM_SELECT, payload : item };
};

export function cancelEditItem() {

  return { type: EDIT_ITEM_CANCEL };
};
