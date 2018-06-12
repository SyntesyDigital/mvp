import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class SelectedFile extends Component {

    constructor(props)
    {
        super(props);
    }

    render() {
        return (
          <div className="image-container">
            <div className="pdf-preview"><i className="fa fa-file-pdf-o"></i></div>
            <ul>
              <li>
                <b>Nom arxiu</b> : {this.props.name}
              </li>
              <li>
                <b>Autor</b> : {this.props.author}
              </li>
            </ul>
          </div>
        );
    }
}

export default SelectedFile;
