import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

class ImagesField extends Component {

  constructor(props){
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
    this.onImageSelect = this.onImageSelect.bind(this);
    //this.cancelImage = this.cancelImage.bind(this);
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
    //console.log("\n\nImagesField identifier : ");
    //console.log(this.props.field.identifier);

    this.props.onImageSelect(this.props.field.identifier);
  }

  cancelImage(index,event) {
    event.preventDefault();

    const images = this.props.field.values;

    images.splice(index,1);

    var field = {
      identifier : this.props.field.identifier,
      values : images
    };

    this.props.onFieldChange(field);

  }

  renderInputs() {

    const images = this.props.field.values;

    var result = [];

    for(var i=0;i<images.length;i++){

      result.push(
        <div className="image-field" key={i+1}>
           <div className="image" style={{backgroundImage:"url("+images[i].url+")"}} ></div>
           <a href="" className="btn btn-link" onClick={this.cancelImage.bind(this,i)}><i className="fa fa-times-circle"></i></a>
        </div>
      );
    }

    result.push(
      <div className="image-field" key={0}>
         <div className="image"></div>
         <div className="add-button">
           <a href="#" className="btn btn-default" onClick={this.onImageSelect}><i className="fa fa-plus-circle"></i>  Seleccionar</a>
         </div>
      </div>
    );

    return result;

  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.IMAGES.icon}></i> {CustomFieldTypes.IMAGES.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>

          <div className="field-form">
            <div className="image-field-container images-gallery">
              {this.renderInputs()}
            </div>
          </div>

        </div>

      </div>
    );
  }

}
export default ImagesField;
