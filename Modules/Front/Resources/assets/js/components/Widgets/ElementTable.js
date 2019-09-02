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

export default class ElementTable extends Component {

    constructor(props)
    {
        super(props);

        const defaultDataLoadStep = 2500;
        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;
        const pagination =  props.pagination ? true : false;
        const itemsPerPage = props.itemsPerPage !== undefined
          && props.itemsPerPage != null
          && props.itemsPerPage != '' ? props.itemsPerPage : 10;

        //console.log("props.itemsPerPage => ",props.itemsPerPage);
        //console.log("itemsPerPage => ",itemsPerPage);


        const maxItems = props.maxItems !== undefined ? props.maxItems : false;

        this.state = {
            field : field,
            elementObject : elementObject,
            data:[],
            columns:[],
            pagination : pagination,
            itemsPerPage : itemsPerPage,
            maxItems :  maxItems,
            filters : [],
            currPage:1,
            modelValuesPaginated:[],
            loading : true,
            loadingData : true,
            filterable : false,
            sortColumnName: null,
            sortColumnType:null,
            defaultDataLoadStep:defaultDataLoadStep
        };
    }

    componentDidMount() {

        this.processColumns();
      //  this.query();
    }

    query() {
        var self = this;
        const {elementObject,itemsPerPage, maxItems,defaultDataLoadStep} = this.state;
        var limitFirstLoad = maxItems && maxItems < defaultDataLoadStep?+maxItems:defaultDataLoadStep;
        var params = '?perPage='+limitFirstLoad;
        console.log('SORT',this.state.sortColumnName);
        if( this.state.sortColumnName){
          params += '&orderBy='+this.state.sortColumnName+'&orderType='+this.state.sortColumnType;
        }
        axios.get(ASSETS+'architect/extranet/'+elementObject.id+'/model_values/data/'+limitFirstLoad+'/'+params)
          .then(function (response) {
              if(response.status == 200
                  && response.data.modelValues !== undefined)
              {
                //console.log("ModelValues  :: componentDidMount => ",response.data.modelValues);
                console.log("CompleteObject  :: componentDidMount => ",response.data.totalPage);
                // en completeObject rengo el total de registros, por pagina, pagina, total de paginas, desde y hasta

                self.processData(response.data.modelValues);
                self.getAllData(response.data.totalPage);

              }

          }).catch(function (error) {
             console.log(error);
             self.setState({
               loading: false
             });
           });
    }

    getAllData(totalPages){

      const {elementObject,itemsPerPage, maxItems,defaultDataLoadStep} = this.state;
      var limitLoad = maxItems && maxItems < defaultDataLoadStep?+maxItems:defaultDataLoadStep;

      if(!maxItems || limitLoad < maxItems){
        var self = this;

        for(var page= 2;page<=totalPages;page++){

          axios.get(ASSETS+'architect/extranet/'+elementObject.id+'/model_values/data/'+limitLoad+'/?perPage='+limitLoad+'&page='+page)
            .then(function (response) {
                if(response.status == 200
                    && response.data.modelValues !== undefined)
                {
                  self.processData(response.data.modelValues);

                }

            }).catch(function (error) {
               console.log(error);
               self.setState({
                 loadingData: false
               });
             });

        }


      }

      this.setState({
        loadingData: false
      });
    }

    renderCell(field,identifier,row) {

      var value = row.original[identifier];

      if(field.type == "date") {
          //console.log("renderCell => ",field,row);
          if(row.original[identifier] !== undefined && row.original[identifier] != ""){

            if(field.settings !== undefined && field.settings.format !== undefined){
              switch(field.settings.format) {
                case 'day_month_year':
                  value = moment.unix(row.original[identifier]).format('DD/MM/YYYY')
                case 'month_year':
                  value = moment.unix(row.original[identifier]).format('MM/YYYY')
                case 'year':
                  value = moment.unix(row.original[identifier]).format('YYYY')
              }

            }

            value = moment.unix(row.original[identifier]).format('DD/MM/YYYY')
          }
      }

      if(field.type == "number") {
          //console.log("renderCell => ",field,row);
          if(row.original[identifier] !== undefined && row.original[identifier] != ""){

            if(field.settings !== undefined && field.settings.format !== undefined){
              switch(field.settings.format) {
                case 'price':
                  value = parseFloat(row.original[identifier]).toFixed(0) + '€';
                case 'price_with_decimals':
                  value = parseFloat(row.original[identifier]).toFixed(2) + '€';
              }
            }
          }
      }

      if(field.settings.hasRoute !== undefined){
        return <div dangerouslySetInnerHTML={{__html: value}} />
      }
      else {
        return value;
      }

    }

    processColumns() {

        const {elementObject} = this.state;

        var anySearchable = false;
        var columns = [];
        var sortColumnName = null;
        var sortColumnType = null;

        for(var index in elementObject.fields){
          if(elementObject.fields[index].rules.searchable && ! anySearchable){
            anySearchable = true;
          }

          var identifier = elementObject.fields[index].identifier.replace('.','');
          if(elementObject.fields[index].rules.sortableByDefault){
                sortColumnName  = identifier;
                sortColumnType = elementObject.fields[index].rules.sortableByDefault;
          }

          columns.push({
            accessor : identifier,
            Header: elementObject.fields[index].name,
            sortable: elementObject.fields[index].rules.sortable,
            filterable:  elementObject.fields[index].rules.searchable,
            filterMethod: this.filterMethod.bind(this,identifier),
            filterAll: true,
            Cell: this.renderCell.bind(this,elementObject.fields[index],identifier)
          });
        }

        this.setState({
            columns : columns,
            filterable : anySearchable,
            sortColumnName :sortColumnName,
            sortColumnType : sortColumnType
        }, this.query.bind(this)
      );
    }

    processData(data){

        for(var key in data){
          for( var subkey in data[key]){
            //remove . on keys to allow filter
            var newSubkey = subkey.replace('.','');
            //console.log("subkey => ",subkey);
            //console.log("newSubkey => ",newSubkey);
            data[key][newSubkey] = data[key][subkey];
          }
        }

        this.setState({
            data : [...this.state.data, ...data ],
            loading : false
        });
    }

    filterMethod(identifier, filter, rows, ) {
        //console.log("identifier => ",identifier);
        return matchSorter(rows, filter.value, { keys: [identifier] });
    }

    renderTable() {
      const {data, elementObject, itemsPerPage} = this.state;

      return (
        <ReactTable
          data={this.state.data}
          columns={this.state.columns}
          showPagination={this.state.pagination}
          defaultSorted={[
            {
              id: this.state.sortColumnName,
              desc: this.state.sortColumnType == 'DESC'?true:false
            }
          ]}
          defaultPageSize={this.state.maxItems && this.state.maxItems!= '' &&
            this.state.maxItems < this.state.itemsPerPage ?
            this.state.maxItems : this.state.itemsPerPage }
          loading={this.state.loading}
          filterable={true}
          defaultFilterMethod={(filter, row) =>
            String(row[filter.id]) === filter.value
          }
          //className="-striped -highlight"
          className=""
          previousText={<span><i className="fa fa-caret-left"></i> &nbsp; Précédente</span>}
          nextText={<span>Suivante &nbsp; <i className="fa fa-caret-right"></i></span>}
          loadingText={'Chargement...'}
          noDataText={'Aucune donnée trouvée'}
          pageText={'Page'}
          ofText={'de'}
          rowsText={'lignes'}
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
