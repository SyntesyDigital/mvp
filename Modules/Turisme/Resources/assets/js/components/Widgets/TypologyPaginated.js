import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import Paginator from './../Common/Paginator';

export default class TypologyPaginated extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null,
            lastPage : null,
            currPage : null
        };
        this.onPageChange.bind(this);
    }

    componentDidMount() {
      this.query(1);
    }
    
    query(page) {
        var self = this;
        const field = this.state.field;

        const typology = field.settings.typology;
        const category = field.settings.category;

        axios.get(ASSETS+'api/contents?size=1&typology_id='+typology + '&page=' + (page ? page : null))
          .then(response => {
              var items = [];
              if(response.status == 200 
                  && response.data.data !== undefined 
                  && response.data.data.length > 0)
              {
                  items = response.data.data;
              }

              self.setState({
                  items : items,
                  lastPage : response.data.meta.last_page,
                  currPage : response.data.meta.current_page,
              });
          }).catch(function (error) {
             console.log(error);
           });
    }
    

    renderItems() {
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

    onPageChange(page) {
        this.query(page);
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
                {this.state.lastPage && 
                <Paginator currPage={this.state.currPage} lastPage={this.state.lastPage} onChange={this.onPageChange.bind(this)} />
                }
            </div>
        );
    }
}


if (document.getElementById('typology-paginated')) {
    var element = document.getElementById('typology-paginated');
    var field = element.getAttribute('field');

    ReactDOM.render(<TypologyPaginated
        field={field}
      />, element);
}
