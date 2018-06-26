import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import TypologyModal from './TypologyModal';
import TypologyBar from './TypologyBar';
import TypologyContainer from './TypologyContainer';



export default class TypologyForm extends Component {

    constructor(props)
    {
        super(props);

        // Set translations
        var translations = {};
        LANGUAGES.map(function(v,k){
            translations[v.iso] = true;
        });


        this.state = {
            typology : props.typology ? JSON.parse(atob(props.typology)) : '',
            fieldsList : FIELDS,
            translations: translations,
        };
    }

    componentDidMount()
    {
        if(this.state.typology) {
            // Build field list
            var fields = [];
            this.state.typology.fields.map(function(field){
                fields.push({
                    icon : field.icon,
                    id : field.id,
                    label : field.type,
                    name : field.name,
                    identifier : field.identifier,
                    type : field.type,
                    rules : field.rules,
                    settings : field.settings
                });
            });

            this.typologyContainer.setState({
                typology : this.state.typology,
                fields : fields,
                icon : this.state.typology.icon,
                inputs : {
                    name: this.state.typology.name,
                    identifier: this.state.typology.identifier,
                    icon: {
                      value : this.state.typology.icon,
                      label : this.state.typology.icon
                    },
                    template: "",
                    slug: null,
                    categories: false,
                    tags: false,
                }
            });
        }

        this.typologyContainer.setState({
            fieldsList: this.state.fieldsList
        });

    }

    render() {
        return (
            <div>
                <TypologyContainer
                  translations={this.state.translations}
                  ref={(typologyContainer) => this.typologyContainer = typologyContainer}
                />
            </div>
        );
    }
}

if (document.getElementById('typology-form')) {
    var element = document.getElementById('typology-form');
    var typology = element.getAttribute('typology');
    var fields = element.getAttribute('fields');
    ReactDOM.render(<TypologyForm fields={fields} typology={typology} />, element);
}
