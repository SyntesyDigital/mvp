import React, {Component} from 'react';
import { render } from 'react-dom';

import ModalListField from './ModalListField';

class ListField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);

    console.log("ListField => ",this.props.field);

    this.state = {
      value : [],
      display : true
    };
  }


  handleOnChange(event)
  {

    /*
    this.props.onFieldChange({
      name : event.target.name,
      value : event.target.value
    });
    */

  }

  openModal(e) {
    e.preventDefault();

    this.setState({
      display : true
    });

  }

  renderFields() {
    const {fields} = this.props.field.settings;
    return fields.map((item,index) =>
      <th key={index}>{item.name}</th>
    );
  }

  renderValues() {
    const {value} = this.state;
    return value.map((item,index) =>
      <tr>
        <td>Mark</td>
        <td className="text-right">
          <a href="#" className="btn btn-link"><i className="fas fa-pencil-alt"></i></a> &nbsp;
          <a href="#" className="btn btn-link btn-danger"><i className="fas fa-trash-alt"></i></a>
        </td>
      </tr>
    );
  }

  renderTable() {
    return (
      <table className="table">
        <thead>
          <tr>
            {this.renderFields()}
            <th></th>
          </tr>
        </thead>
        <tbody>
            {this.state.value.length > 0 &&
              this.renderValues()
            }
        </tbody>
      </table>
    );
  }

  handleModalClose(){
    this.setState({
      display : false
    });
  }

  render() {

    const {field} = this.props;

    return (
      <div className="list-field">

        <ModalListField
          display={this.state.display}
          onModalClose={this.handleModalClose.bind(this)}
          zIndex={1000}
          fields={this.props.field.settings.fields}
        />

        <div className="row element-form-row">
          <div className="col-sm-4">
            <label>{field.name}</label>
          </div>
          <div className="col-sm-6">
            <a href="" className="btn btn-default" onClick={this.openModal.bind(this)}>
              <i className="fas fa-plus"></i> Ajouter
            </a>
          </div>
        </div>
        {this.state.value.length > 0 &&
          <div className="row element-form-row">
            <div className="col-sm-6 col-sm-offset-4">
              {this.renderTable()}
            </div>
          </div>
        }
      </div>
    );
  }

}

export default ListField;
