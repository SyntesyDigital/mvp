import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';

class News extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount() {

    }

    render() {

      const fields = this.props.field.fields;

      return (
        <div className="news">
          <p className="image">
            {fields.imatge &&
            <ImageField
              field={fields.imatge}
            />
            }
          </p>
          <p className="text"><span className="data">30-11-2016</span> | <span className="categoria">Categoria </span></p>
          <a href="">{fields.title.values[LOCALE] !== undefined ?
            fields.title.values[LOCALE] : '' }</a>
        </div>
      );

    }
}
export default News;
