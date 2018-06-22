import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ContentContainer from './ContentContainer';
import PageContainer from './Page/PageContainer';

export default class ContentForm extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            typology : props.typology ? JSON.parse(atob(props.typology)) : '',
            authors : props.users ? JSON.parse(atob(props.users)) : '',
            content : props.content ? JSON.parse(atob(props.content)) : '',
            fields : props.fields ? JSON.parse(atob(props.fields)) : '',
            tags : props.tags ? JSON.parse(atob(props.tags)) : '',
            categories : props.categories ? JSON.parse(atob(props.categories)) : '',
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

        const page = false;

        console.log("languages : ",this.state.languages);

        return (
            <div>
                {!page &&
                  <ContentContainer
                    authors={this.state.authors}
                    typology={this.state.typology}
                    content={this.state.content}
                    fields={this.state.fields}
                    categories={this.state.categories}
                    tags={this.state.tags}
                    ref={(contentContainer) => this.contentContainer = contentContainer}
                />

                }

                {page &&
                  <PageContainer
                    authors={this.state.authors}
                    typology={this.state.typology}
                    content={this.state.content}
                    ref={(contentContainer) => this.contentContainer = contentContainer}
                  />
                }
            </div>
        );
    }
}


if (document.getElementById('content-form')) {
    var element = document.getElementById('content-form');
    var typology = element.getAttribute('typology');
    var users = element.getAttribute('users');
    var content = element.getAttribute('content');
    var fields = element.getAttribute('fields');
    var tags = element.getAttribute('tags');
    var categories = element.getAttribute('categories');

    ReactDOM.render(<ContentForm tags={tags} categories={categories} fields={fields} typology={typology} content={content} users={users} />, element);
}
