import React, {Component} from 'react';
import { render } from 'react-dom';

class SelectorSettingsField extends Component {

  constructor(props) {
    super(props);

    this.handleFieldChange = this.handleFieldChange.bind(this);
  }

  handleFieldChange(event) {

    var field = {
      name : this.props.name,
      source : this.props.source,
      value : event.target.value
    };

    this.props.onFieldChange(field);
  }


  renderOptions() {
    return (this.props.options.map((item,i) => (
        <option value={item.value} key={i}>{item.name}</option>
      ))
    );
  }

  render() {


    var value = null;
    var display = false;

    if(this.props.field != null && this.props.field[this.props.source] != null && this.props.field[this.props.source][this.props.name] !== undefined){
      display = true;
      if(this.props.field[this.props.source][this.props.name] != null ) {
        value = this.props.field[this.props.source][this.props.name];
      }
      else {
        value = "";
      }
    }

    return (

      <div style={{display : display ? 'block' : 'none'}}>
        <div className="setup-field" >

          <div className="togglebutton">
            <div>
              <label>
                  {this.props.label}
              </label>
            </div>
          </div>

          <div className="setup-field-config">

            <div className="form-group bmd-form-group">

              <select className="form-control" name={this.props.name} value={value} onChange={this.handleFieldChange} >
                {this.renderOptions()}
              </select>


            </div>
          </div>

        </div>
      </div>

    );
  }

}
export default SelectorSettingsField;
