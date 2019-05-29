import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';

export default class LogosSummary extends Component {

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
      const description = this.processText(fields,'description');

      console.log("LogosSummary => ",this.props.field);

      return (
        <div className="logos summary-item">
            <ul>
              <li className="media">
                {fields.image &&
                <ImageField
                  field={fields.image}
                />
                }
              </li>
              <li className="title">
                {title}
              </li>

            </ul>
        </div>
      );

    }
}
