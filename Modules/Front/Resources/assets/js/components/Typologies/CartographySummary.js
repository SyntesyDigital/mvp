import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


export default class CartographySummary extends Component {

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
      const inputs = this.props.field.inputs !== undefined ? this.props.field.inputs : null;

      console.log("CartographySummary => ",this.props.field);


      return (
        <div className="cartography summary-item">
            <ul>
              <li className="title">
                {title}
              </li>
              <li>
                {inputs != null && inputs.size}
              </li>
              <li>
                {inputs != null && inputs.format}
              </li>
              <li>
                {inputs != null && inputs.resolution}
              </li>
            </ul>
        </div>
      );

    }
}
