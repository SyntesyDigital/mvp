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
    
    this.props.onFieldChange({
      identifier : this.props.field.identifier,
      language : language,
      value : event.target.value
    });
  }

  onImageSelect(event) {
    event.preventDefault();
    this.props.onImageSelect(this.props.field);
  }

  cancelImage(event) {
    event.preventDefault();
    this.props.onFieldChange({
      identifier : this.props.field.identifier,
      value : null
    });
  }
  
  getImageFormat(value)
  {
      var format = null;
      
      if(IMAGES_FORMATS) {
          IMAGES_FORMATS.map(function(f){
              if(f.name == value) {
                  format = f;
              }
          });
      }
      
      return format;
  }
  
  renderInputs() {
            
    var values = this.props.field.value ? this.props.field.value : {};
    var defined = this.props.field.value ? true : false;    
    
    var format = this.props.field.settings.cropsAllowed 
        ? this.getImageFormat(this.props.field.settings.cropsAllowed) 
        : null;
    
    var url = (values.urls !== undefined && format.name && values.urls[format.name] !== undefined)
        ? values.urls[format.name] 
        : null;
    
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

           {format &&
               <p className="field-help"> <b>{format.name}</b> : Mides {format.width}x{format.height} ( Ratio {format.ratio} )</p>
            }
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
