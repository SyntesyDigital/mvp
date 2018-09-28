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


      const title = this.processText(fields,'title');
      const format = this.processText(fields,'format');
      const type = this.processText(fields,'tipus');
      const pageNum = this.processText(fields,'num-pagines');
      const lastEdition = this.processText(fields,'ultima-edicio');
      const description = this.processText(fields,'descripcio');
      const languages = this.processText(fields,'idiomes');
      const price = this.processText(fields,'preu');

      const selectable = this.props.selectable !== undefined ? this.props.selectable : false;
      const selected = this.props.selected !== undefined ? this.props.selected : false;

      console.log("Publication => ",fields,selected);

      return (
        <div className="publication">
          <p className="image">
            {fields.image &&
            <ImageField
              field={fields.image}
            />
            }
          </p>
          <p className="titol">{title}</p>
          <ul className="detalls">
            <li>{window.localization['PUBLICATION_WIDGET_TIPUS']}: {type}</li>
            <li>{window.localization['PUBLICATION_WIDGET_NUM_PAGES']}: {pageNum}</li>
            <li>{window.localization['PUBLICATION_WIDGET_FORMAT']}: {format}</li>
            <li>{window.localization['PUBLICATION_WIDGET_LANGUAGES']}: {languages}</li>
            <li>{window.localization['PUBLICATION_WIDGET_LAST_EDITION']}: {lastEdition}</li>
            <li>{window.localization['PUBLICATION_WIDGET_PRICE']}: {price}</li>
          </ul>
          <ul className="opcions app">
            <li>
              <TranslatedFileField
                field={fields.descargable}
              />
            </li>
          </ul>
          {selectable &&
            <button type="button" className={"btn "+(selected ? 'selected' : '')} onClick={this.props.onSelect.bind(this,this.props.field)}>{window.localization['GENERAL_WIDGET_SELECT']}</button>
          }

        </div>
      );

    }
}
export default Publication;
