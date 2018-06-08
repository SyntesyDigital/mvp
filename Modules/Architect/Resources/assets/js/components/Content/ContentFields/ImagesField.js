import React, {Component} from 'react';
import { render } from 'react-dom';

import update from 'immutability-helper'

import CustomFieldTypes from './../../common/CustomFieldTypes';
import ImagesDragField from './ImagesDragField';

class ImagesField extends Component {

  constructor(props){
    super(props);

    this.handleOnChange = this.handleOnChange.bind(this);
    this.moveField = this.moveField.bind(this);
		this.handleRemoveField = this.handleRemoveField.bind(this);
    this.onImageSelect = this.onImageSelect.bind(this);
  }

  componentDidMount(){

    if(this.props.field.values === undefined || this.props.field.values == null){
      //setup values if not yet defined
      var newField = {
          identifier: this.props.field.identifier,
          values: []
      };

      this.props.onFieldChange(newField);
    }
  }

  moveField(dragIndex, hoverIndex) {

    const field = this.props.field;
		const dragField = field.values[dragIndex]

    var result = update(field,{
      values : {
        $splice: [[dragIndex, 1], [hoverIndex, 0, dragField]],
      }
    });


    console.log("\n\nResult values : ");
    console.log(field.values);
    console.log(result);

    var newField = {
      identifier : this.props.field.identifier,
      values : result.values
    };

    this.props.onFieldChange(newField);

	}

  handleOnChange(event) {

    var field = {
      identifier : this.props.field.identifier,
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

  handleRemoveField(fieldId) {

    const fields = this.props.field.values;

		for(var i=0;i<fields.length;i++){
			if(fieldId == fields[i].id ){
				fields.splice(i,1);
				break;
			}
		}

    var field = {
      identifier : this.props.field.identifier,
      values : fields
    };

    this.props.onFieldChange(field);

	}

  renderInputs() {

    if(this.props.field.values === undefined || this.props.field.values == null){
      return;
    }

    const images = this.props.field.values;

    return (
			images.map((item, i) => (

  					<ImagesDragField
  						key={item.id}
  						index={i}
  						id={item.id}
              url={item.url}
  						title={item.title}
  						moveField={this.moveField}
  						onRemoveField={this.handleRemoveField}
  					/>

				))
		);

  }


  render() {
    return (
      <div className="field-item contents-field images-field">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.IMAGES.icon}></i> {CustomFieldTypes.IMAGES.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>

            <div className="field-form fields-list-container images-form">
                {this.renderInputs()}
            </div>

            <div className="add-content-button">
               <a href="#" className="btn btn-default" onClick={this.onImageSelect}><i className="fa fa-plus-circle"></i>  Seleccionar</a>
            </div>

        </div>

      </div>
    );
  }

}
export default ImagesField;
