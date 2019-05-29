import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

export default class StatisticsSummary extends Component {

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

      var data = fields.data.values != null ? fields.data.values : null;
      if(data != null){
        data = moment(data).format('L');
      }

      const title = this.processText(fields,'title');
      const description = this.processText(fields,'descripcio');

      console.log("StatisticsSummary => ",this.props.field);


      return (
        <div className="statistics summary-item">
            <ul>
              <li className="title">
                {title}
              </li>
              <li className="data">
                {data}
              </li>
            </ul>
        </div>
      );

    }
}
