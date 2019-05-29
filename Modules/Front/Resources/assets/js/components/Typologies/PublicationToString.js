import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


export default class PublicationSummary extends Component {

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

    renderLanguages(inputs) {
      var result=[];
      for(var key in inputs){
        result.push(
          <li key={key}>
            {key+" ("+inputs[key]+")"}
          </li>
        );
      }
      return result;
    }

    render() {

      const fields = this.props.field.fields;
      const title = this.processText(fields,'title');
      const format = this.processText(fields,'format');
      const type = this.processText(fields,'tipus');
      const pageNum = this.processText(fields,'num-pagines');
      const lastEdition = this.processText(fields,'ultima-edicio');
      const description = this.processText(fields,'descripcio');
      const languages = this.processText(fields,'idiomes');
      const price = this.processText(fields,'preu');

      const inputs = this.props.field.inputs !== undefined ? this.props.field.inputs : null;

      console.log("PublicationSummary => ",this.props.field);


      return (
        <div className="publication summary-item">
            <ul>
              <li className="title">
                {title}
              </li>
              {inputs != null &&
                this.renderLanguages(inputs)
              }
            </ul>
        </div>
      );

    }
}
