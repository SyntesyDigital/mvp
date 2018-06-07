import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

const TYPE_INTERNAL = "internal";
const TYPE_EXTERNAL = "external";

/*

values :  {
  ca : "Hola",
  es : "Hola",
  en : "Hola",


  linkType : "internal",
  linkValues : {
    ca : "http://",
    es : "http://",
    en : "http://",
  }


  linkType : "external",
  linkValues : {
    id : "1",
    label : "Event",
    icon : "fa-calendar",
    name : "Page title"
  }

}

*/

class LinkField extends Component
{
  constructor(props)
  {
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
    this.handleLinkChange = this.handleLinkChange.bind(this);
    this.handleLinkTypeChange = this.handleLinkTypeChange.bind(this);
    this.onContentSelect = this.onContentSelect.bind(this);
    this.onRemoveField = this.onRemoveField.bind(this);
  }

  componentDidMount()
  {
    if(this.props.field.values === undefined || this.props.field.values == null){
      this.updateByType(TYPE_INTERNAL);
    }
  }

  onContentSelect(event) {
      event.preventDefault();
      this.props.onContentSelect(this.props.field.identifier);
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

  handleLinkTypeChange(event)
  {
    this.updateByType(event.target.value);
  }

  updateByType(type)
  {

    const values = this.props.field.values ? this.props.field.values : {};

    values.linkType = type;

    var linkValues = values.linkType == TYPE_INTERNAL ?
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

    var linkValues = this.props.field.values !== undefined && this.props.field.values.linkValues !== undefined
      && this.props.field.values.linkValues != null ?
      this.props.field.values.linkValues : {};

    linkValues[language] = event.target.value;
    values.linkValues = linkValues;

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    this.props.onFieldChange(field);
  }

  onRemoveField(event){

    event.preventDefault();

    const values = this.props.field.values;

    values.linkValues = null;

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    this.props.onFieldChange(field);

  }

  renderTitle()
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

    return inputs;
  }

  renderRadio() {

    const linkType = this.props.field.values !== undefined && this.props.field.values.linkType !== undefined ?
      this.props.field.values.linkType : TYPE_INTERNAL;

    return (

      <div className="radio-form">

        <br/>

        <label className="form-check-label" >
            <input className="form-check-input" type="radio"
              checked={linkType == TYPE_INTERNAL}
              name={"linkType"+this.props.field.identifier}
              value={TYPE_INTERNAL}
              onChange={this.handleLinkTypeChange}
            /> &nbsp;
            Enllaç intern
            &nbsp;&nbsp;
        </label>

        &nbsp;

        <label className="form-check-label">
            <input className="form-check-input" type="radio"
              checked={linkType == TYPE_EXTERNAL}
              name={"linkType"+this.props.field.identifier}
              value={TYPE_EXTERNAL}
              onChange={this.handleLinkTypeChange}
            /> &nbsp;
            Enllaç extern
            &nbsp;&nbsp;
        </label>

        <br/>
        <br/>

      </div>


    );
  }

  renderLinks(linkValues)
  {

    var inputs = [];
    for(var key in this.props.translations){
      if(this.props.translations[key]){
          var value = '';
          console.log(this.props.field);

          if(linkValues !== undefined && linkValues != null) {
              value = linkValues[key] ? linkValues[key] : '';
          }

        inputs.push(
          <div className="form-group bmd-form-group" key={key}>
             <label htmlFor={this.props.field.identifier} className="bmd-label-floating">Enllaç - {key}</label>
             <input type="text" className="form-control" language={key} name="name" value={value} onChange={this.handleLinkChange} />
          </div>
        );
      }
    }

    return inputs;
  }

  renderSelectedPage(linkValues)
  {

    const pageValues = linkValues;

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


  render() {

    const linkType = this.props.field.values !== undefined && this.props.field.values.linkType !== undefined ?
      this.props.field.values.linkType : TYPE_INTERNAL;

    const linkValues = this.props.field.values !== undefined && this.props.field.values.linkValues !== undefined ?
      this.props.field.values.linkValues : null;

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

            {this.renderTitle()}

            {this.renderRadio()}

            {linkType == TYPE_INTERNAL &&
              this.renderSelectedPage(linkValues)
            }

            {linkType == TYPE_EXTERNAL &&
              this.renderLinks(linkValues)
            }

          </div>

        </div>

      </div>
    );
  }

}
export default LinkField;
