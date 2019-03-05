import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';
import ListItem from './../Common/ListItem';
import ModalFormPress from './../Common/ModalFormPress';
import ModalThanks from './../Common/ModalThanks';


export default class ContactFormPress extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';

        this.state = {
            field : field,
            displayModal : false,
            displayThanks : false,
        };
    }

    processText(fields,fieldName){
      return fields[fieldName].value != null && fields[fieldName].value[LOCALE] !== undefined ?
        fields[fieldName].value[LOCALE] : '' ;
    }

    openForm(event) {
      event.preventDefault();

      this.setState({
        displayModal : true
      });
    }

    handleModalClose() {
      this.setState({
        displayModal : false
      });
    }

    handleFormSubmited() {
      this.setState({
        displayModal : false,
        displayThanks : true
      });
    }

    handleThanksClose() {
      this.setState({
        displayThanks : false
      });
    }

    render() {

        const fields = this.state.field.fields;

        const title = this.processText(fields,0);

        return (
            <div>

                <ModalFormPress
                  csrf_token={this.props.csrf_token}
                  display={this.state.displayModal}
                  onModalClose={this.handleModalClose.bind(this)}
                  onSubmitSuccess={this.handleFormSubmited.bind(this)}
                />

                <ModalThanks
                  id="modal-thanks-press"
                  display={this.state.displayThanks}
                  onModalClose={this.handleThanksClose.bind(this)}
                />

                <button type="button" className="btn" onClick={this.openForm.bind(this)}>
                  {title}
                </button>
            </div>
        );
    }
}

if (document.getElementById('contact-form-press')) {

    document.querySelectorAll('[id=contact-form-press]').forEach( element => {

        var field = element.getAttribute('field');
        var csrf_token = element.getAttribute('csrf_token');

        ReactDOM.render(<ContactFormPress
            field={field}
            csrf_token={csrf_token}
          />, element);
    });
}
