import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';

export default class TypologyLast extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null
        };

        console.log("TypologyLast :: field => ",this.state.field);

    }

    componentDidMount() {

      var self = this;
      const field = this.state.field;

      const typology = field.settings.typology;
      const category = field.settings.category;

      const categoryQuery = category != null ? "&category_id="+category : '';

      axios.get(ASSETS+'api/contents?typology_id='+typology+categoryQuery)
        .then(response => {

          console.log("Response => ",response);
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

      console.log("TypologyLast :: renderItems ",this.state.items);

      return this.state.items.map((item,index) =>
        <li key={index}>
          <p className="image">
            <ImageField
              field={item.fields.imatge}
            />

          </p>
          <p className="text"><span className="data">30-11-2016</span> | <span className="categoria">Categoria </span></p>
          <a href="">{item.fields.title.values[LOCALE] !== undefined ? item.fields.title.values[LOCALE] : '' }</a>
         </li>
      );

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
                  {"No s'ha trobat cap resultat"}
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


if (document.getElementById('typology-last')) {
    var element = document.getElementById('typology-last');
    var field = element.getAttribute('field');

    ReactDOM.render(<TypologyLast
        field={field}
      />, element);
}