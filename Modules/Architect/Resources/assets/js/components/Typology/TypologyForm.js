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

    exploteToObject(fields) {

  		if(fields == null){
  			return null;
  		}

  		var result = {};

  		for(var i=0;i<fields.length;i++){
  			result[fields[i]] = null;
  		}
  		return result;
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
                    settings : field.settings,
                    saved : true,
                    editable : field.type == FIELDS.SLUG.type ? false : true
                });
                //console.log("field text => ",field);
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
        else {
          var fields = [];

          //add title
          fields.push({
            icon : FIELDS.TEXT.icon,
            id : 0,
            label : FIELDS.TEXT.name,
            name : "Títol",
            identifier : "title",
            type : FIELDS.TEXT.type,
            rules : this.exploteToObject(FIELDS.TEXT.rules),
      			settings : this.exploteToObject(FIELDS.TEXT.settings),
            saved : false,
            editable : true
          });

          fields[0].rules["required"] = true;
          fields[0].settings["entryTitle"] = true;

          //add slug
          fields.push({
            icon : FIELDS.SLUG.icon,
            id : 1,
            label : FIELDS.SLUG.name,
            name : "Slug",
            identifier : "slug",
            type : FIELDS.SLUG.type,
            rules : this.exploteToObject(FIELDS.SLUG.rules),
      			settings : this.exploteToObject(FIELDS.SLUG.settings),
            saved : false,
            editable : false
          });

          fields[1].rules["required"] = true;
          fields[1].rules["unique"] = true;

          this.typologyContainer.setState({
            fields : fields
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
