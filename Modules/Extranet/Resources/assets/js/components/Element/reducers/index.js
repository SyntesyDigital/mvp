import {combineReducers} from 'redux';
import appReducer from './app.reducer';
import fontawesomeReducer from './fontawesome.reducer';

export default combineReducers({
    app: appReducer,
    fontawesome : fontawesomeReducer
});
