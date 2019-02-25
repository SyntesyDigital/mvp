import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ModelContainer from './ModelContainer';


export default class ModelForm extends Component {

    constructor(props)
    {
        super(props);

        // Set translations
        var translations = {};
        LANGUAGES.map(function(v,k){
            translations[v.iso] = true;
        });

        this.state = {
            model : props.model ? JSON.parse(atob(props.model)) : '',
            fieldsList : MODELS.sinister.fields,
            translations: translations,
        };
    }

    componentDidMount()
    {
        if(this.state.model) {
            // Build field list

            var fields = [];
            this.state.model.fields.map(function(field){
                fields.push({
                    icon : field.icon,
                    id : field.id,
                    label : field.label,
                    name : field.name,
                    identifier : field.identifier,
                    type : field.type,
                    saved : true,
                    editable : true
                });
                //console.log("field text => ",field);
            });

            this.modelContainer.setState({
                model : this.state.model,
                fields : fields,
                icon : this.state.model.icon,
                inputs : {
                    name: this.state.model.name,
                    identifier: this.state.model.identifier,
                    icon: {
                      value : this.state.model.icon,
                      label : this.state.model.icon
                    }
                }
            });
        }
        else {
          var fields = [];

          this.modelContainer.setState({
            fields : fields
          });

        }
    }

    render() {
        return (
            <div>
                {
                <ModelContainer
                    model={this.state.model ? this.state.model : null}
                    ref={(modelContainer) => this.modelContainer = modelContainer}
                    translations={this.state.translations}
                    fieldsList={this.state.fieldsList}
                />
                }
            </div>
        );
    }
}

if (document.getElementById('model-form')) {
    var element = document.getElementById('model-form');
    var model = element.getAttribute('model');

    ReactDOM.render(<ModelForm model={model} />, element);
}
