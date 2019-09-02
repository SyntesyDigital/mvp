import React, { Component } from 'react';
import ReactDOM from 'react-dom';
//import MoreResults from './../Common/MoreResults';
//import Paginator from './../Common/Paginator';
//import ReactDataGrid from 'react-data-grid';
//import { Toolbar, Data } from "react-data-grid-addons";

import ReactTable from "react-table";
import "react-table/react-table.css";
import matchSorter from 'match-sorter'

import moment from 'moment';

//const selectors = Data.Selectors;

export default class TotalBox extends Component {

    constructor(props)
    {
        super(props);

        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;

        this.state = {
            elementObject :elementObject,
            total: null
        };
    }

    componentDidMount() {

        this.query();
    }

    query() {
        var self = this;
        const {elementObject} = this.state;

        axios.get(ASSETS+'architect/extranet/'+elementObject.id+'/model_values/data')
          .then(function (response) {
              if(response.status == 200
                  && response.data.modelValues !== undefined)
              {
                console.log("ModelValues  :: componentDidMount => ",response.data);

                self.setState({
                  total: response.data.total
                });
              }

          }).catch(function (error) {
             console.log(error);
             self.setState({
               loading: false
             });
           });
    }

    render() {
        return (
            <div>
              {this.state.total}
            </div>

        );

    }
}

if (document.getElementById('totalBox')) {

   document.querySelectorAll('[id=totalBox]').forEach(function(element){
       var elementObject = element.getAttribute('elementObject');

       ReactDOM.render(<TotalBox
           elementObject={elementObject}
         />, element);
   });
}
