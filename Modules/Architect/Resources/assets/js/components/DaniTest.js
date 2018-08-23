import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class DaniTest extends Component {
    render() {
        return (
            <div>
              Hello World!
              
            </div>
        );
    }
}

if (document.getElementById('dani-test')) {
    ReactDOM.render(<DaniTest />, document.getElementById('dani-test'));
}
