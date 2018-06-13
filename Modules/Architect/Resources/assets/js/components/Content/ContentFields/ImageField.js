import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';

/*

Values format :

{
  id : 3,
  type : CustomFieldTypes.IMAGE.value,
  name : "Imatge",
  identifier : "image_1",
  settings : {
    type : "thumb",
    name : "Thumbnail",
    width : 500,
    height : 500,
    ratio : "1:1"
  },
  values : {
    url : ASSETS+"modules/architect/images/default.jpg"
  }
}

*/
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
  
  getImageFormat(format)
  {
      var _format = null;
      
      if(IMAGES_FORMATS) {
          IMAGES_FORMATS.map(function(f){
              if(f.name == format) {
                  _format = f;
              }
          });
      }
      
      return _format;
  }
  
  renderInputs() {

    var defined = false;
    var values = {};

    if(this.props.field.values !== undefined){
      defined = true;
      values = this.props.field.values;
    }
    
    var format = this.props.field.settings.cropsAllowed ? this.getImageFormat(this.props.field.settings.cropsAllowed) : null;
    var url = values.urls !== undefined && values.urls[format.name] !== undefined ? values.urls[format.name] : null;
    
    return (
      <div className="form-group bmd-form-group image-field-container">
         <div className="image-field">
            {url && 
            <div className="image" style={{backgroundImage:"url(/"+ url +")"}} ></div>
            }
            
            {(!defined || values.url == "" ) &&
              <div className="add-button">
                <a href="#" className="btn btn-default" onClick={this.onImageSelect}><i className="fa fa-plus-circle"></i>  Seleccionar</a>
              </div>
            }
         </div>

          {defined && values.url != "" &&
            <div className="image-buttons">
              {/*<a href="" className="btn btn-link"><i className="fa fa-pencil"></i> Editar</a>*/}
               <a href="" className="btn btn-link text-danger" onClick={this.cancelImage}><i className="fa fa-times"></i> Cancel·lar</a>
            </div>
           }

         <p className="field-help"> <b>{format.name}</b> : Mides {format.width}x{format.height} ( Ratio {format.ratio} )</p>
    
      </div>
    );

  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+ FIELDS.IMAGE.icon }></i> {FIELDS.IMAGE.name}
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
