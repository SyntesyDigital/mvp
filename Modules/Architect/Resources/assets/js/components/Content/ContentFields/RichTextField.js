import React, {Component} from 'react';
import { render } from 'react-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class RichTextField extends Component {

  constructor(props){
    super(props);

    //this.handleOnChange = this.handleOnChange.bind(this);

  }


  handleOnChange(key,value, delta, source, editor) {

    //const language = $(event.target).closest('.form-control').attr('language');

    //console.log("source : ");
    //console.log(key);
    //console.log(delta);
    //console.log(source);
    //console.log(editor);

    const values = this.props.field.values;

    values[key] = value;

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    console.log("textField :: handleOnChange ");
    console.log(field);

    this.props.onFieldChange(field);
  }

  renderInputs() {

    var inputs = [];

    for(var key in this.props.translations){
      if(this.props.translations[key]){
        inputs.push(

          <div className="form-group bmd-form-group" key={key}>
             <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name} - {key}</label>

             <ReactQuill
                id={key}
                value={this.props.field.values[key]}
                onChange={this.handleOnChange.bind(this,key)}
              />

          </div>
        );
      }
    }
    return inputs;
  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.RICH.icon}></i> {CustomFieldTypes.RICH.name}
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
export default RichTextField;
