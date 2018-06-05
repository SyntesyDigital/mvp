import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './ContentFields/TextField';
import RichTextField from './ContentFields/RichTextField';
import ImageField from './ContentFields/ImageField';
import DateField from './ContentFields/DateField';
import ImagesField from './ContentFields/ImagesField';
import ListField from './ContentFields/ListField';
import ContentsField from './ContentFields/ContentsField';

import CustomFieldTypes from './../common/CustomFieldTypes';

class ContentFields extends Component {

  constructor(props){
    super(props);

    this.state = {

    };

  }

  renderFields() {

    var fields = [];
    
    for(var i=0;i<this.props.fields.length;i++){
      var item = this.props.fields[i];
            
      if(item.type == "text"){
        fields.push(
          <TextField
            field={item}
            translations={this.props.translations}
            key={i}
            onFieldChange={this.props.onFieldChange}
          />
        );
      }
      else if(item.type == "richtext"){
        fields.push(
          <RichTextField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
          />
        );
      }
      else if(item.type == "image"){
        fields.push(
          <ImageField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
              onImageSelect={this.props.onImageSelect}
          />
        );
      }
      else if(item.type == "date"){
        fields.push(
          <DateField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
              onImageSelect={this.props.onImageSelect}
          />
        );
      }
      else if(item.type == "images"){
        fields.push(
          <ImagesField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
              onImageSelect={this.props.onImageSelect}
          />
        );
      }
      else if(item.type == "list"){
        fields.push(
          <ListField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
          />
        );
      }
      else if(item.type == "contents"){
        fields.push(
          <ContentsField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
              onContentSelect={this.props.onContentSelect}
          />
        );
      }
    }

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
