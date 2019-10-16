import React, {Component} from 'react';
import { render } from 'react-dom';
import axios from 'axios';

import {
  HIDDEN_FIELD
} from './../constants';

import {
  parameteres2Array
} from './../actions/';

class SelectField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);

    const {boby,parameters} = this.processBoby(this.props.field.boby);

    this.state = {
      loading : true,
      data : [],
      boby : boby,
      parameters : parameters
    };

    this.loadData();
  }

  /**
  *   Clean boby wihout parameters, and check all paremters are defined.
  */
  processBoby(boby) {

    var parameters = parameteres2Array(this.props.parameters);

    if(boby.indexOf('?') != -1){
      //if has parameters
      var bobyArray = boby.split('?');
      boby = bobyArray[0];

      var bobyParams = parameteres2Array(bobyArray[1]);

      for(var key in bobyParams){
        if(parameters[key] === undefined){
          //if any parameters is not defined show error

          return {
            boby : boby,
            parameters : null
          }
        }
      }
    }

    return {
      boby : boby,
      parameters : this.props.parameters
    }
  }

  loadData() {

      var self = this;

      if(this.state.parameters == null){
        console.error("Parameter necessary not defined , "+key);
        return;
      }

      axios.get('/architect/elements/select/data/'+this.state.boby+"?"+this.state.parameters)
        .then(function(response) {
          if(response.status == 200 && response.data.data !== undefined){
            self.setState({
              data : response.data.data,
              loading : false
            });

            if(response.data.data.length == 0){
              //no data set this field as hidden, not needed
              self.setHidden();
            }

          }
        })
        .catch(function (error) {
          console.error(error);
        });
  }

  setHidden() {
    this.props.onFieldChange({
      name : this.props.field.identifier,
      value : HIDDEN_FIELD
    });
  }

  handleOnChange(event)
  {

    this.props.onFieldChange({
      name : event.target.name,
      value : event.target.value
    });

  }

  renderOptions() {

    return this.state.data.map((item,index) =>
      <option value={item.value} key={index}>{item.name}</option>
    );
  }

  render() {

    const {field} = this.props;
    let defaultValue = this.state.loading ? 'Chargement...' : 'Sélectionnez';
    defaultValue = this.state.parameters != null ? defaultValue : 'Paramètres insuffisants';
    const isRequired = field.rules.required !== undefined ?
      field.rules.required : false;
    const errors = this.props.error ? 'is-invalid' : '';
    const display = this.props.value != HIDDEN_FIELD ? true : false;

    return (

      <div className="row element-form-row" style={{display : display ? 'block' : 'none'}}>
        <div className="col-sm-4">
          <label>{field.name}
            {isRequired &&
              <span className="required">&nbsp; *</span>
            }
          </label>
        </div>
        <div className="col-sm-6">

          <select
            name={field.identifier}
            className={"form-control " + errors}
            value={this.props.value}
            onChange={this.handleOnChange.bind(this)}
          >
            <option value="">{defaultValue}</option>
            {this.renderOptions()}
          </select>
        </div>
      </div>
    );
  }

}

export default SelectField;
