import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';
import Paginator from './../Common/Paginator';
import ReactDataGrid from 'react-data-grid';
import { Toolbar, Data } from "react-data-grid-addons";

const selectors = Data.Selectors;

export default class ElementTable extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;
        const itemsPerPage = props.itemsPerPage ? props.itemsPerPage : false;
        const maxItems = props.maxItems ? props.maxItems : false;

        this.state = {
            field : field,
            elementObject : elementObject,
            modelValues:[],
            itemsPerPage :  itemsPerPage,
            maxItems :  maxItems,
            filters : [],
            currentPage:1,
            modelValuesPaginated:[]
        };
    }

    componentDidMount() {
      this.query();

      var anySearchable = false;

      var columns = [];
      for(var index in this.state.elementObject.fields){
        if(this.state.elementObject.fields[index].rules.searchable && ! anySearchable){
          anySearchable = true;
          this.myOpenGrid.onToggleFilter();
        }
      }
    }

    query(page,filters) {
        var self = this;
        const {elementObject,itemsPerPage, maxItems} = this.state;
        var limit = maxItems?'/'+maxItems:'';

        axios.get(ASSETS+'architect/extranet/'+elementObject.id+'/model_values/data'+limit)
          .then(function (response) {
              if(response.status == 200
                  && response.data.modelValues !== undefined)
              {
                console.log("ModelValues  :: componentDidMount => ",response.data.modelValues);

                self.setState({
                  modelValues : response.data.modelValues,
                  initialModelValues : [...response.data.modelValues]
                });
                self.onPageChange(1);
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    onPageChange(page){
      const {modelValues, itemsPerPage, maxItems} = { ...this.state };
      var init=0;
      var elementsInPage = [];
      if(itemsPerPage){
        elementsInPage = modelValues.slice((page -1)*itemsPerPage,page*itemsPerPage);
      }else{
        elementsInPage = modelValues;
      }
      this.setState({
        modelValuesPaginated : elementsInPage
      });
    }

    handleResultsChange(filter, sortColumn, sortDirection){
      if(filter != 'NONE'){
        const {modelValues, initialModelValues} = { ...this.state };
        const newFilters = { ...this.state.filters };

        if (filter.filterTerm) {
          newFilters[filter.column.key] = filter;
        } else {
          delete newFilters[filter.column.key];
        }
        this.setState({
          filters : newFilters,
          modelValues : selectors.getRows({rows : initialModelValues, filters : newFilters})
        });
      }
      const comparer = (a, b) => {
        if (sortDirection === "ASC") {
          return a[sortColumn] > b[sortColumn] ? 1 : -1;
        } else if (sortDirection === "DESC") {
          return a[sortColumn] < b[sortColumn] ? 1 : -1;
        }
      };
      if(sortDirection != "NONE" ){
        this.setState({
          modelValues : this.state.modelValues.sort(comparer)
        });
      }
      this.onPageChange(1);
    }

    renderTable() {
      const {modelValues, modelValuesPaginated, elementObject, filters} = this.state;
      var anySearchable = false;
      var columns = [];

      for(var index in elementObject.fields){
        if(elementObject.fields[index].rules.searchable && ! anySearchable){
          anySearchable = true;
        }
        columns.push({
          key : elementObject.fields[index].identifier,
          name: elementObject.fields[index].name,
          sortable: elementObject.fields[index].rules.sortable,
          filterable:  elementObject.fields[index].rules.searchable
        });
      }
      var minHeight = anySearchable?(parseInt( modelValues.length) + 1)*35 + 45 : (parseInt( modelValues.length) + 1)*35  ;

      return (
        <ReactDataGrid
          ref={(datagrid) => { this.myOpenGrid = datagrid; }}
          columns={columns}
          rowGetter={i => modelValuesPaginated[i]}
          rowsCount={ modelValues.length}
          minHeight={minHeight + 40}
          onGridSort={(sortColumn, sortDirection) => this.handleResultsChange('NONE',sortColumn, sortDirection)}
          onAddFilter={filter => this.handleResultsChange(filter,'NONE','NONE')}
          />
      );
    }

    render() {
        return (
            <div>
              {this.renderTable()}

              {this.state.itemsPerPage &&
                <Paginator
                  currPage={this.state.currentPage}
                  lastPage={Math.ceil(this.state.modelValues.length/this.state.itemsPerPage)}
                  onChange={this.onPageChange.bind(this)}
                />
              }
            </div>

        );

    }
}

if (document.getElementById('elementTable')) {

   document.querySelectorAll('[id=elementTable]').forEach(function(element){
       var field = element.getAttribute('field');
       var elementObject = element.getAttribute('elementObject');
       var maxItems = element.getAttribute('maxItems');
       var itemsPerPage = element.getAttribute('itemsPerPage');

       ReactDOM.render(<ElementTable
           field={field}
           elementObject={elementObject}
           itemsPerPage={itemsPerPage}
           maxItems={maxItems}
         />, element);
   });
}
