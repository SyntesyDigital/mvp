import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class Statistics extends Component {

    constructor(props)
    {
        super(props);
        moment.locale(LOCALE);
    }

    componentDidMount() {

    }

    processText(fields,fieldName){
      return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
        fields[fieldName].values[LOCALE] : '' ;
    }

    render() {

      const fields = this.props.field.fields;

      var data = fields.data.values != null ? fields.data.values : null;
      if(data != null){
        data = moment(data).format('L');
      }

      const title = this.processText(fields,'title');
      const description = this.processText(fields,'descripcio');

      const selectable = this.props.selectable !== undefined && fields.index.values != null ? this.props.selectable : false;
      var selected = this.props.selected !== undefined ? this.props.selected : false;

      return (
        <div className="statistics banc-media list-items buttons">
          <p className="titol">{title}</p>
          <p className="data">{data}</p>

          {/*if has index then is necessary to select and send email*/}
          {/*if don't has index, then you can download directly*/}

            <ul className="opcions app">
              {fields.index.values != null &&
                <li>
                  <TranslatedFileField
                    field={fields.index}
                    label={Lang.get('widgets.see_index')}
                  />
                </li>
              }
              {fields.index.values == null &&
                <li>
                  <TranslatedFileField
                    field={fields.pdf}
                  />
                </li>
              }
              {selectable &&
                <li>
                  <button type="button" className={"btn "+(selected ? 'selected' : '')} onClick={this.props.onSelect.bind(this,this.props.field)}>{Lang.get('widgets.select')}</button>
                </li>
              }
            </ul>

        </div>
      );

    }
}
export default Statistics;
