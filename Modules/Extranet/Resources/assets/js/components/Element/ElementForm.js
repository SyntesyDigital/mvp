import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ElementContainer from './ElementContainer';


export default class ElementForm extends Component {

    constructor(props)
    {
        super(props);

        // Set translations
        var translations = {};
        LANGUAGES.map(function(v,k){
            translations[v.iso] = true;
        });

        this.state = {
            element : props.element ? JSON.parse(atob(props.element)) : '',
            model : props.model ? JSON.parse(atob(props.model)) : '',
            fieldsList :  props.fields ? JSON.parse(atob(props.fields)) : '',
            translations: translations,
        };

    }

    componentDidMount()
    {
        if(this.state.element) {
            // Build field list

            var fields = [];
            this.state.element.fields.map(function(field){
                fields.push({
                    icon : field.icon,
                    id : field.id,
                    label : field.label,
                    name : field.name,
                    identifier : field.identifier,
                    type : field.type,
                    input : field.input,
                    form_name : field.form_name,
                    saved : true,
                    editable : true
                });
                //console.log("field text => ",field);
            });

            this.elementContainer.setState({
                element : this.state.element,
                fields : fields,
                icon : this.state.element.icon,
                inputs : {
                    name: this.state.element.name,
                    identifier: this.state.element.identifier,
                    icon: {
                      value : this.state.element.icon,
                      label : this.state.element.icon
                    }
                }
            });
        }
        else {
          var fields = [];

          this.elementContainer.setState({
            fields : fields
          });

        }
    }

    render() {
        return (
            <div>
                {
                <ElementContainer
                    element={this.state.element ? this.state.element : null}
                    ref={(elementContainer) => this.elementContainer = elementContainer}
                    translations={this.state.translations}
                    fieldsList={this.state.fieldsList}
                />
                }
            </div>
        );
    }
}

if (document.getElementById('element-form')) {
    var htmlElement = document.getElementById('element-form');

    ReactDOM.render(<ElementForm
      element={htmlElement.getAttribute('element')}
      fields={htmlElement.getAttribute('fields')}
      model={htmlElement.getAttribute('model')}
    />, htmlElement);
}
