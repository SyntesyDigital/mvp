import React, { Component } from 'react';
import ReactDOM from 'react-dom';
//import MoreResults from './../Common/MoreResults';
//import Paginator from './../Common/Paginator';
//import ReactDataGrid from 'react-data-grid';
//import { Toolbar, Data } from "react-data-grid-addons";

import ReactTable from "react-table";
import "react-table/react-table.css";
import matchSorter from 'match-sorter'

//const selectors = Data.Selectors;

export default class ElementTable extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;
        const pagination =  props.pagination ? true : false;
        const itemsPerPage = props.itemsPerPage !== undefined
          && props.itemsPerPage != null
          && props.itemsPerPage != '' ? props.itemsPerPage : 10;

        console.log("props.itemsPerPage => ",props.itemsPerPage);
        console.log("itemsPerPage => ",itemsPerPage);


        const maxItems = props.maxItems ? props.maxItems : false;

        this.state = {
            field : field,
            elementObject : elementObject,
            data:[],
            pagination : pagination,
            itemsPerPage : itemsPerPage,
            maxItems :  maxItems,
            filters : [],
            currPage:1,
            modelValuesPaginated:[]
        };
    }

    componentDidMount() {
        this.query();
    }

    query() {
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
                  data : response.data.modelValues
                  //initialModelValues : [...response.data.modelValues]
                });
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    filterMethod(identifier, filter, rows, ) {
        console.log("identifier => ",identifier);
        return matchSorter(rows, filter.value, { keys: [identifier] });
    }

    renderTable() {
      const {data, elementObject, itemsPerPage} = this.state;

      var anySearchable = false;
      var columns = [];

      for(var index in elementObject.fields){
        if(elementObject.fields[index].rules.searchable && ! anySearchable){
          anySearchable = true;
        }

        var identifier = elementObject.fields[index].identifier.replace('.','');

        columns.push({
          accessor : identifier,
          Header: elementObject.fields[index].name,
          //sortable: elementObject.fields[index].rules.sortable,
          //filterable:  elementObject.fields[index].rules.searchable
          filterMethod: this.filterMethod.bind(this,identifier),

          filterAll: true
        });
      }

      for(var key in data){
        for( var subkey in data[key]){
          var newSubkey = subkey.replace('.','');
          console.log("subkey => ",subkey);
          console.log("newSubkey => ",newSubkey);
          data[key][newSubkey] = data[key][subkey];
        }
      }

      console.log("data => ",data);
      console.log("elementObject => ",elementObject);
      console.log("columns => ",columns);

      return (
        <ReactTable
          data={data}
          columns={columns}
          showPagination={this.state.pagination}
          defaultPageSize={this.state.itemsPerPage}
          loading={false}
          filterable={true}
          defaultFilterMethod={(filter, row) =>
            String(row[filter.id]) === filter.value
          }
          className="-striped -highlight"
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
       var maxItems = element.getAttribute('maxItems');
       var pagination = element.getAttribute('pagination');
       var itemsPerPage = element.getAttribute('itemsPerPage');

       ReactDOM.render(<ElementTable
           field={field}
           elementObject={elementObject}
           pagination={pagination}
           itemsPerPage={itemsPerPage}
           maxItems={maxItems}
         />, element);
   });
}
