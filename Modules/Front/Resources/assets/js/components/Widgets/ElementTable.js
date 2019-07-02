import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';
import ReactDataGrid from 'react-data-grid';

export default class ElementTable extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;
        const header = props.header ? props.header : false;
        const itemsPerPage = props.itemsPerPage ? props.itemsPerPage : false;

        this.state = {
            field : field,
            elementObject : elementObject,
            modelValues:[],
            header : header,
            itemsPerPage :  itemsPerPage
        };
    }

    componentDidMount() {
      this.query();
      console.log('hola');
    }

    query(page,filters) {
        var self = this;
        const {elementObject} = this.state;
        console.log(ASSETS+'architect/extranet/'+elementObject.id+'/model_values/data');
        axios.get(ASSETS+'architect/extranet/'+elementObject.id+'/model_values/data')
          .then(function (response) {
              if(response.status == 200
                  && response.data.modelValues !== undefined)
              {
                console.log("ModelValues  :: componentDidMount => ",response.data.modelValues);

                self.setState({
                  modelValues : response.data.modelValues,
                  initialModelValues : response.data.modelValues
                });
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    sortRows(sortColumn, sortDirection){
      console.log(sortColumn);
      const comparer = (a, b) => {
        if (sortDirection === "ASC") {
          return a[sortColumn] > b[sortColumn] ? 1 : -1;
        } else if (sortDirection === "DESC") {
          return a[sortColumn] < b[sortColumn] ? 1 : -1;
        }
      };
      if(sortDirection === "NONE" ){
        this.setState({
          modelValues : this.state.initialModelValues
        });
      }else{
        this.setState({
          modelValues : this.state.initialModelValues.sort(comparer)
        });
      }
    }

    renderTable() {
      const {modelValues, elementObject} = this.state;
      var columns = [];
      for(var index in elementObject.fields){
        columns.push({
          key : elementObject.fields[index].identifier,
          name: elementObject.fields[index].name,
          sortable: true
        });
      }
      var numRows = this.state.itemsPerPage ? this.state.itemsPerPage: modelValues.length;
      var minHeight = parseInt(numRows)*35 ;
      if(this.state.header){
        minHeight = minHeight +35;
      }
      return (
        <ReactDataGrid
          columns={columns}
          rowGetter={i => modelValues[i]}
          rowsCount={numRows}
          minHeight={minHeight}
          onGridSort={(sortColumn, sortDirection) =>
             this.sortRows(sortColumn, sortDirection)
           }
          />
      );
    }

    render() {
        return (
            <div className = {this.state.header ? "" : "noHeaderWrapper "} >
              {this.renderTable()}
            </div>
        );

    }
}

if (document.getElementById('elementTable')) {

   document.querySelectorAll('[id=elementTable]').forEach(function(element){
       var field = element.getAttribute('field');
       var elementObject = element.getAttribute('elementObject');
       var header = element.getAttribute('header');
       var itemsPerPage = element.getAttribute('itemsPerPage');

       ReactDOM.render(<ElementTable
           field={field}
           elementObject={elementObject}
           header={header}
           itemsPerPage={itemsPerPage}
         />, element);
   });
}
