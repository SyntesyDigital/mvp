import React, {Component} from 'react';
import { render } from 'react-dom';

class RadioSettingsField extends Component {

  constructor(props) {
    super(props);
    
    this.state = {
        checked : 'off',
        field : {
            name : this.props.name,
            source : this.props.source,
            value : null
        }
    }
    
    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleCheckboxChange = this.handleCheckboxChange.bind(this);
  }

  handleFieldChange(event) {
    this.setState({
        checked : event.target.checked,
        field : {
            name : this.props.name,
            source : this.props.source,
            value : null
        },
    });
    
    this.props.onFieldChange(this.state.field);
  }

  handleCheckboxChange(event) {
      console.log('=> handleCheckboxChange');
      console.log('value => ',event.target.value);
      
      this.setState({
          field : {
            name : this.props.name,
            source : this.props.source,
            value : event.target.value
          },
      });
      
      this.props.onFieldChange(this.state.field);
  }


  renderOptions() {

    var self = this;    
    var value = this.props.field && this.props.field[this.props.source] && this.props.field[this.props.source][this.props.name] !== undefined ? this.props.field[this.props.source][this.props.name] : null;
    
    return (
      this.props.options.map((item,i) => (
        <label className="form-check-label" key={i}>
            <input className="form-check-input" type="radio"
              checked={(self.state.field !== null && self.state.field.value == item.value) || value == item.value ? true : false}
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
      
    var display = this.props.field != null  
        && this.props.field[this.props.source] != null  
        && this.props.field[this.props.source][this.props.name] !== undefined
        ? true : false;
         
    return (
      <div style={{display : display ? 'block' : 'none'}}>
        <div className="setup-field" >
          <div className="togglebutton">
            <label>
                <input type="checkbox"
                  name={this.props.name}
                  checked={this.state.checked}
                  onChange={this.handleFieldChange}
                />
                {this.props.label}
            </label>
          </div>

          <div className="setup-field-config" style={{display : this.state.checked ? "block" : "none" }}>
            <div className="form-group bmd-form-group">
              {this.renderOptions()}
            </div>
          </div>
        </div>
      </div>
    );
  }

}
export default RadioSettingsField;
