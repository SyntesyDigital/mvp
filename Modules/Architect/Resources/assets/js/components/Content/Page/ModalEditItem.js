import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './../ContentFields/TextField';
import RichTextField from './../ContentFields/RichTextField';
import ImageField from './../ContentFields/ImageField';
import DateField from './../ContentFields/DateField';
import ImagesField from './../ContentFields/ImagesField';
import ListField from './../ContentFields/ListField';
import ContentsField from './../ContentFields/ContentsField';
import BooleanField from './../ContentFields/BooleanField';
import LinkField from './../ContentFields/LinkField';
import VideoField from './../ContentFields/VideoField';
import LocalizationField from './../ContentFields/LocalizationField';

import TitleImageWidget from './../Widgets/TitleImageWidget';

import InputSettingsField from './../../Typology/Settings/InputSettingsField';
import RadioSettingsField from './../../Typology/Settings/RadioSettingsField';
import CheckboxesSettingsField from './../../Typology/Settings/CheckboxesSettingsField';

class ModalEditItem extends Component {

  constructor(props){
    super(props);

    // console.log(" ModalEditItem :: construct ",props);

    this.state = {
      field : null
    };

    this.onModalClose = this.onModalClose.bind(this);
  }

  processProps(props) {

    var field = JSON.parse(JSON.stringify(props.item.data.field));
    field.identifier = "temp_"+JSON.stringify(props.item.pathToIndex);
    field.value = props.item.data.field !== undefined &&
      props.item.data.field.value !== undefined ? props.item.data.field.value : null;

    //
    // console.log("ModalEditItem :: field after process : ",field);

    return field;
  }

  componentDidMount() {

    if(this.props.display){
        this.modalOpen();
    }

  }

  componentWillReceiveProps(nextProps)
  {

    // console.log(" ModalEditItem :: componentWillReceiveProps ",nextProps);

    var field = null;

    if(nextProps.display){
        this.modalOpen();
        field = this.processProps(nextProps);

    } else {
        this.modalClose();
    }

     //console.log("ModalEditItem :: componentWillReceiveProps :: =>",field);

    this.setState({
      field : field
    });

  }

  onModalClose(e){
      e.preventDefault();
      this.props.onItemCancel();
  }

  modalOpen()
  {
    TweenMax.to($("#modal-edit-item"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
  }

  modalClose() {

    var self =this;
      TweenMax.to($("#modal-edit-item"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
        /*
        self.setState({
          field : null
        });
        */
      }});
  }

  onFieldChange(field) {

    //console.log("ModalEditItem :: onFieldChange => ",field);

    var stateField = this.state.field;
    stateField.value = field.value;
    this.setState({
        field : stateField
    });

  }

  onSubmit(e) {
    e.preventDefault();

    const field = this.state.field;

    this.props.onSubmitData(field);

    /*
    this.setState({
      field : null
    });
    */
  }

  renderField() {

    switch(this.state.field.type ) {
      case FIELDS.TEXT.type:
        return (
          <TextField
            //errors={_this.props.errors[k]}
            field={this.state.field}
            hideTab={true}
            translations={this.props.translations}
            onFieldChange={this.onFieldChange.bind(this)}

          />
        );
      case FIELDS.RICHTEXT.type:
        return (
          <RichTextField
            //errors={_this.props.errors[k]}
            field={this.state.field}
            hideTab={true}
            translations={this.props.translations}
            onFieldChange={this.onFieldChange.bind(this)}

          />
        );
        case FIELDS.IMAGE.type:
          return (
            <ImageField
                //errors={_this.props.errors[k]}
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onImageSelect={this.props.onImageSelect}
                onFieldChange={this.onFieldChange.bind(this)}
            />
          );
        case FIELDS.DATE.type:
          return (
            <DateField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
            />
          );
        case FIELDS.IMAGES.type:
          return (
            <ImagesField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
                onImageSelect={this.props.onImageSelect}
            />
          );
        case FIELDS.CONTENTS.type:
          return (
            <ContentsField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
                onContentSelect={this.props.onContentSelect}
            />
          );
        case FIELDS.BOOLEAN.type:
          return (
            <BooleanField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
            />
          );
        case FIELDS.LINK.type:
          return (
            <LinkField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
                onContentSelect={this.props.onContentSelect}
            />
          );
        case FIELDS.VIDEO.type:
          return (
            <VideoField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
            />
          );
        case FIELDS.LOCALIZATION.type:
          return (
            <LocalizationField
                field={this.state.field}
                hideTab={true}
                translations={this.props.translations}
                onFieldChange={this.onFieldChange.bind(this)}
            />
          );
        case "widget":
          return (
            <TitleImageWidget
              field={this.state.field}
              hideTab={true}
              translations={this.props.translations}
              onFieldChange={this.onFieldChange.bind(this)}
              onContentSelect={this.props.onContentSelect}
              onImageSelect={this.props.onImageSelect}
            />
          );

      default :
        return null;
    }
  }

  handleFieldSettingsChange(field) {

      console.log("ModalEditItem :: handleFieldSettingsChange => ", field);

      const stateField = this.state.field;

      stateField[field.source][field.name] = field.value;

      this.setState({
          field : stateField
      });
  }

  getCropsformats() {
      var formats = [];
      IMAGES_FORMATS.map(function(format, k){
          formats.push({
              name : format.name,
              value : format.name
          });
      });

      return formats;
  }

  renderSettings() {

    console.log("renderSettings!",this.state.field);

    return (
      <div>

        <h6>Configuració</h6>

        <InputSettingsField
          field={this.state.field}
          name="htmlId"
          source="settings"
          onFieldChange={this.handleFieldSettingsChange.bind(this)}
          label="Html ID"
          inputLabel="Indica el Id html del camp"
        />

        <InputSettingsField
          field={this.state.field}
          name="htmlClass"
          source="settings"
          onFieldChange={this.handleFieldSettingsChange.bind(this)}
          label="Html Class"
          inputLabel="Indica la clase CSS personalitzada"
        />

        <RadioSettingsField
          field={this.state.field}
          name="cropsAllowed"
          source="settings"
          onFieldChange={this.handleFieldSettingsChange.bind(this)}
          label="Mides permeses"
          options={this.getCropsformats()}
        />

        <CheckboxesSettingsField
          field={this.state.field}
          name="typologiesAllowed"
          source="settings"
          onFieldChange={this.handleFieldSettingsChange.bind(this)}
          label="Tipologies permeses"
          options={TYPOLOGIES}
        />

      </div>


    );


  }

  render() {

    return (
      <div className="custom-modal" id="modal-edit-item" style={{zIndex:this.props.zIndex}}>
        <div className="modal-background"></div>


          <div className="modal-container">

            {this.state.field != null &&
              <div className="modal-header">

                  <i className={"fa "+this.state.field.icon}></i>
                  <h2>{this.state.field.name} | Edició</h2>

                <div className="modal-buttons">
                  <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                    <i className="fa fa-times"></i>
                  </a>
                </div>
              </div>
            }

            <div className="modal-content">
              <div className="container">
                <div className="row">
                  <div className="col-xs-8 field-col">

                    {this.state.field != null &&
                      this.renderField()}

                  </div>
                  <div className="col-xs-4 settings-col">
                    {this.renderSettings()}
                  </div>
                </div>
              </div>

              <div className="modal-footer">
                <a href="" className="btn btn-default" onClick={this.onModalClose}> Cancel·lar </a> &nbsp;
                <a href="" className="btn btn-primary" onClick={this.onSubmit.bind(this)}> Acceptar </a> &nbsp;
              </div>

            </div>
        </div>
      </div>
    );
  }

}
export default ModalEditItem;
