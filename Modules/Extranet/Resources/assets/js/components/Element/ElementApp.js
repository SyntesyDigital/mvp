import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from "react-redux";
import { createStore } from "redux";
import rootReducer from "./reducers/index";
import { connect } from 'react-redux'

import ElementForm from './ElementForm';

import configureStore from './configureStore'

let store = configureStore();

if (document.getElementById('element-form')) {
    var htmlElement = document.getElementById('element-form');

    ReactDOM.render(
      <Provider store={store}>
        <ElementForm
          element={htmlElement.getAttribute('element')}
          fields={htmlElement.getAttribute('fields')}
          model={htmlElement.getAttribute('model')}
        />
      </Provider>
    , htmlElement);
}
