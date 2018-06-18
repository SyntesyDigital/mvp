import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class TextField extends Component
{
  constructor(props)
  {
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
  }


  handleOnChange(event)
  {
    const language = $(event.target).closest('.form-control').attr('language');
    const values = this.props.field.value ? this.props.field.value : {};
    values[language] = event.target.value;

    this.props.onFieldChange({
      identifier : this.props.field.identifier,
      value : values
    });
  }
  
  renderInputs()
  {
    var inputs = [];
    for(var key in this.props.translations){        
        var value = this.props.field.value && this.props.field.value[key] ? this.props.field.value[key] : '';          
        var error = this.props.errors && this.props.errors[key] ? this.props.errors[key] : null;          
        
        inputs.push(
            <div className={'form-group bmd-form-group ' + (error !== null ? 'has-error' : null)} key={key}>
                <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name} - {key}</label>
                <input type="text" className="form-control" language={key} name="name" value={value} onChange={this.handleOnChange} />
            </div>
        );
    }
    
    return inputs;
  }


  render() {      
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa " + FIELDS.TEXT.icon}></i> {FIELDS.TEXT.name}
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
export default TextField;
