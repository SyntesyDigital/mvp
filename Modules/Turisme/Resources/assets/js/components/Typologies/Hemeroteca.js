import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class Hemeroteca extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount() {

    }

    processText(fields,fieldName){
      return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
        fields[fieldName].values[LOCALE] : '' ;
    }

    render() {

      const fields = this.props.field.fields;

      const title = this.processText(fields,'title');
      const format = this.processText(fields,'format');
      const name = this.processText(fields,'name');
      const author = this.processText(fields,'author');
      const language = this.processText(fields,'language');

      var data = fields.data.values != null ? fields.data.values : null;
      if(data != null){
        data = moment(data).format('L');
      }

      console.log("Hemeroteca => ",fields);

      return (
        <div className="hemeroteca">
          <p className="titol">{title}</p>
          <ul className="detalls">
            <li>window.localization['HEMEROTECA_WIDGET_NOM']: {name}</li>
            <li>window.localization['HEMEROTECA_WIDGET_FORMAT']: {format}</li>
            <li>window.localization['HEMEROTECA_WIDGET_AUTOR']: {author}</li>
            <li>window.localization['HEMEROTECA_WIDGET_LANGUAGES']: {language}</li>
          </ul>
          <ul className="opcions app">
            <li>
              <TranslatedFileField
                field={fields.pdf}
              />
            </li>
          </ul>
        </div>
      );

    }
}
export default Hemeroteca;
