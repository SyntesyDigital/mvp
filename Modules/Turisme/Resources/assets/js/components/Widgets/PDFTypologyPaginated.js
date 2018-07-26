import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';

export default class PDFTypologyPaginated extends Component {

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

        axios.get(ASSETS+'api/contents?size=2&typology_id='+typology + '&page=' + (page ? page : null))
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
            {item.fields.title.values[LOCALE] !== undefined ? item.fields.title.values[LOCALE] : '' }<br />
            {item.fields.publicacio.values}<br />
            {item.fields.publicacio.autor !== undefined  ? item.fields.publicacio.autor.values[LOCALE] : null}<br />
            <a href="#">{Lang.get('widgets.typology_paginated.download_pdf')}</a>
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


if (document.getElementById('pdf-typology-paginated')) {
    var element = document.getElementById('pdf-typology-paginated');
    var field = element.getAttribute('field');

    ReactDOM.render(<PDFTypologyPaginated
        field={field}
      />, element);
}
