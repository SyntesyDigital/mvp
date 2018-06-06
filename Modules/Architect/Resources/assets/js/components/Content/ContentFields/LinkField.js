import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class LinkField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);
    this.handleLinkChange = this.handleLinkChange.bind(this);
    this.handlePageChange = this.handlePageChange.bind(this);
  }

  handleOnChange(event)
  {
    const language = $(event.target).closest('.form-control').attr('language');
    const values = this.props.field.values ? this.props.field.values : {};
    values[language] = event.target.value;

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    this.props.onFieldChange(field);
  }

  handlePageChange(event)
  {
    const values = this.props.field.values ? this.props.field.values : {};

    values.isPage = event.target.checked;

    var linkValues = values.isPage ?
        null
      :
        {
          ca : "http://",
          es : "http://",
          en : "http://"
        }
      ;

    values.linkValues = linkValues;

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    console.log(field);

    this.props.onFieldChange(field);
  }

  handleLinkChange(event)
  {
    const language = $(event.target).closest('.form-control').attr('language');
    const values = this.props.field.values ? this.props.field.values : {};
    values.linkValues[language] = event.target.value;

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    this.props.onFieldChange(field);
  }

  renderSelectedPage()
  {

    const pageValues = this.props.field.values.linkValues;

    if(pageValues != null){
      return (
        <div className="field-form fields-list-container">

          <div className="typology-field">
            <div className="field-type">
              <i className={"fa "+pageValues.icon}></i> &nbsp; {pageValues.label}
            </div>

            <div className="field-inputs">
              <div className="row">
                <div className="field-name col-xs-6">
                  {pageValues.name}
                </div>
              </div>
            </div>

            <div className="field-actions">
              <a href="" className="remove-field-btn" onClick={this.onRemoveField}> <i className="fa fa-trash"></i> Esborrar </a>
              &nbsp;&nbsp;
            </div>
          </div>

        </div>
      );
    }
    else {
      return (
        <div className="add-content-button">
          <a href="" className="btn btn-default" onClick={this.onContentSelect}><i className="fa fa-plus-circle"></i> Seleccionar </a>
        </div>
      );
    }

  }

  renderInputs()
  {
    var inputs = [];
    for(var key in this.props.translations){
      if(this.props.translations[key]){
          var value = '';
          console.log(this.props.field);

          if(this.props.field.values) {
              value = this.props.field.values[key] ? this.props.field.values[key] : '';
          }

        inputs.push(
          <div className="form-group bmd-form-group" key={key}>
             <label htmlFor={this.props.field.identifier} className="bmd-label-floating">Títol - {key}</label>
             <input type="text" className="form-control" language={key} name="name" value={value} onChange={this.handleOnChange} />
          </div>
        );
      }
    }

    inputs.push(
      <div className="togglebutton" >
        <label>
            És un enllaç intern ?
            <input type="checkbox"
              checked={this.props.field.values.isPage}
              onChange={this.handlePageChange}
            />
        </label>
      </div>
    );

    if(this.props.field.values.isPage) {

      inputs.push(this.renderSelectedPage());

    }
    else {
      for(var key in this.props.translations){
        if(this.props.translations[key]){
            var value = '';
            console.log(this.props.field);

            if(this.props.field.values) {
                value = this.props.field.values.linkValues[key] ? this.props.field.values.linkValues[key] : '';
            }

          inputs.push(
            <div className="form-group bmd-form-group" key={key}>
               <label htmlFor={this.props.field.identifier} className="bmd-label-floating">Enllaç - {key}</label>
               <input type="text" className="form-control" language={key} name="name" value={value} onChange={this.handleLinkChange} />
            </div>
          );
        }
      }
    }

    return inputs;
  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa " + CustomFieldTypes.LINK.icon}></i> {CustomFieldTypes.LINK.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>

          <div className="field-form">

            {this.renderInputs()}

          </div>

        </div>

      </div>
    );
  }

}
export default LinkField;
