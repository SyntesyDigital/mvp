import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';

class News extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount() {

    }

    render() {

      moment.locale(LOCALE);

      const fields = this.props.field.fields;
      console.log("News => ",this.props.field);

      var data = fields.data.values != null ? fields.data.values : null;
      if(data != null){
        data = moment(data).format('L');
      }

      return (
        <div className="news">
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

            |
            <span className="categoria">Categoria </span></p>
          <a href="">{fields.title.values[LOCALE] !== undefined ?
            fields.title.values[LOCALE] : '' }</a>
        </div>
      );

    }
}
export default News;
