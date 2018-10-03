import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';

class SearchResults extends Component {

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

      const category = this.props.field.category != null ? this.props.field.category.name : null;
      const category_slug = this.props.field.category != null ? this.props.field.category.slug : null;
      var data = fields.data.values != null ? fields.data.values : null;

      const slug = this.processText(fields,'slug');
      const title = this.processText(fields,'title');
      const descripcio = this.processText(fields,'descripcio');
      const nom = this.processText(fields,'nom');
      const carrec = this.processText(fields,'carrec');
      var results = [];
      if(data != null){
        data = moment(data).format('L');
      }




      return (
            <div>
              <h3><a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a><span>90%</span></h3>
              <p className="breadcrumb"> <a href="">pagina padre</a> / <a href="">pagina padre</a> / <a href="">nombre pagina</a></p>
              <p className="text">... laoreet lorem non <span>elementum blandit.</span> Nullam et purus mollis...</p>
            </div>
      );

    }
}
export default SearchResults;
