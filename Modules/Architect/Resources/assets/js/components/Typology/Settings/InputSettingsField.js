import React, {Component} from 'react';
import { render } from 'react-dom';

class InputSettingsField extends Component {

  constructor(props) {
    super(props);

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);

  }

  handleFieldChange(event) {

    var field = {
      name : this.props.name,
      value : {
        checkbox : event.target.checked,
        input : ""
      }
    };

    this.props.onFieldChange(field);
  }

  handleInputChange(event) {

    var field = {
      name : this.props.name,
      value : {
        checkbox : true,
        input : event.target.value
      }
    };

    this.props.onFieldChange(field);

  }

  render() {


    var checkbox = null;
    if(this.props.field != null && this.props.field.settings[this.props.name] !== undefined){
      checkbox = this.props.field.settings[this.props.name].checkbox;
    }

    var input = "";
    if(this.props.field != null && this.props.field.settings[this.props.name] !== undefined){
      input = this.props.field.settings[this.props.name].input;
    }

    return (

      <div style={{display : checkbox != null ? 'block' : 'none'}}>
        <div className="setup-field" >
          <div className="togglebutton">
            <label>
                <input type="checkbox"
                  name={this.props.name}
                  checked={ checkbox != null ? checkbox : false }
                  onChange={this.handleFieldChange}
                />
                {this.props.label}
            </label>
          </div>


          <div className="setup-field-config" style={{display : checkbox != null && checkbox ? "block" : "none" }}>
            <div className="form-group bmd-form-group">
               <label htmlFor="num" className="bmd-label-floating">{this.props.inputLabel}</label>
               <input type="text" name="" className="form-control" id="num" value={input} onChange={this.handleInputChange}/>
            </div>
          </div>

        </div>
      </div>

    );
  }

}
export default InputSettingsField;
