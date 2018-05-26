import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import TypologyModal from './TypologyModal';
import TypologyBar from './TypologyBar';
import TypologyContainer from './TypologyContainer';

export default class TypologyForm extends Component {

    constructor(props)
    {
        super(props);

        this.state = {

        };

    }

    render() {
        return (
            <div>

                <TypologyContainer

                />
            </div>
        );
    }
}

if (document.getElementById('typology-form')) {

    ReactDOM.render(<TypologyForm />, document.getElementById('typology-form'));
}
