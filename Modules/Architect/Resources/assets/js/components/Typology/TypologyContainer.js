import React, {Component} from 'react';
import { render } from 'react-dom';
import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';
import update from 'immutability-helper'

import CustomFieldTypes from './../common/CustomFieldTypes';
import TypologyDropZone from './TypologyDropZone';
import TypologySidebar from './TypologySidebar';
import TypologyDragField from './TypologyDragField';
import TypologyModal from './TypologyModal';
import TypologyBar from './TypologyBar';

import axios from 'axios';

class TypologyContainer extends Component {

  constructor(props) {
     super(props);

     this.state = {
         typology : null,
         inputs: {
             name: "",
             identifier: "",
             icon: "one",
             template: "",
             slugOn: false,
             slugCa: "",
             slugEs: "",
             slugEn: "",
             categories: false,
             tags: false,
         },
         fields: [],
         settingsField: null
     };

     this.handleInputChange = this.handleInputChange.bind(this);
     this.moveField = this.moveField.bind(this);
     this.handleRemoveField = this.handleRemoveField.bind(this);
     this.handleFieldChange = this.handleFieldChange.bind(this);
     this.handleFieldAdded = this.handleFieldAdded.bind(this);
     this.handleOpenSettings = this.handleOpenSettings.bind(this);
     this.handleModalClose = this.handleModalClose.bind(this);
     this.handleSettingsChanged = this.handleSettingsChanged.bind(this);
     this.handleSubmitForm = this.handleSubmitForm.bind(this);

 }

 handleInputChange(field) {

     const inputs = this.state.inputs;

     inputs[field.name] = field.value;

     this.setState({
         inputs: inputs
     });

 }

 handleFieldAdded(field) {

     const fields = this.state.fields;

     fields.push(field);

     this.setState({
         fields: fields
     });

 }

 moveField(dragIndex, hoverIndex) {
     const {
         fields
     } = this.state
     const dragField = fields[dragIndex]

     this.setState(
         update(this.state, {
             fields: {
                 $splice: [
                     [dragIndex, 1],
                     [hoverIndex, 0, dragField]
                 ],
             },
         }),
     )
 }

 handleRemoveField(fieldId) {

     const {
         fields
     } = this.state;

     for (var i = 0; i < fields.length; i++) {
         if (fieldId == fields[i].id) {
             fields.splice(i, 1);
             break;
         }
     }

     this.setState({
         fields: fields
     });

 }

 handleFieldChange(field) {
     const {
         fields
     } = this.state;

     for (var i = 0; i < fields.length; i++) {
         if (field.id == fields[i].id) {
             fields[i][field.name] = field.value;
             break;
         }
     }

     this.setState({
         fields: fields
     });



 }

 handleOpenSettings(fieldId) {

     const {
         fields
     } = this.state;

     for (var i = 0; i < fields.length; i++) {
         if (fieldId == fields[i].id) {
             this.setState({
                 settingsField: fields[i]
             });
         }
     }

     $("#settings-modal").css({
         display: "block"
     });
     TweenMax.to($("#settings-modal"), 0.5, {
         opacity: 1,
         ease: Power2.easeInOut
     });

 }


 handleSettingsChanged(field) {

     //console.log("TypologyContainer :: handleSettingsChanged");
     //console.log(field);

     const settingsField = this.state.settingsField;

     settingsField.settings[field.name] = field.value;

     //console.log(settingsField);

     this.setState({
         settingsField: settingsField
     });

 }

 handleModalClose(e) {

     e.preventDefault();

     const {
         fields
     } = this.state;
     const settingsField = this.state.settingsField;

     for (var i = 0; i < fields.length; i++) {
         if (settingsField.id == fields[i].id) {
             fields[i] = settingsField;
             break;
         }
     }

     var self = this;

     TweenMax.to($("#settings-modal"), 0.5, {
         display: "none",
         opacity: 0,
         ease: Power2.easeInOut,
         onComplete: function() {
             self.setState({
                 settingsField: null,
                 fields: fields
             })
         }
     });

 }

 handleSubmitForm(e) {

     e.preventDefault();

     if(this.state.typology) {
         this.update();
     } else {
         this.create();
     }
 }

 getFormData()
 {
     return {
         name : this.state.inputs.name,
         identifier : this.state.inputs.identifier,
         fields : this.state.fields
     };
 }

 create()
 {
     var _this = this;
     axios.post('/architect/typologies', this.getFormData())
         .then(response => {
             if(response.data.success) {
                 _this.onSaveSuccess(response.data);
             }
         });
 }

 update()
 {
     var _this = this;
     axios.put('/architect/typologies/' + this.state.typology.id + '/update', this.getFormData())
         .then(response => {
             if(response.data.success) {
                 _this.onSaveSuccess(response.data);
             }
         });
 }

 onSaveSuccess(response)
 {
     this.setState({
         'typology' : response.typology
     })
 }

  render() {
    return (
      <div>

      <TypologyBar
        icon={this.state.inputs.icon}
        name={this.state.inputs.name}
        onSubmitForm={this.handleSubmitForm}
      />

      <DragDropContextProvider backend={HTML5Backend}>

        <div className="container rightbar-page">

          <TypologyModal
            field={this.state.settingsField}
            id="settings-modal"
            onModalClose={this.handleModalClose}
            onSettingsFieldChange={this.handleSettingsChanged}
          />

            <div className="col-md-9 page-content">
              <TypologyDropZone
                fields={this.state.fields}
                onFieldAdded={this.handleFieldAdded}
                onFieldChanged={this.handleFieldChange}
                moveField={this.moveField}
                onRemoveField={this.handleRemoveField}
                onSettingsFieldChange={this.handleSettingsChanged}
                onOpenSettings={this.handleOpenSettings}
              />
            </div>

            <TypologySidebar
              fields={this.state.inputs}
              onFieldChange={this.handleInputChange}
            >

              <TypologyDragField type={CustomFieldTypes.TEXT} label="Text" icon="fa-font" />
              <TypologyDragField type={CustomFieldTypes.RICH} label="Text enriquit" icon="fa-align-left" />
              <TypologyDragField type={CustomFieldTypes.IMAGE} label="Imatge" icon="fa-picture-o" />
              <TypologyDragField type={CustomFieldTypes.DATE} label="Data" icon="fa-calendar" />
              <TypologyDragField type={CustomFieldTypes.MAP} label="Localització" icon="fa-map-marker" />
              <TypologyDragField type={CustomFieldTypes.IMAGES} label="Images" icon="fa-th-large" />
              <TypologyDragField type={CustomFieldTypes.CONTENTS} label="Continguts" icon="fa-file-o" />
              <TypologyDragField type={CustomFieldTypes.LIST} label="Llista" icon="fa-th-list" />
              <TypologyDragField type={CustomFieldTypes.BOOLEAN} label="Booleà" icon="fa-check-square-o" />
              <TypologyDragField type={CustomFieldTypes.LINK} label="Enllaç" icon="fa-link" />
              <TypologyDragField type={CustomFieldTypes.VIDEO} label="Video" icon="fa-video-camera" />

            </TypologySidebar>

        </div>
      </DragDropContextProvider>

      </div>
    );
  }

}
export default TypologyContainer;
