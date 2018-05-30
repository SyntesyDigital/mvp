import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class ImageField extends Component {

  constructor(props){
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
    this.onImageSelect = this.onImageSelect.bind(this);
    this.cancelImage = this.cancelImage.bind(this);
  }


  handleOnChange(event) {

    const language = $(event.target).closest('.form-control').attr('language');


    var field = {
      identifier : this.props.field.identifier,
      language : language,
      values : event.target.value
    };

    console.log("textField :: handleOnChange ");
    console.log(field);

    this.props.onFieldChange(field);
  }

  onImageSelect(event) {
    event.preventDefault();
    //console.log("\n\nImageField identifier : ");
    //console.log(this.props.field.identifier);

    this.props.onImageSelect(this.props.field.identifier);
  }

  cancelImage(event) {
    event.preventDefault();

    var field = {
      identifier : this.props.field.identifier,
      values : {
        url : ""
      }
    };

    this.props.onFieldChange(field);

  }

  renderInputs() {

    return (
      <div className="form-group bmd-form-group image-field-container">
         <div className="image-field">
            <div className="image" style={{backgroundImage:"url("+this.props.field.values.url+")"}} ></div>
            {this.props.field.values.url == "" &&
              <div className="add-button">
                <a href="#" className="btn btn-default" onClick={this.onImageSelect}><i className="fa fa-plus-circle"></i>  Seleccionar</a>
              </div>
            }
         </div>

          {this.props.field.values.url != "" &&
            <div className="image-buttons">
              {/*<a href="" className="btn btn-link"><i className="fa fa-pencil"></i> Editar</a>*/}
               <a href="" className="btn btn-link text-danger" onClick={this.cancelImage}><i className="fa fa-times"></i> Cancel·lar</a>
            </div>
           }

         <p className="field-help"> <b>{this.props.field.settings.name}</b> : Mides {this.props.field.settings.width}x{this.props.field.settings.height} ( Ratio {this.props.field.settings.ratio} )</p>
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
