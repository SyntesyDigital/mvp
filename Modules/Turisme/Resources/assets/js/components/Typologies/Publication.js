import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class Publication extends Component {

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

      console.log("Publication => ",fields);

      const title = this.processText(fields,'title');
      const format = this.processText(fields,'format');
      const type = this.processText(fields,'tipus');
      const pageNum = this.processText(fields,'num-pagines');
      const lastEdition = this.processText(fields,'ultima-edicio');
      const description = this.processText(fields,'descripcio');
      const languages = this.processText(fields,'idiomes');
      const price = this.processText(fields,'preu');

      return (
        <div className="publication">
          <p className="titol">{title}</p>
          <ul className="detalls">
            <li>Tipus: {type}</li>
            <li>Num Pàgines: {pageNum}</li>
            <li>Format: {format}</li>
            <li>Idiomes: {languages}</li>
            <li>Ultima edició: {lastEdition}</li>
            <li>Preu: {price}</li>
          </ul>
          <ul className="opcions app">
            <li>
              <TranslatedFileField
                field={fields.descargable}
              />
            </li>
          </ul>
        </div>
      );

    }
}
export default Publication;
