import {
  INIT_STATE,
  INPUT_CHANGE,
  DELETE_ELEMENT,
  SAVE_ERROR,
  SAVE_SUCCESS,

  FIELD_ADD,
  FIELD_MOVE,
  FIELD_REMOVE,
  FIELD_CHANGE,

  SETTINGS_OPEN,
  SETTINGS_CHANGE,
  SETTINGS_CLOSE,
  SETTINGS_CLOSED

} from '../constants';

import update from 'immutability-helper';


var translations = {};
LANGUAGES.map(function(v,k){
    translations[v.iso] = true;
});

const initialState =  {
  translations : translations,
  fields : [],
  inputs: {
      name: "",
      identifier: "",
      icon: ""
  },
  errors: {
      name: null,
      identifier: null,
      fields: null,
  },
  settingsField: null,
  fieldsList : [],
  model : null,
  element : null,
  settingsField : null,
  modalSettingsDisplay : false
}

function appReducer(state = initialState, action) {

    const {fields, fieldsList, settingsField} = state;

    switch(action.type) {
        case INIT_STATE:

            var elementInputs = {
              name: "",
              identifier: "",
              icon: {
                label: '',
                value: ''
              }
            };

            if(action.payload.element == null || action.payload.element == '') {
              elementInputs = {
                name: action.payload.model.TITRE,
                identifier: action.payload.model.ID,
                icon: {
                  label: action.payload.model.ICONE,
                  value: action.payload.model.ICONE
                }
              };
            }

            return {
                ...state,
                element : action.payload.element,
                model : action.payload.model,
                fieldsList : action.payload.fieldsList,
                inputs : elementInputs
            }
        case INPUT_CHANGE :

            const {inputs} = state;
            inputs[action.field.name] = action.field.value;

            return {
                ...state,
                inputs
            }
        case SAVE_ERROR :

          var stateErrors = state.errors;
          var errors = action.payload;

          if(errors != null) {
              Object.keys(stateErrors).map(function(k){
                  stateErrors[k] = errors[k] ? true : false;
              });
          }

          return {
              ...state,
              errors : stateErrors
          };

        case SAVE_SUCCESS :

          for(var i=0;i<fields.length;i++){
            fields[i].saved = true;
          }

          return {
            ...state,
            element : action.payload,
            fields : fields
          };

        case DELETE_ELEMENT:
            return {
              ...state
            }

        case FIELD_ADD :

            fields.push(action.payload);

            for(var key in fieldsList){
              if(fieldsList[key].identifier == action.payload.identifier){
                fieldsList[key].added = true;
              }
            }

            return {
              ...state,
              fields,
              fieldsList
            }
        case FIELD_MOVE :

            const dragField = fields[action.payload.dragIndex];

            return update(state, {
                    fields: {
                        $splice: [
                            [action.payload.dragIndex, 1],
                            [action.payload.hoverIndex, 0, dragField]
                        ],
                    },
                });

        case FIELD_REMOVE :

            var currentIdentifier = "";

            for (var i = 0; i < fields.length; i++) {
                if (action.payload == fields[i].id) {
                    currentIdentifier = fields[i].identifier;
                    fields.splice(i, 1);
                    break;
                }
            }

            for(var key in fieldsList){
              if(fieldsList[key].identifier == currentIdentifier){
                fieldsList[key].added = false;
                break;
              }
            }

            return {
              ...state,
              fields,
              fieldsList
            }
        case FIELD_CHANGE :

            for (var i = 0; i < fields.length; i++) {
                if (action.payload.id == fields[i].id) {
                   fields[i]["name"] = action.payload.name;
                   break;
                }
            }

            return {
              ...state,
              fields
            }

        case SETTINGS_OPEN :

            var newField = null;

            for(var key in fields){
              if(fields[key].id == action.payload){
                newField = fields[key];
                break;
              }
            }

            return {
              ...state,
              settingsField : newField,
              modalSettingsDisplay : true
            }

        case SETTINGS_CHANGE :

            var field = action.payload;

            settingsField[field.source][field.name] = field.value;

            //console.log("SETTINGS_CHANGE :: ",settingsField);

            return {
              ...state,
              settingsField : settingsField
            }

        case SETTINGS_CLOSE :

            return {
              ...state,
              modalSettingsDisplay : false
            }

        case SETTINGS_CLOSED :

            return {
              ...state,
              settingsField : null
            }


        default:
            return state;
    }
}

export default appReducer;
