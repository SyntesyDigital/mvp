import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ListItem from './../Common/ListItem';

export default class TypologyByCategory extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null
        };
    }

    componentDidMount() {

      var self = this;
      const field = this.state.field;

      const typology = field.settings.typology;
      const category = field.settings.category;

      const categoryQuery = category != null ? "&category_id="+category : '';
      const typologyQuery = typology != null ? "&typology_id="+typology : '';


      axios.get(ASSETS+'api/categories/tree?loads=contents'+categoryQuery+typologyQuery)
        .then(response => {
          var items = {};

          if(response.data !== undefined){
            items = response.data;
          }

          console.log("TypologyByCategory :: componentDidMount => ",items);

          self.setState({
            items : items
          });

        })
         .catch(function (error) {
           console.log(error);
         });

    }

    renderContents(items) {

      var result = [];

      for(var key in items){
        console.log("TypologyByCategory => ",items[key]);

        result.push(
          <li key={key}>
            <ListItem
              field={items[key]}
            />
          </li>
        );
      }

      return result;
    }

    renderDescendants(items) {

      var result = [];

      for(var key in items){
        result.push(
          this.renderItem(items[key],key)
        );
      }

      return result;
    }

    renderItem(item,key){

      return (
        <div className="hierachy-item" key={key}>
          <h2>{item['name']}</h2>
          <ul>
            {this.renderContents(item['contents'])}
          </ul>
          {this.renderDescendants(item['descendants'])}
        </div>
      );
    }

    render() {

        const isEmpty = this.state.items == null || ( this.state.items.data.contents.length == 0 &&
          this.state.items.data.descendants.length == 0 ) ? true : false;

        return (
            <div>
              {this.state.items == null &&
                <p>
                  {/*Carregant dades...*/}
                </p>
              }

              {this.state.items != null && isEmpty &&
                <p>
                  {Lang.get('widgets.last_typology.empty')}
                </p>
              }

              {this.state.items != null && !isEmpty &&
                <ul>
                  {this.renderItem(this.state.items.data,0)}
                </ul>
              }

            </div>
        );
    }
}


if (document.getElementById('typology-by-category')) {
    var element = document.getElementById('typology-by-category');
    var field = element.getAttribute('field');

    ReactDOM.render(<TypologyByCategory
        field={field}
      />, element);
}
