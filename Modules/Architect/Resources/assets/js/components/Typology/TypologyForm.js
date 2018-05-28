import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import TypologyModal from './TypologyModal';
import TypologyBar from './TypologyBar';
import TypologyContainer from './TypologyContainer';

export default class TypologyForm extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            typology : props.typology !== undefined ? JSON.parse(atob(props.typology)) : ''
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
                    type : field.type
                });
            });

            this.typologyContainer.setState({
                typology : this.state.typology,
                fields : fields,
                inputs : {
                    name: this.state.typology.name,
                    identifier: this.state.typology.identifier,
                    icon: "one",
                    template: "",
                    slugOn: false,
                    slugCa: "",
                    slugEs: "",
                    slugEn: "",
                    categories: false,
                    tags: false,
                }
            });


        }
    }

    render() {
        return (
            <div>
                <TypologyContainer
                ref={(typologyContainer) => this.typologyContainer = typologyContainer}
                />
            </div>
        );
    }
}

if (document.getElementById('typology-form')) {
    var element = document.getElementById('typology-form');
    var typology = element.getAttribute('typology');
    ReactDOM.render(<TypologyForm typology={typology} />, element);
}
