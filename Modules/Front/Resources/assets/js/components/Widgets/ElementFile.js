import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';

export default class ElementFile extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const collapsable = props.collapsable ? props.collapsable : null;
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;

        this.state = {
            field : field,
            collapsable : collapsable,
            elementObject : elementObject,
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
      const {modelValues, elementObject} = this.state;
      var result = [];

      for(var key in modelValues){
        for(var i in elementObject.fields){
          console.log('ELEMENT XXX:',elementObject.fields[i] );
          result.push(
                <div className="col-md-6">
                  <div className="element-file-input-container">
                    <div className="col-xs-6 element-file-title">
                      <i className={elementObject.fields[i].icon}></i> {elementObject.fields[i].name}
                    </div>
                    <div className="col-xs-6 element-file-content">
                      {modelValues[key][elementObject.fields[i].identifier]}
                    </div>
                  </div>
                </div>
            );
        }
      }
      return result;
    }

    render() {

        return (
          <div id="collapsetable" className="element-file-container-body collapse in">
            <div className="row">
              {this.renderItems()}
            </div>
          </div>
        );
    }
}

if (document.getElementById('elementFile')) {

   document.querySelectorAll('[id=elementFile]').forEach(function(element){
       var field = element.getAttribute('field');
       var collapse = element.getAttribute('collapse');
       var elementObject = element.getAttribute('elementObject');

       ReactDOM.render(<ElementFile
           field={field}
           collapse={collapse}
           elementObject={elementObject}
         />, element);
   });
}
