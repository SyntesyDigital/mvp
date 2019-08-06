import React, {Component} from 'react';
import { render } from 'react-dom';
import {connect} from 'react-redux';

import TextField from './../ContentFields/TextField';
import SlugField from './../ContentFields/SlugField';
import RichTextField from './../ContentFields/RichTextField';
import ImageField from './../ContentFields/ImageField';
import FileField from './../ContentFields/FileField';
import TranslatedFileField from './../ContentFields/TranslatedFileField';
import DateField from './../ContentFields/DateField';
import ImagesField from './../ContentFields/ImagesField';
import ListField from './../ContentFields/ListField';
import ContentsField from './../ContentFields/ContentsField';
import BooleanField from './../ContentFields/BooleanField';
import LinkField from './../ContentFields/LinkField';
import VideoField from './../ContentFields/VideoField';
import LocalizationField from './../ContentFields/LocalizationField';
import UrlField from './../ContentFields/UrlField';
import KeyValuesField from './../ContentFields/KeyValuesField';

class ContentFields extends Component {

  constructor(props){
    super(props);

    this.entryTitleKey = this.getEntryTitleKey();
  }

  getEntryTitleKey() {
    for(var key in this.props.app.fields){
      if(this.props.app.fields[key].type == FIELDS.TEXT.type){
        if(this.props.app.fields[key].settings.entryTitle){
          return key;
        }
      }
    }

    return null;
  }

  renderFields() {
    var fields = [];
    var _this = this;

    console.log("fields => ",_this.props.app.fields);

    Object.keys(_this.props.app.fields).map(function(k){
        switch(_this.props.app.fields[k].type) {
            case FIELDS.TEXT.type:
                fields.push(
                  <TextField
                    field={_this.props.app.fields[k]}
                    key={k}
                  />
                );
            break;

            case FIELDS.SLUG.type:
                fields.push(
                  <SlugField
                    field={_this.props.app.fields[k]}
                    sourceField={_this.entryTitleKey != null ? _this.props.app.fields[_this.entryTitleKey] : null}
                    blocked={_this.props.app.saved}
                    key={k}
                  />
                );
            break;

            case FIELDS.RICHTEXT.type:
                fields.push(
                <RichTextField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.IMAGE.type:
                fields.push(
                <ImageField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.FILE.type:
                fields.push(
                <FileField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.TRANSLATED_FILE.type:
                fields.push(
                <TranslatedFileField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;



            case FIELDS.DATE.type:
                fields.push(
                <DateField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.IMAGES.type:
                fields.push(
                <ImagesField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.KEY_VALUES.type:
                fields.push(
                <KeyValuesField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.CONTENTS.type:
                fields.push(
                <ContentsField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.BOOLEAN.type:
                fields.push(
                <BooleanField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;


            case FIELDS.LINK.type:
                fields.push(
                <LinkField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.VIDEO.type:
                fields.push(
                <VideoField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;

            case FIELDS.URL.type:
                fields.push(
                  <UrlField
                    field={_this.props.app.fields[k]}
                    key={k}
                  />
                );
            break;

            case FIELDS.LOCALIZATION.type:
                fields.push(
                <LocalizationField
                    field={_this.props.app.fields[k]}
                    key={k}
                />
                );
            break;
        }
    });

    return fields;
  }


  render() {
    return (
      <div className="col-xs-9 page-content">
        <div className="field-group">
            {this.renderFields()}
        </div>
      </div>
    );
  }

}

const mapStateToProps = state => {
    return {
        app: state.app
    }
}

const mapDispatchToProps = dispatch => {
    return {}
}

export default connect(mapStateToProps, mapDispatchToProps)(ContentFields);
