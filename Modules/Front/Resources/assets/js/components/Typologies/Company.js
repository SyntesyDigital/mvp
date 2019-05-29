import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Company extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount() {

    }

    render() {

      const field = this.props.field;

      return (
        <div className="company banc-media list-items buttons">
          <a href={field.web} target="_blank" className="titol">{field.name}</a>
          <p className="text">{field['description_'+LOCALE]}</p>
          <p className="text">{field.address} | {field.postcode}</p>
          <a href={field.web} target="_blank">{field.web}</a>
        </div>
      );

    }
}
export default Company;
