import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';
import FilterBar from './../Common/FilterBar';
import ListItem from './../Common/ListItem';


export default class TypologySelectionFilters extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const textIdentifier =  field.settings.textIdentifier !== undefined ? field.settings.textIdentifier : null;
        const dateIdentifier =  field.settings.dateIdentifier !== undefined ? field.settings.dateIdentifier : null;


        console.log("TypologySelectionFilters => ",field);

        this.state = {
            field : field,
            items : null,
            lastPage : null,
            currPage : null,
            loaded: false,
            textIdentifier : textIdentifier,
            dateIdentifier : dateIdentifier,
            filters : null
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

        const {textIdentifier,dateIdentifier,field} = this.state;

        if(filters != null){
          if(textIdentifier != null && filters.text != null){
            searchQuery = "&"+textIdentifier+"="+filters.text;
          }
          if(dateIdentifier != null && filters.startDate != null && filters.endDate != null) {
            datesQuery = "&"+dateIdentifier+"=["+filters.startDate+":"+filters.endDate+"]";
          }

        }


        axios.get(ASSETS+'api/contents?size=2&typology_id=' + field.settings.typology + searchQuery + datesQuery +'&page=' + (page ? page : null))
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined
                  && response.data.data.length > 0)
              {
                  self.setState({
                      items : response.data.data,
                      //lastPage : response.data.meta.last_page,
                      //currPage : response.data.meta.current_page,
                      filters : filters
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }

    handleOnSelect(field){
      console.log("TypologySelectionFilters :: => handleOnSelect ",field);
    }

    renderItems() {

      var result = [];

      const {items} = this.state;

      for(var key in items){
        console.log("TypologyPaginated => ",items[key]);

        result.push(
          <li key={key}>
            <ListItem
              field={items[key]}
              selectable={true}
              onSelect={this.handleOnSelect.bind(this)}
            />
          </li>
        );
      }

      return result;
    }

    onPageChange(page) {
        const {filters} = this.state;

        this.query(page,filters);
    }

    handleFilterSubmit(filters) {
      this.query(1,filters);
    }

    render() {
        return (
            <div>

                <FilterBar
                  displayText={this.state.textIdentifier != null ? true : false}
                  displayDates={this.state.dateIdentifier != null ? true : false}
                  onSubmit={this.handleFilterSubmit.bind(this)}
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


if (document.getElementById('typology-selection-filters')) {
    var element = document.getElementById('typology-selection-filters');
    var field = element.getAttribute('field');

    ReactDOM.render(<TypologySelectionFilters
        field={field}
      />, element);
}
