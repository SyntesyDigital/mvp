import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

const TYPE_YOUTUBE = "youtube";
const TYPE_VIMEO = "vimeo";

/*

values :  {
  ca : "Hola",
  es : "Hola",
  en : "Hola",

  linkType : "youtube",
  linkValues : {
    ca : "http://",
    es : "http://",
    en : "http://",
  }

}

*/

class VideoField extends Component
{
  constructor(props)
  {
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
    this.handleLinkChange = this.handleLinkChange.bind(this);
    this.handleLinkTypeChange = this.handleLinkTypeChange.bind(this);
  }

  componentDidMount()
  {
    if(this.props.field.values === undefined || this.props.field.values == null){
      this.updateByType(TYPE_YOUTUBE);
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

    var linkValues = {
          ca : "http://",
          es : "http://",
          en : "http://"
        };

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
      this.props.field.values.linkType : TYPE_YOUTUBE;

    return (

      <div className="radio-form">

        <br/>

        <label className="form-check-label" >
            <input className="form-check-input" type="radio"
              checked={linkType == TYPE_YOUTUBE}
              name={"linkType"+this.props.field.identifier}
              value={TYPE_YOUTUBE}
              onChange={this.handleLinkTypeChange}
            /> &nbsp;
            YouTube
            &nbsp;&nbsp;
        </label>

        &nbsp;

        <label className="form-check-label">
            <input className="form-check-input" type="radio"
              checked={linkType == TYPE_VIMEO}
              name={"linkType"+this.props.field.identifier}
              value={TYPE_VIMEO}
              onChange={this.handleLinkTypeChange}
            /> &nbsp;
            Vimeo
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

  render() {

    const linkType = this.props.field.values !== undefined && this.props.field.values.linkType !== undefined ?
      this.props.field.values.linkType : TYPE_YOUTUBE;

    const linkValues = this.props.field.values !== undefined && this.props.field.values.linkValues !== undefined ?
      this.props.field.values.linkValues : null;

    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa " + CustomFieldTypes.VIDEO.icon}></i> {CustomFieldTypes.VIDEO.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>

          <div className="field-form">

            {this.renderTitle()}

            {this.renderRadio()}

            {this.renderLinks(linkValues)}

          </div>

        </div>

      </div>
    );
  }

}
export default VideoField;
