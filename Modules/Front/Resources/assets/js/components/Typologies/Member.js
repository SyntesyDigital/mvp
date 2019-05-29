import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Member extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount() {

    }

    render() {

      const field = this.props.field;

      return (
        <div className="member banc-media list-items buttons">
          <p className="image">
            <img src={field.logo} />
          </p>
          <p className="titol">{field.name}</p>
          <p className="text">-</p>
          <p className="text">{field.address}</p>
          <p className="text">{field.web}</p>

          <a href={"#"+field.id} className="btn">Más Info</a>
        </div>
      );

    }
}
export default Member;
