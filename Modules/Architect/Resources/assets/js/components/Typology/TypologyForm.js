import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class TypologyForm extends React.Component {

    constructor(props) {
        super(props);
    }


    render() {
        return (
            <div>
                
            </div>
        )
    }
}

if (document.getElementById('component-typology-form')) {
    ReactDOM.render(<TypologyForm />, document.getElementById('component-typology-form'));
}
