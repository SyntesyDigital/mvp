import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class Cartography extends Component {

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

      const selectable = this.props.selectable !== undefined ? this.props.selectable : false;
      const selected = this.props.selected !== undefined ? this.props.selected : false;

      console.log("Cartography => ",fields,selected);

      return (

        <div className="cartography banc-media list-items  buttons">
          <p className="media">
            {fields.imatge &&
              <ImageField
                field={fields.imatge}
              />
            }
          </p>
          <p className="expand"><a href=""><img src={ASSETS+"images/expand.png"} alt=""/></a></p>
          <p className="titol">{title}</p>

          {selectable &&
            <button type="button" className={"btn "+(selected ? 'selected' : '')} onClick={this.props.onSelect.bind(this,this.props.field)}>{Lang.get('widgets.select')}</button>
          }

        </div>
      );

    }
}
export default Cartography;
