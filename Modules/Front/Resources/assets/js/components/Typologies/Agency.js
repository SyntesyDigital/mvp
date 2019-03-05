import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Agency extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount() {

    }

    render() {

      const field = this.props.field;

      return (
        <div className="Agency banc-media list-items buttons">
          <p className="titol">{field.name}</p>
          <p className="text">{field.address} | {field.postcode}</p>
          <p className="text">{field.city} | {field.country}</p>
          <p className="text">{field.phone_number}</p>
          <p className="text">{field.email}</p>
          <a href={field.web} target="_blank">{field.web}</a>
        </div>
      );

    }
}
export default Agency;
