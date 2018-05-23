import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class MediaUploader extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div>
            hello :)
            </div>
        )
    }
}

if (document.getElementById('component-medias-uploader')) {
    ReactDOM.render(<MediaUploader />, document.getElementById('component-medias-uploader'));
}
