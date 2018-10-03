import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import NewsBlog from './../Typologies/SearchResults';


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
        console.log('QUERY--',query);

        axios.get(ASSETS+'api/search?'+query)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                console.log('RESPONSE--',response);

                var old_items = self.state.items;
                if(response.data.meta.current_page != 1){
                  old_items.push.apply(old_items, response.data.data);
                }else{
                  old_items =response.data.data;
                }
                  self.setState({
                      items : old_items,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      filters : filters
                  });
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    renderItems() {

      var result = [];
      const {items} = this.state;
      for(var key in items){
        result.push(
          <li>
            <SearchResults
              field={items[key]}
            />
          </li>
        );
      }

      return (
                {result}
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
                      Se han encontrado <strong>XX</strong> resultados coincidentes con lel término de búsqueda <strong>"{this.state.filters.text}"</strong>
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
                    <div class="col-md-12 col-sm-12 col-xs-12 busqueda">
                      <ul>
                        {this.renderItems()}
                      </ul>
                    </div>
                  }

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
