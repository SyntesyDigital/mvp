import React, {Component} from 'react';
import { render } from 'react-dom';

class CheckboxesSettingsField extends Component {

  constructor(props) {
    super(props);

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleCheckboxChange = this.handleCheckboxChange.bind(this);
    this.existInput = this.existInput.bind(this);

  }

  handleFieldChange(event) {

    var field = {
      name : this.props.name,
      value : {
        checkbox : event.target.checked,
        fields : []
      }
    };

    this.props.onFieldChange(field);
  }



  handleCheckboxChange(event) {

    var fields = this.props.field.settings[this.props.name].fields;

    console.log("CheckboxesSettingsField::handleFieldChange");
    console.log(event.target.value);

    if(event.target.checked){
      //add value
      if(!this.existInput(event.target.value)){
        fields.push(parseInt(event.target.value));
      }
    }
    else {
      //remove value
      this.removeValue(event.target.value,fields);

    }

    var field = {
      name : this.props.name,
      value : {
        checkbox : true,
        fields : fields
      }
    };

    console.log("selectorSettingsField");
    console.log(field);

    this.props.onFieldChange(field);

  }

  removeValue(value,fields) {

    for(var i = fields.length-1;i>=0;i--){
      if(fields[i] == value){
        fields.splice(i,1);
      }
    }

  }

  existInput(value) {

    console.log("SelectorSettings : existInput : "+value);

    if(this.props.field != null && this.props.field.settings[this.props.name] !== undefined){

      const fields = this.props.field.settings[this.props.name].fields;
      console.log(fields);
      console.log(value);
      if(fields.indexOf(value) != -1){
        console.log("true");
        return true;
      }
    }
    console.log("false");
    return false;
  }

  renderOptions() {

    var self = this;
    console.log("renderOptions");

    return (
      this.props.options.map((item,i) => (
        <label className="form-check-label" key={i}>
            <input className="form-check-input" type="checkbox"
              checked={self.existInput(item.value)}
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
    if(this.props.field != null && this.props.field.settings[this.props.name] !== undefined){
      checkbox = this.props.field.settings[this.props.name].checkbox;
    }

    var fields = [];
    if(this.props.field != null && this.props.field.settings[this.props.name] !== undefined){
      fields = this.props.field.settings[this.props.name].fields;
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

              {this.renderOptions()}


            </div>
          </div>

        </div>
      </div>

    );
  }

}
export default CheckboxesSettingsField;
