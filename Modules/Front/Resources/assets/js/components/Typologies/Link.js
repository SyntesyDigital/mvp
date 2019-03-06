import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import UrlField from './../Fields/UrlField';

class Link extends Component {

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

      //console.log("Link => ",fields);

      const title = this.processText(fields,'title');

      //console.log("Link : title => ",title);

      return (
        <div className="link">
          <UrlField field={fields.enllac} target="_blank">{title}</UrlField>
        </div>
      );

    }
}
export default Link;
