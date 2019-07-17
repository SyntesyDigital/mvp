import {
  MODAL_CONTENT_OPEN,
  MODAL_CONTENT_CLOSE,
  MODAL_CONTENT_SELECT

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


        default:
            return state;
    }
}

export default contentsReducer;
