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
    this.state = props.field;
    
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

    Object.keys(_this.state.fields).map(function(k){
        if(field.identifier == _this.state.fields[k].identifier) {
            _this.state.fields[k].value = field.value;
        }
    });

    
    this.props.onFieldChange(field);
    
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

    Object.keys(_this.state.fields).map(function(k){

        switch(_this.state.fields[k].type) {
            case FIELDS.TEXT.type:
                fields.push(
                  <TextField
                    field={_this.state.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange.bind(this)}
                  />
                );
            break;
        
            case FIELDS.SLUG.type:
                fields.push(
                  <SlugField
                    field={_this.state.fields[k]}
                    translations={_this.props.translations}
                    sourceField={_this.entryTitleKey != null ? _this.state.fields[_this.entryTitleKey] : null}
                    blocked={_this.props.saved}
                    key={k}
                    onFieldChange={_this.onFieldChange.bind(this)}
                  />
                );
            break;
        
            case FIELDS.RICHTEXT.type:
                fields.push(
                <RichTextField
                    field={_this.state.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;
        
            case FIELDS.IMAGE.type:
                fields.push(
                <ImageField
                    field={_this.state.fields[k]}
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
                    field={_this.state.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;
        
            case FIELDS.IMAGES.type:
                fields.push(
                <ImagesField
                    field={_this.state.fields[k]}
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
                    field={_this.state.fields[k]}
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
                    field={_this.state.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;
        
        
            case FIELDS.LINK.type:
                fields.push(
                <LinkField
                    field={_this.state.fields[k]}
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
                    field={_this.state.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.onFieldChange}
                />
                );
            break;
        
            case FIELDS.URL.type:
                fields.push(
                  <UrlField
                    field={_this.state.fields[k]}
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
                    field={_this.state.fields[k]}
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
