import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';
import FilterBar from './../Common/FilterBar';
import FilterBarPublication from './../Common/FilterBarPublication';

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
            filters : null,
            selectedItems : {},
            area : true
        };

        $("#selected-items").css({display:'block'});
        $("#selected-items").on('click',this.onAreaToggle.bind(this));
    }

    onAreaToggle(event){
      event.preventDefault();

      console.log("toggle!");
      const area = !this.state.area;

      this.setState({
        area : area
      });

    }

    componentDidMount() {

        const {filters} = this.state;

        this.query(1,filters);
    }

    query(page,filters) {
        var self = this;

        const {textIdentifier,dateIdentifier,field} = this.state;

        var filtersQuery = '';

        if(filters != null){
          filtersQuery = filters.query;
        }

        console.log("TypologySearchDate :: query : "+filtersQuery);

        axios.get(ASSETS+'api/contents?size=2&typology_id=' + field.settings.typology + filtersQuery +'&page=' + (page ? page : null))
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      items : response.data.data,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      filters : filters
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }

    handleOnSelect(field){
      console.log("TypologySelectionFilters :: => handleOnSelect ",field);

      const {selectedItems} = this.state;

      if(selectedItems[field.id] === undefined){
        selectedItems[field.id] = field;
      }

      this.setState({
        selectedItems : selectedItems
      });

      var size = Object.keys(selectedItems).length;
      $("#selected-items #number").html(size);

    }

    renderItems() {

      var result = [];

      const {items,selectedItems} = this.state;

      for(var key in items){

        var selected = selectedItems[items[key].id] !== undefined ? true : false;
        //console.log("TypologyPaginated => ",items[key],selectedItems,selected);

        result.push(
          <li key={key}>
            <ListItem
              field={items[key]}
              selectable={true}
              selected={selected}
              onSelect={this.handleOnSelect.bind(this)}
            />
          </li>
        );
      }

      return result;
    }

    renderSelectedItems() {

      var result = [];

      const {selectedItems} = this.state;

      for(var key in selectedItems){

        result.push(
          <li key={key}>
            <ListItem
              field={selectedItems[key]}
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

      console.log("TypologySelectionFilters :: handleFilterSubmit => ",filters);

      this.query(1,filters);
    }

    renderSelectionArea() {
      return (
        <div>

            <FilterBarPublication
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

    renderSelectedList() {

      var size = Object.keys(this.state.selectedItems).length;

      return (
        <div>

            {size == 0 &&
                <p>{Lang.get('widgets.selected_void')}</p>
            }

            {size > 0 &&
                <ul>{this.renderSelectedItems()}</ul>
            }

        </div>
      );
    }

    render() {

        const area = this.state.area;

        return (
            <div>
              {area &&
                this.renderSelectionArea()
              }

              {!area &&
                this.renderSelectedList()
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
