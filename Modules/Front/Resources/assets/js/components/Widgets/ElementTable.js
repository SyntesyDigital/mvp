import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';
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

        this.state = {
            field : field,
            elementObject : elementObject,
            modelValues:[],
            itemsPerPage :  itemsPerPage,
            filters : [],
            sortColumn : false,
            sortDirection : 'NONE'
        };
    }

    componentDidMount() {
      this.query();
      this.myOpenGrid.onToggleFilter();
    }

    query(page,filters) {
        var self = this;
        const {elementObject,itemsPerPage} = this.state;
        var limit = itemsPerPage?'/'+itemsPerPage:'';

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
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    sortRows(sortColumn, sortDirection){
      console.log(sortColumn);
      this.setState({
        sortColumn : sortColumn,
        sortDirection : sortDirection
      });
      const comparer = (a, b) => {
        if (sortDirection === "ASC") {
          return a[sortColumn] > b[sortColumn] ? 1 : -1;
        } else if (sortDirection === "DESC") {
          return a[sortColumn] < b[sortColumn] ? 1 : -1;
        }
      };
      if(sortDirection === "NONE" ){
        this.setState({
          modelValues : [...this.state.initialModelValues]
        });
      }else{
        this.setState({
          modelValues : this.state.modelValues.sort(comparer)
        });
      }
    }


    handleFilterChange(filter){
      const newFilters = { ...this.state.filters };
      if (filter.filterTerm) {
        newFilters[filter.column.key] = filter;
      } else {
        delete newFilters[filter.column.key];
      }
      this.setState({
        filters : newFilters
      });

      return newFilters;
    }

    getRows(rows, filters) {
      return selectors.getRows({ rows, filters });
    }

    renderTable() {
      const {modelValues, elementObject, filters} = this.state;

      var columns = [];
      for(var index in elementObject.fields){
        columns.push({
          key : elementObject.fields[index].identifier,
          name: elementObject.fields[index].name,
          sortable: true,
          filterable: true
        });
      }
      var minHeight = parseInt( modelValues.length + 2)*35 + 17;

      const filteredModelValues = this.getRows(modelValues, filters);

      return (
        <ReactDataGrid
          ref={(datagrid) => { this.myOpenGrid = datagrid; }}
          columns={columns}
          rowGetter={i => filteredModelValues[i]}
          rowsCount={ modelValues.length}
          minHeight={minHeight}
          onGridSort={(sortColumn, sortDirection) => this.sortRows(sortColumn, sortDirection)}
          onAddFilter={filter => this.handleFilterChange(filter)}
          />
      );
    }

    render() {
        return (
            <div>
              {this.renderTable()}
            </div>
        );

    }
}

if (document.getElementById('elementTable')) {

   document.querySelectorAll('[id=elementTable]').forEach(function(element){
       var field = element.getAttribute('field');
       var elementObject = element.getAttribute('elementObject');
       var itemsPerPage = element.getAttribute('itemsPerPage');

       ReactDOM.render(<ElementTable
           field={field}
           elementObject={elementObject}
           itemsPerPage={itemsPerPage}
         />, element);
   });
}
