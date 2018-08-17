import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';
import TranslatedFileField from './../Fields/TranslatedFileField';


class StatisticsSelected extends Component {

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

      console.log("StatisticsSelected => ",fields);

      return (
        <div className="statistics selected">
            <p className="titol">{title}</p>
            <p className="data">{data}</p>
            <button type="button" className="btn" onClick={this.props.onRemove.bind(this,this.props.field)}>{Lang.get('widgets.remove')}</button>
        </div>
      );

    }
}
export default StatisticsSelected;
