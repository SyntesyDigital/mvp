import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import ListExternalItem from './../Common/ListExternalItem';
import OrderBar from './../Common/OrderBar';
import FilterBarCompanies from './../Common/FilterBarCompanies';


export default class Companies extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';

        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null,
            lastPage : null,
            currPage : null,
            loaded: false,
            order : null,
            filters : null,
            size:field.settings.itemsPerPage !== undefined && field.settings.itemsPerPage != null ?  field.settings.itemsPerPage : 3,
        };
    }

    componentDidMount() {
        //this.query(1);
    }

    handleOrderChange(order) {

      const {filters} = this.state;

      console.log("TypologySelectionFilters :: handleOrderChange => ",order);

      this.query(1,filters,order);
    }

    handleFilterSubmit(filters) {

      const {order} = this.state;

      console.log("TypologySelectionFilters :: handleFilterSubmit => ",filters);

      this.query(1,filters,order);
    }

    query(page,filters,order) {
        const field = this.state.field;
        var self = this;

        var orderQuery = '&orderBy=name&sortedBy=asc';

        var filterQuery = ''
        if(filters != null && filters != ''){
          filterQuery = filters.query;
        }

        axios.get(ASSETS+'externalapi/companies?'+orderQuery+filterQuery+'&size='+this.state.size+'&page=' + (page ? page : null))
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                var old_items = self.state.items;
                if(response.data.meta.current_page != 1){
                  old_items.push.apply(old_items, response.data.data);
                }else{
                  old_items =response.data.data;
                }
                  self.setState({
                      items :  old_items,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      order : order
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
        console.log("Companies => ",items[key]);

        result.push(
          <li key={key}>
            <ListExternalItem
              field={items[key]}
              type='company'
            />
          </li>
        );
      }

      return result;
    }

    onPageChange(page) {

        const {order} = this.state;

        this.query(page,order);
    }

    handleFilterSubmit(filters) {

      const {order} = this.state;

      console.log("Companies :: handleFilterSubmit => ",filters);

      this.query(1,filters,order);
    }

    render() {
        return (
            <div>

                <FilterBarCompanies
                  onSubmit={this.handleFilterSubmit.bind(this)}
                  axe={this.state.field.settings.axe}
                />

                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null && this.state.items.length == 0 &&
                    <p>{Lang.get('widgets.last_typology.empty')}</p>
                }

                {this.state.items != null && this.state.items.length > 0 &&
                    <ul>{this.renderItems()}</ul>
                }

                {this.state.lastPage &&
                    <MoreResults
                      currPage={this.state.currPage}
                      lastPage={this.state.lastPage}
                      onChange={this.onPageChange.bind(this)}
                    />
                }
            </div>
        );
    }
}


if (document.getElementById('companies')) {

    document.querySelectorAll('[id=companies]').forEach( element =>
        ReactDOM.render(
          <Companies
            field={element.getAttribute('field')}
          />,
          element
        )
    );
}
