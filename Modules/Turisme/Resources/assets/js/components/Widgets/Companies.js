import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';
import ListExternalItem from './../Common/ListExternalItem';
import OrderBar from './../Common/OrderBar';
import FilterBarCompanies from './../Common/FilterBarCompanies';


export default class Companies extends Component {

    constructor(props)
    {
        super(props);
        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null,
            lastPage : null,
            currPage : null,
            loaded: false,
            order : null,
            filters : null
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

        axios.get(ASSETS+'externalapi/companies?'+orderQuery+filterQuery+'&page=' + (page ? page : null))
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      items : response.data.data,
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
          <li key={key} className="col-xs-12">
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
                    <Paginator
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
