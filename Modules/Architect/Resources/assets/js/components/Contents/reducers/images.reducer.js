import {
  IMAGE_CANCEL,
  IMAGE_SELECT,
  UPDATE_IMAGE

} from '../constants';

const initialState =  {
  //modal states
  displayModal: false,
  sourceField: null,
  sourceLanguage : null
}

function imagesReducer(state = initialState, action) {

    //const {fields, translations} = state;

    switch(action.type) {
        case IMAGE_SELECT :
            return {
                ...state,
                displayModal : true,
                sourceField : action.payload.identifier,
                sourceLanguage : action.payload.language
            }
        case IMAGE_CANCEL :
            return {
                ...state,
                displayModal : false,
                sourceField : null,
                sourceLanguage : null
            }

        case UPDATE_IMAGE:
            return {
                ...state,
                displayModal : false,
                sourceField : null,
                sourceLanguage : null
            }

        default:
            return state;
    }
}

export default imagesReducer;
