import React, { Component } from 'react';
import ReactDOM from 'react-dom';


class TranslatedFileField extends Component {

    constructor(props)
    {
        super(props);
    }

    render() {

      const field = this.props.field;
      var url = '';

      console.log("TranslatedFileField => ",field);

      if(field.values != null && field.values !== undefined && field.values != null
        && field.values[LOCALE] !== undefined && field.values[LOCALE] != null){
        if(field.values[LOCALE].urls['files'] !== undefined){
          url = ASSETS+field.values[LOCALE].urls['files'];
        }
      }

      return (
        <a href={url} target="_blank">
          {Lang.get('widgets.download_pdf')}
        </a>
      );

    }
}
export default TranslatedFileField;
