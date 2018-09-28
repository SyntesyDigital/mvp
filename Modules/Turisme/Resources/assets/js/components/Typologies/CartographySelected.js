import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class CartographySelected extends Component {

    constructor(props)
    {
        super(props);

        var inputs = {
          size : 'a3',
          format : 'jpg',
          resolution : '72'
        };

        if(this.props.field.inputs !== undefined){
          inputs = this.props.field.inputs;
        }

        this.props.inputs

        this.state = {
          inputs : inputs
        };

        this.onChange = this.onChange.bind(this);
    }

    componentDidMount() {

    }

    processText(fields,fieldName){
      return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
        fields[fieldName].values[LOCALE] : '' ;
    }

    onChange(event){

      const {inputs} = this.state;

      inputs[event.target.name] = event.target.value;

      this.setState({
        inputs : inputs
      });

      this.props.onItemChange(inputs,this.props.field.id);
    }

    render() {

      const fields = this.props.field.fields;
      const inputs = this.state.inputs;

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
                <label htmlFor="Autor">Mides</label>
                <select name="size" id="select" onChange={this.onChange} value={inputs.size}>
                  <option value="a3">A3 (42 x 29,7 cm)</option>
                  <option value="a2">A2 (29,7 x 21 cm)</option>
                </select>
              </li>

              <li className="list-forms">
                <label htmlFor="Format">Format</label>
                <select name="format" id="select2" onChange={this.onChange} value={inputs.format}>
                  <option value="jpg">JPG</option>
                  <option value="png">PNG</option>
                  <option value="pdf">PDF</option>
                </select>
              </li>

              <li className="list-forms">
                <label htmlFor="Ressolucio">Ressolució</label>
                <select name="resolution" id="select3" onChange={this.onChange} value={inputs.resolution}>
                  <option value="72">72 dpi</option>
                  <option value="150">150 dpi</option>
                  <option value="300">300 dpi</option>
                </select>
              </li>
            </ul>

            <button type="button" className="btn" onClick={this.props.onRemove.bind(this,this.props.field)}>{window.localization['GENERAL_WIDGET_REMOVE']}</button>
        </div>
      );

    }
}
export default CartographySelected;
