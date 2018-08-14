import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class PublicationSelected extends Component {

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
            <p className="media"><img src="images/img-medium.png" alt=""/></p>
            <p className="expand"><a href=""><img src="images/expand.png" alt=""/></a></p>
            <p className="titol">{title}</p>
            <ul className="detalls">
              <li className="list-forms">
                <label htmlFor="Catala">Català</label>
                <select name="Catala" id="Catala">
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </li>
              <li className="list-forms">
                <label className="Espanol">Español</label>
                <select name="Espanol" id="Espanol">
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </li>
              <li className="list-forms">
                <label className="English">English</label>
                <select name="English" id="English">
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </li>
              <li className="list-forms empty">
                <label className="Francais">Français</label>
                <select name="Francais" id="select5">
                  <option>0</option>
                </select>
              </li>
            </ul>
            <button type="button" className="btn" onClick={this.props.onRemove.bind(this,this.props.field)}>{Lang.get('widgets.remove')}</button>
        </div>
      );

    }
}
export default PublicationSelected;
