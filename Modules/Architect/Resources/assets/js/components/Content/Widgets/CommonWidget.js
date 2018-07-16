import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './../ContentFields/TextField';
import SlugField from './../ContentFields/SlugField';
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
import UrlField from './../ContentFields/UrlField';

class CommonWidget extends Component
{
  constructor(props)
  {
    super(props);
    this.state = {
      field : props.field
    };

    console.log(props.field);

    this.onFieldChange = this.onFieldChange.bind(this);
  }

  getStateFromProms(props) {

    const state = this.state;

    // var titleValue = {};
    // var richtextValue = {};
    // var urlValue = {};
    // var imageValue = null;
    // var settings = null;
    //
    // if(props.field.value !== undefined && props.field.value != null){
    //
    //   settings = props.field.settings;
    //
    //   if(props.field.value.title !== undefined && props.field.value.title != null){
    //     titleValue = props.field.value.title;
    //   }
    //
    //   if(props.field.value.richtext !== undefined && props.field.value.richtext != null){
    //     richtextValue = props.field.value.richtext;
    //   }
    //
    //   //field value.value url came with url or content depending on type
    //   if(props.field.value.url !== undefined && props.field.value.url != null){
    //     urlValue = props.field.value.url;
    //   }
    //
    //   if(props.field.value.image !== undefined && props.field.value.image != null){
    //     imageValue = props.field.value.image;
    //   }
    // }
    //
    // state["title"].value = titleValue;
    // state["richtext"].value = richtextValue;
    // state["url"].value = urlValue;
    // state["image"].value = imageValue;
    // state["image"].settings = settings;

    return state;

  }

  componentDidMount() {
    this.setState(this.getStateFromProms(this.props));
  }

  componentWillReceiveProps(nextProps){
    this.setState(this.getStateFromProms(nextProps));
  }

  onFieldChange(field) {
    var _this = this;

    const stateField = _this.state.field;

    Object.keys(stateField.fields).map(function(k){
        if(field.identifier == stateField.fields[k].identifier) {
            stateField.fields[k].value = field.value;
        }
    });


    this.props.onWidgetChange(stateField);

    //
    // const value = this.props.field.value !== undefined && this.props.field.value != null ? this.props.field.value : {};
    // value[field.identifier] = field.value;
    //
    // var field = {
    //   identifier : this.props.field.identifier,
    //   value : value
    // };
    //
    // //propagate the state to its parent
    // this.props.onFieldChange(field);
  }

  renderFields() {
    var fields = [];
    var _this = this;

    const stateFields = _this.state.field.fields;

    Object.keys(stateFields).map(function(k){

        switch(stateFields[k].type) {
            case FIELDS.TEXT.type:
                fields.push(
                  <TextField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange.bind(this)}
                  />
                );
            break;

            case FIELDS.SLUG.type:
                fields.push(
                  <SlugField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    sourceField={_this.entryTitleKey != null ? stateFields[_this.entryTitleKey] : null}
                    blocked={_this.props.saved}
                    key={k}
                    onFieldChange={_this.onFieldChange.bind(this)}
                  />
                );
            break;

            case FIELDS.RICHTEXT.type:
                fields.push(
                <RichTextField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;

            case FIELDS.IMAGE.type:
                fields.push(
                <ImageField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                    onImageSelect={_this.props.onImageSelect}
                />
                );
            break;

            case FIELDS.DATE.type:
                fields.push(
                <DateField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;

            case FIELDS.IMAGES.type:
                fields.push(
                <ImagesField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                    onImageSelect={_this.props.onImageSelect}
                />
                );
            break;

            case FIELDS.CONTENTS.type:
                fields.push(
                <ContentsField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                    onContentSelect={_this.props.onContentSelect}
                />
                );
            break;

            case FIELDS.BOOLEAN.type:
                fields.push(
                <BooleanField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;


            case FIELDS.LINK.type:
                fields.push(
                <LinkField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                    onContentSelect={_this.props.onContentSelect}
                />
                );
            break;

            case FIELDS.VIDEO.type:
                fields.push(
                <VideoField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;

            case FIELDS.URL.type:
                fields.push(
                  <UrlField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                    onContentSelect={_this.props.onContentSelect}
                  />
                );
            break;

            case FIELDS.LOCALIZATION.type:
                fields.push(
                <LocalizationField
                    field={stateFields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;
        }
    });

    return fields;
  }

  render() {

    const hideTab = this.props.hideTab !== undefined && this.props.hideTab == true ? true : false;

    return (
      <div className="widget-item">
          {this.renderFields()}
      </div>
    );
  }

}
export default CommonWidget;
