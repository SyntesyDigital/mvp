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

      //const typology = field.settings.typology;
      const category = field.settings.category;

      const categoryQuery = category != null ? "&category_id="+category : '';

      axios.get(ASSETS+'api/categories/tree?loads=contents'+categoryQuery)
        .then(response => {
          var items = [];

          if(response.status == 200 && response.data.data !== undefined
            && response.data.data.length > 0){
                items = response.data.data;
          }

          self.setState({
            items : items
          });

        })
         .catch(function (error) {
           console.log(error);
         });

    }

    renderItems() {

      var result = [];

      const {items} = this.state;

      for(var key in items){
        console.log("TypologyByCategory => ",items[key]);

        result.push(
          <ListItem
            key={key}
            field={items[key]}
          />
        );
      }

      return result;
    }

    render() {

        return (
            <div>
              {this.state.items == null &&
                <p>
                  {/*Carregant dades...*/}
                </p>
              }

              {this.state.items != null && this.state.items.length == 0 &&
                <p>
                  {Lang.get('widgets.last_typology.empty')}
                </p>
              }

              {this.state.items != null && this.state.items.length > 0 &&
                <ul>
                  {this.renderItems()}
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
