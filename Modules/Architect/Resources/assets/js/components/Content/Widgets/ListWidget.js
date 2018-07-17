import React, {Component} from 'react';
import { render } from 'react-dom';
import update from 'immutability-helper'
import ItemListDragField from './ItemListDragField';

/**

[
  {
      title : {
        "ca" : "asdfasdfasdf",
        "es" : "sdfasdfsdf"
      },
      richtect : {
        "ca" : "sfasdfasdf",
        "es" : "asfasdfasdf"
      },
      url : {
        url :
        content :
      },

  }
]
*
*/
class ListWidget extends Component
{
  constructor(props)
  {

    console.log("ListWidget :: constructor");

    super(props);

    this.moveField = this.moveField.bind(this);

    this.state = {
      fields : []
    };

    this.currentIndex = props.field.value !== undefined && props.field.value != null ? props.field.value.length : 0;
  }

  moveField(dragIndex, hoverIndex) {

      const field = this.props.field;
      const dragField = field.value[dragIndex]

      var result = update(field, {
          value: {
              $splice: [
                  [dragIndex, 1],
                  [hoverIndex, 0, dragField]
              ],
          }
      });

      // console.log("\n\nResult value : ");
      // console.log(field.value);
      // console.log(result);

      this.props.onFieldChange({
          identifier: this.props.field.identifier,
          value: result.value
      });

  }

  handleEditField(fieldId) {

    const fields = this.props.field.value;

    console.log("ListWidget :: handleEditField => ",fieldId,fields);

    var field = null;
    var index = -1;

    for (var i = 0; i < fields.length; i++) {
        if (fieldId == fields[i].id) {
            field = fields[i];
            index = i;
            break;
        }
    }

    if(field == null){
      console.error("ListWidget :: Field not found with id : "+fieldId);
      return;
    }

    var editInfo = {
      identifier : this.props.field.identifier,
      field : field,
      index : index,
      type : 'list-item'
    };

    this.props.onListItemEdit(editInfo);

  }

  handleRemoveField(fieldId) {

      const fields = this.props.field.value;
      var index = -1;

      if(fields) {
          for (var i = 0; i < fields.length; i++) {
              if (fieldId == fields[i].id) {
                  index = i;
                  break;
              }
          }
      }

      if(index != -1){
        this.props.onRemoveField(index);
      }
      else {
        console.error("handleRemoveField field Id not found : "+fieldId);
      }
  }

  exploteToObject(fields) {

    if(fields == null){
      return null;
    }

    var result = {};

    for(var i=0;i<fields.length;i++){
      result[fields[i]] = null;
    }
    return result;
  }

  onAddField(event) {

    event.preventDefault();



    //FIXME to replace with text provided by widget configuration
    const widgetIdentifier = 'WIDGET_1';

    var field = JSON.parse(JSON.stringify(WIDGETS[widgetIdentifier]));
    field["index"] = this.currentIndex;
    field["id"] = this.currentIndex;

    this.currentIndex++;

    console.log("ListWidget :: onAddField with value => ",field);

    this.props.onAddField(field);

  }

  renderInputs() {
     var fields = [];
     var _this = this;

     console.log("ListWidget :: renderInputs => ",this.props.field);

     if(this.props.field.value !== undefined && this.props.field.value != null) {
         this.props.field.value.map(function(widget, i){

              console.log("ListWidget :: renderInputs =>",widget);

             fields.push(
                 <ItemListDragField
                    key = {widget.index}
                    index = {i}
                    id = {widget.index}
                    type = {widget.type}
                    label = {widget.name}
                    icon = {widget.icon}
                    name = {widget.title !== undefined && widget.title != null ? widget.title : ''}
                    moveField = {_this.moveField}
                    onEditField = {_this.handleEditField.bind(_this)}
                    onRemoveField = {_this.handleRemoveField.bind(_this)}
                />
             );
         });
     }

     return fields;
  }

  render() {

    return (
      <div className="field-item contents-field">

        <div>

          <div className="field-form fields-list-container">
            {this.renderInputs()}
          </div>

          <div className="add-content-button">
            <a href="" className="btn btn-default" onClick={this.onAddField.bind(this)}><i className="fa fa-plus-circle"></i> Afegir </a>
          </div>

        </div>

      </div>

    );
  }

}
export default ListWidget;
