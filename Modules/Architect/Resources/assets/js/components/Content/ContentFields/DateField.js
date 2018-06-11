import React, {Component} from 'react';
import { render } from 'react-dom';
import DatePicker from 'react-datepicker';
import moment from 'moment';

import 'react-datepicker/dist/react-datepicker.css';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class DateField extends Component {

  constructor(props){
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);
  }


  handleOnChange(date) {

    var field = {
      identifier : this.props.field.identifier,
      values : date
    };

    this.props.onFieldChange(field);
  }

  renderInputs() {
      
      var error = null;
      if(this.props.field.errors) {
          error = this.props.field.errors[key] ? this.props.field.errors[key] : null;
      }
      
    return (
      <div className={'form-group bmd-form-group ' + (error !== null ? 'has-error' : null)} >
         <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name}</label>

         <DatePicker
             className="form-control"
             selected={moment(this.props.field.values)}
             onChange={this.handleOnChange}
             showTimeSelect
             timeFormat="HH:mm"
             timeIntervals={15}
             dateFormat="LLL"
             timeCaption="time"
             locale="ca-es"
         />

      </div>
    );
  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.DATE.icon}></i> {CustomFieldTypes.DATE.name}
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
export default DateField;
