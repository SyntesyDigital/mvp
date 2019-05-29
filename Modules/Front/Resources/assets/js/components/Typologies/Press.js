import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';
import UrlField from './../Fields/UrlField';
import FileField from './../Fields/FileField';

class Press extends Component {

    constructor(props)
    {
        super(props);
        moment.locale(LOCALE);
    }

    componentDidMount() {

    }

    processText(fields,fieldName){
      return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
        fields[fieldName].values[LOCALE] : '' ;
    }

    render() {

      const fields = this.props.field.fields;
      console.log("Press => ",this.props.field);

      const title = this.processText(fields,'title');

      var data = fields.data.values != null ? fields.data.values : null;
      if(data != null){
        data = moment(data).format('L');
      }

      return (
        <div className="press">
          <p className="image">
            {fields.image &&
            <ImageField
              field={fields.image}
            />
            }
          </p>


          <p className="titol">
            {title}
          </p>
          {data != null &&
            <p className="text">
              {data}
            </p>
          }

          <p className="text">
            <FileField
              field={fields.catala}
              labelFieldName={true}
            />
            <FileField
              field={fields.espanol}
              labelFieldName={true}
            />
            <FileField
              field={fields.japanese}
              labelFieldName={true}
            />
            <FileField
              field={fields.english}
              labelFieldName={true}
            />
            <FileField
              field={fields.francais}
              labelFieldName={true}
            />
            <FileField
              field={fields.italian}
              labelFieldName={true}
            />
            <FileField
              field={fields.portuguese}
              labelFieldName={true}
            />
            <FileField
              field={fields.arabic}
              labelFieldName={true}
            />
            <FileField
              field={fields.czech}
              labelFieldName={true}
            />
            <FileField
              field={fields.german}
              labelFieldName={true}
            />
            <FileField
              field={fields.chinese}
              labelFieldName={true}
            />
            <FileField
              field={fields.russian}
              labelFieldName={true}
            />
            <FileField
              field={fields.polish}
              labelFieldName={true}
            />
          </p>


        </div>
      );

    }
}
export default Press;
