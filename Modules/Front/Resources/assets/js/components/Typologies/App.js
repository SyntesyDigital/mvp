import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';
import UrlField from './../Fields/UrlField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class App extends Component {

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
      console.log("App => ",this.props.field);

      const title = this.processText(fields,'title');
      const description = this.processText(fields,'description');
      const languages = this.processText(fields,'languages');

      return (
        <div className="app">
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
          <div className="intro"
            dangerouslySetInnerHTML={{__html: description}}
          >
          </div>
          <p className="text">
            {languages}
          </p>
          <UrlField
            field={fields.apple}
            target="_blank"
          >
            Descargar iOS
          </UrlField>
          <UrlField
            field={fields.android}
            target="_blank"
          >
            Descargar Android
          </UrlField>

        </div>
      );

    }
}
export default App;
