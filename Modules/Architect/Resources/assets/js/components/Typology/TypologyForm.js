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
            typology : props.typology ? JSON.parse(atob(props.typology)) : '',
            fieldsList : FIELDS
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
                    slugOn: this.state.typology.has_slug,
                    slug: this.getSlugFromTypology(),
                    slugCa: "",
                    slugEs: "",
                    slugEn: "",
                    categories: this.state.typology.has_categories,
                    tags: this.state.typology.has_tags,
                }
            });
        }

        this.typologyContainer.setState({
            fieldsList: this.state.fieldsList
        });
    }

    getSlugFromTypology()
    {
        if(!this.state.typology) {
            return null;
        }

        var slugs = this.state.typology.attrs.filter(function(attr){
            return (attr.name == "slug");
        });

        var _slug = {};
        slugs.map(function(slug){
            return LANGUAGES.map(function(language){
                if(slug.language_id == language.id) {
                    _slug[language.iso] = slug.value;
                }
            });
        });

        return _slug;
    }

    render() {
        return (
            <div>
                <TypologyContainer
                typology={this.state.typology ? this.state.typology : null}
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
