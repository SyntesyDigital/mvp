import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class PublicationSelected extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          inputs : {}
        };
    }

    componentDidMount() {

    }

    onChange(event){

      const {inputs} = this.state;

      inputs[event.target.name] = event.target.value;

      this.setState({
        inputs : inputs
      });

      this.props.onItemChange(inputs,this.props.field.id);
    }

    processText(fields,fieldName){
      return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
        fields[fieldName].values[LOCALE] : '' ;
    }

    renderOptions(max){

      if(max === undefined || max == null){
        max = 0;
      }
      else {
        max = parseInt(max);
      }

      var options = [];
      for(var i=0;i<=max;i++){
        options.push(
          <option key={i} value={i}>{i}</option>
        );
      }
      return options;
    }

    renderLanguages(){
      const fields = this.props.field.fields;

      console.log("PublicationSelected :: renderLanguages => ",fields);
      var result = [];

      if(fields.stock !== undefined && fields.stock.values !== undefined){

        for(var key in fields.stock.values){
          var item = fields.stock.values[key];
          result.push(
            <li key={key} className={"list-forms "+(item.value !== undefined && parseInt(item.value) != 0 ? '' : 'empty')}>
              <label htmlFor={item.identifier}>{item.name}</label>
              <select name={item.name} id={item.identifier} onChange={this.onChange.bind(this)} >
                {this.renderOptions(item.value)}
              </select>
            </li>
          );
        }
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


      console.log("PublicationSelected => ",fields);

      return (
        <div className="publication">
            <p className="image">
              {fields.image &&
              <ImageField
                field={fields.image}
              />
              }
            </p>
            <p className="media"><img src="images/img-medium.png" alt=""/></p>
            <p className="expand"><a href=""><img src="images/expand.png" alt=""/></a></p>
            <p className="titol">{title}</p>
            <ul className="detalls">
              {this.renderLanguages()}
            </ul>
            <button type="button" className="btn" onClick={this.props.onRemove.bind(this,this.props.field)}>{Lang.get('widgets.remove')}</button>
        </div>
      );

    }
}
export default PublicationSelected;
