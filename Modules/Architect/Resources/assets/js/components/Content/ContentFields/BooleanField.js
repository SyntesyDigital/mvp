import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class BooleanField extends Component {

  constructor(props){
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
  }

  handleOnChange(event) {

    var field = {
      identifier : this.props.field.identifier,
      values : event.target.checked
    };

    this.props.onFieldChange(field);
  }

  renderInputs() {

    return (

      <div className="togglebutton" >
        <label>
            {this.props.field.name}
            <input type="checkbox"
              checked={this.props.field.values}
              onChange={this.handleOnChange}
            />
        </label>
      </div>

    );
  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.BOOLEAN.icon}></i> {CustomFieldTypes.BOOLEAN.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>

          <div className="field-form">
            <div className="row">
              <div className="col-md-6 col-xs-12">
                {this.renderInputs()}
              </div>
            </div>

          </div>

        </div>

      </div>
    );
  }

}
export default BooleanField;
