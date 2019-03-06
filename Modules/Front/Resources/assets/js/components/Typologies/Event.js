import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';
import UrlField from './../Fields/UrlField';

class Event extends Component {

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
      console.log("Event => ",this.props.field);

      const title = this.processText(fields,'title');
      const description = this.processText(fields,'descripcio');

      var data = fields.data.values != null ? fields.data.values : null;
      if(data != null){
        data = moment(data).format('L');
      }

      return (
        <div className="event">
          <p className="image">
            {fields.imatge &&
            <ImageField
              field={fields.imatge}
            />
            }
          </p>
          <p className="text">

              {data != null &&
                <span className="data">
                  {data}
                </span>
              }

          </p>

          <UrlField
            field={fields.url}
          >
            {title}
          </UrlField>

          <div className="intro"
            dangerouslySetInnerHTML={{__html: description}}
          >
          </div>

        </div>
      );

    }
}
export default Event;
