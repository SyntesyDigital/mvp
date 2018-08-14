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

      const selectable = this.props.selectable !== undefined ? this.props.selectable : false;
      const selected = this.props.selected !== undefined ? this.props.selected : false;

      console.log("Statistics => ",fields,selected);

      return (
        <div className="statistics">
          <p className="titol">{title}</p>
          <p className="data">{data}</p>

          {selectable &&
            <button type="button" className={"btn "+(selected ? 'selected' : '')} onClick={this.props.onSelect.bind(this,this.props.field)}>{Lang.get('widgets.select')}</button>
          }

        </div>
      );

    }
}
export default Statistics;
