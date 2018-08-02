import React, { Component } from 'react';
import ReactDOM from 'react-dom';


class UrlField extends Component {

    constructor(props)
    {
        super(props);
    }

    getPageSlug(content) {
      //FIXME esto deberia venir directamente del fullSlug
      for(var key in content.fields){
        if(content.fields[key].name == 'slug'){
          return content.fields[key].value;
        }
      }
      return '';
    }

    render() {

      const field = this.props.field;
      var url = '';

      if(field.values != null && field.values !== undefined) {
        if(field.values.url !== undefined && field.values.url[LOCALE] !== undefined && field.values.url[LOCALE] != null){
          url = field.values.url[LOCALE];
        }
        else if(field.values.content !== undefined){
          url = WEBROOT+this.getPageSlug(field.values.content);
        }
      }

      return (
        <a href={url} target={this.props.target}>
          {this.props.children}
        </a>
      );

    }
}
export default UrlField;
