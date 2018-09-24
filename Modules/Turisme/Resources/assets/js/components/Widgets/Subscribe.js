import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ModalFormNewsletter from './../Common/ModalFormNewsletter';
import ModalThanks from './../Common/ModalThanks';


export default class Subscribe extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';

        this.state = {
            field : field,
            displayModal : false,
            displayThanks : false,
            email : ''
        };
    }

    onFieldChange(e){

      const state = this.state;

      state[e.target.name] = e.target.value;

      this.setState(state);
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

        return (
            <div>

                <ModalFormNewsletter
                  csrf_token={this.props.csrf_token}
                  initEmail={this.state.email}
                  display={this.state.displayModal}
                  onModalClose={this.handleModalClose.bind(this)}
                  onSubmitSuccess={this.handleFormSubmited.bind(this)}
                />

                <ModalThanks
                  display={this.state.displayThanks}
                  onModalClose={this.handleThanksClose.bind(this)}
                />

                <form action="#" className="subscribe-form">
                  <input type="email" name="email" value={this.state.email} onChange={this.onFieldChange.bind(this)}/>
                  <input type="submit" className="email-btn" onClick={this.openForm.bind(this)} />
                </form>
            </div>
        );
    }
}

if (document.getElementById('subscribe')) {

    document.querySelectorAll('[id=subscribe]').forEach( element => {

      var field = element.getAttribute('field');
      var csrf_token = element.getAttribute('csrf_token');

      ReactDOM.render(<Subscribe
          field={field}
          csrf_token={csrf_token}
        />, element);
    });
}
