import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';
import ListItem from './../Common/ListItem';
import ModalForm from './../Common/ModalForm';


export default class ContactForm extends Component {

    constructor(props)
    {
        super(props);
        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : ''
        };
    }

    processText(fields,fieldName){
      return fields[fieldName].value != null && fields[fieldName].value[LOCALE] !== undefined ?
        fields[fieldName].value[LOCALE] : '' ;
    }

    openForm(event) {
      event.preventDefault();


    }

    render() {

        const fields = this.state.field.fields;

        console.log("ContactForm :: ",fields);

        const title = this.processText(fields,0);

        return (
            <div>

                <ModalForm
                  csrf_token={this.props.csrf_token}
                />

                <button type="button" className="btn" onClick={this.openForm}>
                  {title}
                </button>
            </div>
        );
    }
}


if (document.getElementById('contact-form')) {
    var element = document.getElementById('contact-form');
    var field = element.getAttribute('field');
    var csrf_token = element.getAttribute('csrf_token');

    ReactDOM.render(<ContactForm
        field={field}
        csrf_token={csrf_token}
      />, element);
}
