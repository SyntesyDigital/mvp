import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class ImageField extends Component {

  constructor(props){
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);

  }


  handleOnChange(event) {

    const language = $(event.target).closest('.form-control').attr('language');


    var field = {
      identifier : this.props.field.identifier,
      language : language,
      value : event.target.value
    };

    console.log("textField :: handleOnChange ");
    console.log(field);

    this.props.onFieldChange(field);
  }

  renderInputs() {

    return (
      <div className="form-group bmd-form-group image-field-container">
         <div className="image-field">
            <div className="image" ></div>
            <div className="add-button">
              <a href="#" className="btn btn-default"><i className="fa fa-plus-circle"></i>  Seleccionar</a>
            </div>
         </div>
         <div className="image-buttons">
           <a href="" className="btn btn-link"><i className="fa fa-pencil"></i> Editar</a> &nbsp;
           <a href="" className="btn btn-link text-danger"><i className="fa fa-times"></i> Cancel·lar</a> &nbsp;
        </div>
         <p className="field-help">Thumbnail : Mides : 1000x400 ( Ratio 1:2 )</p>
      </div>
    );

  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.IMAGE.icon}></i> {CustomFieldTypes.IMAGE.name}
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
export default ImageField;
