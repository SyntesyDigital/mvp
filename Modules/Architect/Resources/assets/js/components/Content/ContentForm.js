import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ContentContainer from './ContentContainer';

export default class ContentForm extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            typology : props.typology ? JSON.parse(atob(props.typology)) : '',
            authors : props.users ? JSON.parse(atob(props.users)) : ''
        };
    }

    componentDidMount()
    {
        if(this.state.typology) {
            this.contentContainer.setState({
                typology : this.state.typology
            });
        }
    }

    render() {
        return (
            <div>
                <ContentContainer
                authors={this.state.authors}
                ref={(contentContainer) => this.contentContainer = contentContainer}
                />
            </div>
        );
    }
}


if (document.getElementById('content-form')) {
    var element = document.getElementById('content-form');
    var typology = element.getAttribute('typology');
    var users = element.getAttribute('users');
    ReactDOM.render(<ContentForm typology={typology} users={users} />, element);
}
