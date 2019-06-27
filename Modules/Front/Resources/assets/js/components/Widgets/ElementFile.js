import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';

export default class ElementFile extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const collapsable = props.collapsable ? props.collapsable : null;
        const elementFields = props.elementFields ? JSON.parse(atob(props.elementFields)) : null;
        const elementObject = props.elementObject ? JSON.parse(atob(props.elementObject)) : null;

        this.state = {
            field : field,
            collapsable : collapsable,
            elementFields: elementFields,
            elementObject : elementObject
        };
    }

    componentDidMount() {
      //this.query();
    }

    /*query(page,filters) {
        var self = this;

        axios.post(ASSETS+'api/contents',params)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                var old_items = self.state.items;
                if(response.data.meta.current_page != 1){
                  old_items.push.apply(old_items, response.data.data);
                }else{
                  old_items =response.data.data;
                }
                  self.setState({
                      items : old_items,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      filters : filters
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }*/
    renderValue(element) {

      return element.name
    }


    renderItems() {
      const {elementFields} = this.state;
      var result = [];

      for(var key in elementFields){
        console.log('ELEMENT XXX:',elementFields[key] );
          result.push(
              <div className="col-md-6">
                <div className="element-file-input-container">
                  <div className="col-xs-6 element-file-title">
                    <i className={elementFields[key].icon}></i> {elementFields[key].name}
                  </div>
                  <div className="col-xs-6 element-file-content">
                    {this.renderValue(elementFields[key])}
                  </div>
                </div>
              </div>
          );
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
       var elementFields = element.getAttribute('elementFields');

       ReactDOM.render(<ElementFile
           field={field}
           collapse={collapse}
           elementObject={elementObject}
           elementFields={elementFields}
         />, element);
   });
}
