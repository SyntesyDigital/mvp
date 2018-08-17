import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class LogosSelected extends Component {

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

      return (
        <div className="logos banc-media list-items  buttons selected">
            <p className="image">
              {fields.image &&
              <ImageField
                field={fields.image}
              />
              }
            </p>
            <p className="titol">{title}</p>
            <div className="intro"
              dangerouslySetInnerHTML={{__html: description}}
            >
            </div>

            <button type="button" className="btn" onClick={this.props.onRemove.bind(this,this.props.field)}>{Lang.get('widgets.remove')}</button>

        </div>
      );

    }
}
export default LogosSelected;
