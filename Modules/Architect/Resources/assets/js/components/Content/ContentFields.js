import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './ContentFields/TextField';
import RichTextField from './ContentFields/RichTextField';
import ImageField from './ContentFields/ImageField';
import DateField from './ContentFields/DateField';
import ImagesField from './ContentFields/ImagesField';
import ListField from './ContentFields/ListField';
import ContentsField from './ContentFields/ContentsField';
import BooleanField from './ContentFields/BooleanField';
import LinkField from './ContentFields/LinkField';
import VideoField from './ContentFields/VideoField';
import LocalizationField from './ContentFields/LocalizationField';

class ContentFields extends Component {

  constructor(props){
    super(props);

    this.state = {
        fields : [],
        errors : this.props.errors
    };
  }

  renderFields() {
    var fields = [];
    var _this = this;

    Object.keys(_this.props.fields).map(function(k){
        switch(_this.props.fields[k].type) {
            case FIELDS.TEXT.type:
                fields.push(
                  <TextField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                  />
                );
            break;

            case FIELDS.RICHTEXT.type:
                fields.push(
                <RichTextField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                />
                );
            break;

            case FIELDS.IMAGE.type:
                fields.push(
                <ImageField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                    onImageSelect={_this.props.onImageSelect}
                />
                );
            break;

            case FIELDS.DATE.type:
                fields.push(
                <DateField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                />
                );
            break;

            case FIELDS.IMAGES.type:
                fields.push(
                <ImagesField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                    onImageSelect={_this.props.onImageSelect}
                />
                );
            break;

            case FIELDS.CONTENTS.type:
                fields.push(
                <ContentsField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                    onContentSelect={_this.props.onContentSelect}
                />
                );
            break;

            case FIELDS.BOOLEAN.type:
                fields.push(
                <BooleanField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                />
                );
            break;


            case FIELDS.LINK.type:
                fields.push(
                <LinkField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                />
                );
            break;

            case FIELDS.VIDEO.type:
                fields.push(
                <VideoField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
                />
                );
            break;

            case FIELDS.LOCALIZATION.type:
                fields.push(
                <LocalizationField
                    errors={_this.props.errors[k]}
                    field={_this.props.fields[k]}
                    translations={_this.props.translations}
                    key={k}
                    onFieldChange={_this.props.onFieldChange}
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
export default ContentFields;
