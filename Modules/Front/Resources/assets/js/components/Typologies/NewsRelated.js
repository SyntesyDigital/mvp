import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';

class NewsRelated extends Component {

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

      //console.log("NewsBlog => ",this.props.field);

      const fields = this.props.field.fields;

      const category = this.props.field.category != null ? this.props.field.category.name : null;
      const category_slug = this.props.field.category != null ? this.props.field.category.slug : null;
      var data = fields.date.values != null ? fields.date.values : null;

      const slug = this.processText(fields,'slug');
      const title = this.processText(fields,'title');
      const descripcio = this.processText(fields,'excerpt');

      var crop = "medium";
      var url = null;

      if(fields['image'].values !== undefined && fields['image'].values != null){
        if(fields['image'].values.urls[crop] !== undefined){
          url = fields['image'].values.urls[crop];
        }
      }

      var results = [];
      if(data != null){
        data = moment(data).format('L');
      }

      return (

        <div className="post-box">
            <div className="title">
              {title}
            </div>
            <p className="date">{data != null ? 'Le '+data : ''} - {category != null &&
              <a href={routes["categoryNews"].replace(":slug",category_slug)}>{category} </a>
            }</p>
            <div className="excerpt" dangerouslySetInnerHTML={{__html: descripcio }}>
            </div>
            <a href={this.props.field.url} className="read-more">Lire la suite</a>
        </div>
      );

    }
}
export default NewsRelated;
