import React, {Component} from 'react';
import { render } from 'react-dom';

class BooleanSettingsField extends Component {

  constructor(props) {
    super(props);

    this.handleFieldChange = this.handleFieldChange.bind(this);
  }

  handleFieldChange(event) {
    var field = {
      name : event.target.name,
      value : event.target.checked
    };

    this.props.onFieldChange(field);

  }

  render() {
    return (
      <div className="setup-field" style={{display : this.props.field != null && this.props.field.settings[this.props.name] !== undefined ? 'block' : 'none'}}>
        <div className="togglebutton">
          <label>
              <input
                type="checkbox"
                name={this.props.name}
                checked={ this.props.field != null && this.props.field.settings[this.props.name] !== undefined  ? this.props.field.settings[this.props.name] : false }
                onChange={this.handleFieldChange}
              />
              {this.props.label}
          </label>
        </div>
      </div>
    );
  }

}
export default BooleanSettingsField;
