import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';

export default class ElementFile extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;
        const doubleColumn = props.doubleColumn ? props.doubleColumn : false;

        this.state = {
            field : field,
            elementObject : elementObject,
            doubleColumn:doubleColumn,
            modelValues:[]
        };
    }

    componentDidMount() {
      this.query();
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
                console.log("ModelValues :: componentDidMount => ",response.data.modelValues);

                self.setState({
                  modelValues : response.data.modelValues
                });
              }

          }).catch(function (error) {
             console.log(error);
           });
    }

    renderItems() {
      const {modelValues, elementObject, doubleColumn} = this.state;
      var result = [];

      for(var key in modelValues){
        if(doubleColumn){
          result.push(
              <div className="col-md-6">
                {this.renderItemsColumn(1,key)}
              </div>
            );

          result.push(
              <div className="col-md-6">
                {this.renderItemsColumn(2,key)}
              </div>
            );

        }else{
          result.push(
              <div className="col-md-12">
                  {this.renderItemsColumn(0,key)}
              </div>
            );
        }

      }

      return result;
    }

    renderItemsColumn(column,key){
      const {modelValues, elementObject} = this.state;
      var numFieldsFirstColumn = parseInt(elementObject.fields.length)/2;
      var columnRows = [];

      var index = 0;
      for(var i in elementObject.fields){

        if(column == 1 && index < numFieldsFirstColumn){
          columnRows.push(
            this.renderField(elementObject.fields[i].name, modelValues[key][elementObject.fields[i].identifier])
          );
        }

        if(column == 2 && index >= numFieldsFirstColumn){
          columnRows.push(
            this.renderField(elementObject.fields[i].name, modelValues[key][elementObject.fields[i].identifier])
          );
        }

        if(column == 0){
          columnRows.push(
            this.renderField(elementObject.fields[i].name, modelValues[key][elementObject.fields[i].identifier])
          );
        }
        index++;
      }
      return columnRows;
    }

    renderField(name, value){
      return (<div className="element-file-input-container">
                <div className="col-xs-6 element-file-title">
                  {name}
                </div>
                <div className="col-xs-6 element-file-content">
                  {value}
                </div>
              </div>);
    }

    render() {
        return (
            <div className="row">
              {this.renderItems()}
            </div>
        );
    }
}

if (document.getElementById('elementFile')) {

   document.querySelectorAll('[id=elementFile]').forEach(function(element){
       var field = element.getAttribute('field');
       var elementObject = element.getAttribute('elementObject');
       var doubleColumn = element.getAttribute('doubleColumn');

       ReactDOM.render(<ElementFile
           field={field}
           elementObject={elementObject}
           doubleColumn={doubleColumn}
         />, element);
   });
}
