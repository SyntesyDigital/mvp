import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './ContentFields/TextField';
import RichTextField from './ContentFields/RichTextField';

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

      if(item.type == CustomFieldTypes.TEXT){
        fields.push(
          <TextField
            field={item}
            translations={this.props.translations}
            key={i}
            onFieldChange={this.props.onFieldChange}
          />
        );
      }
      else if(item.type == CustomFieldTypes.RICH){
        fields.push(
          <RichTextField
              field={item}
              translations={this.props.translations}
              key={i}
              onFieldChange={this.props.onFieldChange}
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
