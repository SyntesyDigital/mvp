import React, {Component} from 'react';
import { render } from 'react-dom';

class NumberField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);
  }


  handleOnChange(event)
  {

    this.props.onFieldChange({
      name : event.target.name,
      value : event.target.value
    });

  }

  render() {

    const {field} = this.props;

    return (

      <div className="row element-form-row">
        <div className="col-sm-4">
          <label>{field.name}</label>
        </div>
        <div className="col-sm-6">
          <input type="number" name={field.identifier} className="form-control"
            value={this.props.value}
            onChange={this.handleOnChange.bind(this)}
          />
        </div>
      </div>
    );
  }

}

export default NumberField;
