import React, {Component} from 'react';
import { render } from 'react-dom';

import SlugInput from './../../common/SlugInput';

class SlugField extends Component
{
  constructor(props)
  {
    super(props);

    this.state = {
      sourceField : props.sourceField
    };

    //console.log("SlugField :: this.props.sourceField => ",this.props.sourceField);

    this.handleOnChange = this.handleOnChange.bind(this);
  }

  componentWillReceiveProps(nextProps) {

    console.log("SlugField ::will recieve props : =>",nextProps);

    //this.props.sourceField = nextProps.sourceField;

    this.setState({
      sourceField : nextProps.sourceField
    });

  }


  handleOnChange(key,value) {

    const language = key;
    const values = this.props.field.value ? this.props.field.value : {};
    values[language] = value;

    console.log("SlugField :: handleOnChange :: values => ",values);

    this.props.onFieldChange({
      identifier : this.props.field.identifier,
      value : values
    });

  }

  renderInputs()
  {

    var inputs = [];
    for(var key in this.props.translations){
        if(this.props.translations[key]){
          var value = this.props.field.value && this.props.field.value[key] ? this.props.field.value[key] : '';
          var error = this.props.errors && this.props.errors[key] ? this.props.errors[key] : null;

          console.log("source field )=> ",this.state.sourceField);

          var sourceValue = this.state.sourceField != null && this.state.sourceField.value !== undefined &&
            this.state.sourceField.value != null && this.state.sourceField.value[key] !== undefined ?
            this.state.sourceField.value[key] : '';

          console.log("source value )=> ",sourceValue);

          inputs.push(
              <div className={'form-group bmd-form-group ' + (error !== null ? 'has-error' : null)} key={key}>
                  <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name} - {key}</label>
                  {/*
                  <input type="text" className="form-control" language={key} name="name" value={value} onChange={this.handleOnChange} />
                  */}

                  <SlugInput
  									className="form-control"
                    language={key}
  									name="name"
  									placeholder="Idenfiticador"
  									sourceValue={sourceValue}
  									value={value}
  									blocked={false}
                    onFieldChange={this.handleOnChange.bind(this,key)}
  								/>

              </div>
          );
        }
    }

    return inputs;
  }


  render() {

    const hideTab = this.props.hideTab !== undefined && this.props.hideTab == true ? true : false;

    return (
      <div className="field-item">


        <button style={{display:(hideTab ? 'none' : 'block')}} id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa " + FIELDS.SLUG.icon}></i> {FIELDS.SLUG.name}
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
export default SlugField;
