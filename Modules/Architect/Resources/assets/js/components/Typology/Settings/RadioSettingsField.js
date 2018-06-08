import React, {Component} from 'react';
import { render } from 'react-dom';

class RadioSettingsField extends Component {

  constructor(props) {
    super(props);

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleCheckboxChange = this.handleCheckboxChange.bind(this);

  }

  handleFieldChange(event) {

    var field = {
      name : this.props.name,
      source : this.props.source,
      value : {
        checkbox : event.target.checked,
        value : ""
      }
    };

    this.props.onFieldChange(field);
  }



  handleCheckboxChange(event) {

    var field = {
      name : this.props.name,
      source : this.props.source,
      value : {
        checkbox : true,
        value : event.target.value
      }
    };

    this.props.onFieldChange(field);

  }


  renderOptions(value) {

    var self = this;
    console.log("renderOptions");

    return (
      this.props.options.map((item,i) => (
        <label className="form-check-label" key={i}>
            <input className="form-check-input" type="radio"
              checked={value == item.value ? true : false}
              name={self.props.name}
              value={item.value}
              onChange={self.handleCheckboxChange}
            /> {'\u00A0'}
            {item.name}
            {'\u00A0'}
            {'\u00A0'}
        </label>

      ))
    );
  }

  render() {


    var checkbox = null;
    var display = false;
    var value = "";

    if(this.props.field != null  && this.props.field[this.props.source] != null && this.props.field[this.props.source] != null &&
      this.props.field[this.props.source][this.props.name] !== undefined){

      if(this.props.field[this.props.source][this.props.name] != null &&
        this.props.field[this.props.source][this.props.name].checkbox !== undefined){
        checkbox = this.props.field[this.props.source][this.props.name].checkbox;
      }
      else {
        checkbox = false;
      }

      display = true;

      if(this.props.field[this.props.source][this.props.name] != null &&
        this.props.field[this.props.source][this.props.name].value !== undefined){
        value = this.props.field[this.props.source][this.props.name].value;
      }
    }




    return (

      <div style={{display : display ? 'block' : 'none'}}>
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

              {this.renderOptions(value)}


            </div>
          </div>

        </div>
      </div>

    );
  }

}
export default RadioSettingsField;
