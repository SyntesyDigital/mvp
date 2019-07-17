import {
  MODAL_CONTENT_OPEN,
  MODAL_CONTENT_CLOSE,
  MODAL_CONTENT_SELECT,
  MODAL_CONTENT_CLEAR

} from '../constants';

const initialState =  {
  content : null,
  display : false
}


function contentsReducer(state = initialState, action) {

    switch(action.type) {
        case MODAL_CONTENT_OPEN:

            return {
              ...state,
              display : true,
              content : null,
            };

        case MODAL_CONTENT_CLOSE:

            return {
              ...state,
              display : false
            };
        case MODAL_CONTENT_SELECT :

            return {
              ...state,
              display: false,
              content: action.payload
            }
        case MODAL_CONTENT_CLEAR :

            return {
              ...state,
              content: null
            }

        default:
            return state;
    }
}

export default contentsReducer;
