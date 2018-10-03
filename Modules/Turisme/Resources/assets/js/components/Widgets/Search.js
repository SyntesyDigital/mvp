import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';


const imagesLoadedOptions = { background: '.my-bg-image-el' }

export default class Search extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const text = props.text ? props.text : null;

        var filters = {};
        if(text != null){
          filters.text = text;
        }

        this.state = {
            field : field,
            filters : filters,
            size:field.settings.itemsPerPage !== null ?  field.settings.itemsPerPage : 5,
            items : null,
            currPage : null,
            total : null,
        };
    }

    componentDidMount() {

        const {filters} = this.state;
        this.query(1,filters);

    }

    query(page,filters) {
        var self = this;

        var searchQuery = '';
        var datesQuery = '';
        var entrevistaQuery = '';

        const {field} = this.state;

        var query = 'size='+this.state.size;

        if(filters != null && filters.text != null){
          query += '&q='+filters.text;
        }
        if(page >1){
          query += '&page='+page;
        }
        console.log('QUERY--',query);

        axios.get(ASSETS+'api/search?'+query)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                console.log('RESPONSE.DATA--',response.data);

                var old_items = self.state.items;
                if(response.data.current_page != 1){
                  old_items.push.apply(old_items, response.data.data);
                }else{
                  old_items =response.data.data;
                }
                console.log('OLD ITEMS--',old_items);

                  self.setState({
                      items : old_items,
                      lastPage : response.data.last_page,
                      currPage : response.data.current_page,
                      filters : filters,
                      total : response.data.total
                  });
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    renderItems() {

      var result = [];
      const {items} = this.state;
      for(var i = 0; i< items.length; i++){

        result.push(
          <li key={i}>
            <div>
              <h3><a href={items[i].url}>{items[i].title}</a><span>90%</span></h3>
              <p className="breadcrumb"> <a href="">pagina padre</a> / <a href="">pagina padre</a> / <a href={items[i].url}>{items[i].title}</a></p>
              <p className="text">{items[i].description}</p>
            </div>
          </li>
        );
      }

      return (
                result
            );
    }

    onPageChange(page) {
        const {filters} = this.state;

        this.query(page,filters);
    }

    render() {

        return (
          <div className="search-container">
            <div className="grey-intro no-margin">
              <div className="container">
                <div className="row">
                  <div className="claim trade">
                    <h1>Buscar</h1>
                    <p>
                      Se han encontrado <strong>{this.state.total}</strong> resultados coincidentes con lel término de búsqueda <strong>"{this.state.filters.text}"</strong>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div className="white">
              <div className="container">
                <div className="row">
                  {this.state.items != null && this.state.items.length == 0 &&
                      <p>{window.localization['GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY']}</p>
                  }

                  {this.state.items != null && this.state.items.length > 0 &&
                    <div className="col-md-12 col-sm-12 col-xs-12 busqueda">
                      <ul>
                        {this.renderItems()}
                      </ul>
                    </div>
                  }
                </div>
                <div className="row">
                  {this.state.lastPage &&
                      <MoreResults
                        currPage={this.state.currPage}
                        lastPage={this.state.lastPage}
                        onChange={this.onPageChange.bind(this)}
                      />
                  }
                </div>
              </div>
            </div>
          </div>
        );
    }
}

if (document.getElementById('search')) {

   document.querySelectorAll('[id=search]').forEach(function(element){
       var field = element.getAttribute('field');
       var text = element.getAttribute('text');

       ReactDOM.render(<Search
           field={field}
           text={text}
         />, element);
   });
}
