import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class Logos extends Component {

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

      const selectable = this.props.selectable !== undefined ? this.props.selectable : false;
      const selected = this.props.selected !== undefined ? this.props.selected : false;

      console.log("Logos => ",fields,selected);

      return (
        <div className="logos banc-media list-items  buttons">
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

          {selectable &&
            <button type="button" className={"btn "+(selected ? 'selected' : '')} onClick={this.props.onSelect.bind(this,this.props.field)}>{Lang.get('widgets.select')}</button>
          }

        </div>
      );

    }
}
export default Logos;
