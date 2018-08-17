import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class CartographySelected extends Component {

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

      console.log("CartographySelected => ",fields);

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

            <ul className="detalls">

              <li className="list-forms">
                <label for="Autor">Mides</label>
                <select name="Autor" id="select">
                  <option>A3 (42 x 29,7 cm)</option>
                  <option>A2 (29,7 x 21 cm)</option>
                </select>
              </li>

              <li className="list-forms">
                <label for="Format">Format</label>
                <select name="Format" id="select2">
                  <option>JPG</option>
                  <option>PNG</option>
                  <option>PDF</option>
                </select>
              </li>

              <li className="list-forms">
                <label for="Ressolucio">Ressolució</label>
                <select name="Ressolucio" id="select3">
                  <option>72 dpi</option>
                  <option>150 dpi</option>
                  <option>300 dpi</option>
                </select>
              </li>
            </ul>

            <button type="button" className="btn" onClick={this.props.onRemove.bind(this,this.props.field)}>{Lang.get('widgets.remove')}</button>
        </div>
      );

    }
}
export default CartographySelected;
