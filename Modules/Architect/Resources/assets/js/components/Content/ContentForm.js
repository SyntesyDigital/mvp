import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ContentContainer from './ContentContainer';

export default class ContentForm extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            typology : props.typology ? JSON.parse(atob(props.typology)) : '',
            authors : props.users ? JSON.parse(atob(props.users)) : '',
            content : props.content ? JSON.parse(atob(props.content)) : '',
            languages : props.languages ? JSON.parse(atob(props.languages)) : '',
        };
    }

    componentDidMount()
    {
        // if(this.state.typology) {
        //     this.contentContainer.setState({
        //         typology : this.state.typology
        //     });
        // }
    }

    render() {
        return (
            <div>
                <ContentContainer
                languages={this.state.languages}
                authors={this.state.authors}
                typology={this.state.typology}
                content={this.state.content}
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
    var content = element.getAttribute('content');
    var languages = element.getAttribute('languages');
    ReactDOM.render(<ContentForm typology={typology} content={content} users={users} languages={languages} />, element);
}
