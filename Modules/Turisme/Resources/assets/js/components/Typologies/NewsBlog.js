import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';

import ImageField from './../Fields/ImageField';

class NewsBlog extends Component {

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
   //  console.log("News => ",this.props.field);

      const category = this.props.field.category != null ? this.props.field.category.name : null;
      const category_slug = this.props.field.category != null ? this.props.field.category.slug : null;
      var data = fields.data.values != null ? fields.data.values : null;

      const slug = this.processText(fields,'slug');
      const title = this.processText(fields,'title');
      const descripcio = this.processText(fields,'descripcio');


      if(data != null){
        data = moment(data).format('L');
      }

      return (
        <div className="post">
          <p className="details">
            {data != null ? data : ''}
            {category != null && data != null ? '|' : ''}
            {category != null &&
              <a href={'/blog/category/'+category_slug}>{category} </a>
            }  
          </p>
          <p className="image">
            {fields.imatge &&
            <ImageField
              field={fields.imatge}
            />
            }
          </p>
          <h3><a href={'/blog/'+slug }>{ title}</a></h3>
          <p>
            <span dangerouslySetInnerHTML={{__html: descripcio }} / >
          </p>
          
        </div>
      );

    }
}
export default NewsBlog;
