import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ContentContainer from './ContentContainer';

export default class ContentForm extends Component {

    render() {
        return (
            <div>

                <ContentContainer

                />
            </div>
        );
    }
}

if (document.getElementById('content-form')) {

    ReactDOM.render(<ContentForm />, document.getElementById('content-form'));
}
