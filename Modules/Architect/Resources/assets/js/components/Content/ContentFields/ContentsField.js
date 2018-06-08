import React, {Component} from 'react';
import { render } from 'react-dom';

import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';
import update from 'immutability-helper'

import CustomFieldTypes from './../../common/CustomFieldTypes';
import ContentsDragField from './ContentsDragField';

class ContentsField extends Component {

  constructor(props) {
     super(props);

     this.handleOnChange = this.handleOnChange.bind(this);
     this.moveField = this.moveField.bind(this);
     this.handleRemoveField = this.handleRemoveField.bind(this);
     this.onContentSelect = this.onContentSelect.bind(this);
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

     var result = update(field, {
         values: {
             $splice: [
                 [dragIndex, 1],
                 [hoverIndex, 0, dragField]
             ],
         }
     });


     // console.log("\n\nResult values : ");
     // console.log(field.values);
     // console.log(result);

     var newField = {
         identifier: this.props.field.identifier,
         values: result.values
     };

     this.props.onFieldChange(newField);

 }

 handleRemoveField(fieldId) {

     const fields = this.props.field.values;

     for (var i = 0; i < fields.length; i++) {
         if (fieldId == fields[i].id) {
             fields.splice(i, 1);
             break;
         }
     }

     var field = {
         identifier: this.props.field.identifier,
         values: fields
     };

     this.props.onFieldChange(field);

 }

 handleOnChange(event) {
     const language = $(event.target).closest('.form-control').attr('language');
     const values = this.props.field.values;
     values[language] = event.target.value;
     var field = {
         identifier: this.props.field.identifier,
         values: values
     };

     // console.log("textField :: handleOnChange ");
     // console.log(field);

     this.props.onFieldChange(field);
 }

 onContentSelect(event) {
     event.preventDefault();
     this.props.onContentSelect(this.props.field.identifier);
 }

 renderInputs() {

    if(this.props.field.values === undefined || this.props.field.values == null){
      return;
    }

     const fields = this.props.field.values;
     return (
         fields.map((item, i) => (
          <ContentsDragField
             key = {item.id}
             index = {i}
             id = {item.id}
             type = {item.type}
             label = {item.label}
             icon = {item.icon}
             name = {item.name}
             moveField = {this.moveField}
             onRemoveField = {this.handleRemoveField}  />
         ))
     );
 }


  render() {
    return (
      <div className="field-item contents-field">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+CustomFieldTypes.CONTENTS.icon}></i> {CustomFieldTypes.CONTENTS.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>


          <div className="field-form fields-list-container">

            {this.renderInputs()}

          </div>


          <div className="add-content-button">
            <a href="" className="btn btn-default" onClick={this.onContentSelect}><i className="fa fa-plus-circle"></i> Afegir </a>
          </div>

        </div>

      </div>
    );
  }

}
export default ContentsField;
