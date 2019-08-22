import React, {Component} from 'react';
import { render } from 'react-dom';
import DatePicker from 'react-datepicker';
import moment from 'moment';
import 'react-datepicker/dist/react-datepicker.css';

class DateField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);
  }


  handleOnChange(date)
  {

    var field = {
      name : this.props.field.identifier,
      value : date
    };

    this.props.onFieldChange(field);

  }

  render() {

    const {field} = this.props;

    return (

      <div className="row element-form-row">
        <div className="col-sm-4">
          <label>{field.name}</label>
        </div>
        <div className="col-sm-6">
          <DatePicker
              className="form-control"
              selected={ this.props.value != '' ? moment(this.props.value) : null }
              onChange={this.handleOnChange}
              dateFormat="DD/MM/YYYY"
              locale="fr"
          />
        </div>
      </div>
    );
  }

}

export default DateField;
