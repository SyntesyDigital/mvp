import React, {Component} from 'react';
import { render } from 'react-dom';
import axios from 'axios';

class SelectField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);

    this.state = {
      loading : true,
      data : []
    };

    this.loadData();
  }

  loadData() {

      var self = this;

      axios.get('/architect/elements/select/data/'+this.props.field.boby)
        .then(function(response) {
          if(response.status == 200 && response.data.data !== undefined){
            self.setState({
              data : response.data.data,
              loading : false
            });
          }
        })
        .catch(function (error) {
          console.error(error);
        });
  }

  handleOnChange(event)
  {

    this.props.onFieldChange({
      name : event.target.name,
      value : event.target.value
    });

  }

  renderOptions() {

    return this.state.data.map((item,index) =>
      <option value={item.value} key={index}>{item.name}</option>
    );
  }

  render() {

    const {field} = this.props;
    const defaultValue = this.state.loading ? 'Chargement...' : 'Sélectionnez';

    return (

      <div className="row element-form-row">
        <div className="col-sm-4">
          <label>{field.name}</label>
        </div>
        <div className="col-sm-6">

          <select
            name={field.identifier}
            className="form-control"
            value={this.props.value}
            onChange={this.handleOnChange.bind(this)}
          >
            <option value="">{defaultValue}</option>
            {this.renderOptions()}
          </select>
        </div>
      </div>
    );
  }

}

export default SelectField;
