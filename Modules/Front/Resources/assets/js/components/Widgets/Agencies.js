import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import ListExternalItem from './../Common/ListExternalItem';
import OrderBar from './../Common/OrderBar';
import FilterBarAgencies from './../Common/FilterBarAgencies';


export default class Agencies extends Component {

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

      console.log("Agencies :: handleOrderChange => ",order);

      this.query(1,filters,order);
    }

    handleFilterSubmit(filters) {

      const {order} = this.state;

      console.log("Agencies :: handleFilterSubmit => ",filters);

      this.query(1,filters,order);
    }

    query(page,filters,order) {
        const field = this.state.field;
        var self = this;

        var orderQuery = '';
        if(order != null && order != ''){
          var orderArray = order.split(',');
          orderQuery = '&orderBy='+orderArray[0]+'&sortedBy='+orderArray[1];
        }

        var filterQuery = ''
        if(filters != null && filters != ''){
          filterQuery = filters.query;
        }

        axios.get(ASSETS+'externalapi/agencies?'+filterQuery+orderQuery+'&size='+this.state.size+'&page=' + (page ? page : null))
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
                      order : order,
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
        console.log("Agencies => ",items[key]);

        result.push(
          <li key={key}>
            <ListExternalItem
              field={items[key]}
              type='agency'
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

      console.log("Agencies :: handleFilterSubmit => ",filters);

      this.query(1,filters,order);
    }

    render() {
        return (
            <div>

                <FilterBarAgencies
                  onSubmit={this.handleFilterSubmit.bind(this)}
                />

                {this.state.items != null &&
                  <OrderBar
                    fieldName="name"
                    onSubmit={this.handleOrderChange.bind(this)}
                  />
                }


                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null && this.state.items.length == 0 &&
                    <p>{window.localization['GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY']}</p>
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


if (document.getElementById('agencies')) {
    var element = document.getElementById('agencies');
    var field = element.getAttribute('field');

    ReactDOM.render(<Agencies
        field={field}
      />, element);
}