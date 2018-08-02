import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class Note extends Component {

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

      console.log("Note => ",fields);

      const title = this.processText(fields,'title');
      const description = this.processText(fields,'descripcio');

      return (
        <div className="publication">
          <p className="image">
            {fields.imatge &&
            <ImageField
              field={fields.imatge}
            />
            }
          </p>
          <p className="titol">{title}</p>
          <div className="intro"
            dangerouslySetInnerHTML={{__html: description}}
          >
          </div>
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
export default Note;
