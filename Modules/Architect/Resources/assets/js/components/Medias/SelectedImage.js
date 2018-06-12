import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class SelectedImage extends Component {

    constructor(props)
    {
        super(props);
    }

    render() {
        return (
          <div className="image-container">
            <div className="image" style={{backgroundImage:"url("+this.props.url+")"}} ></div>

            {/*
            <a href="" className="btn btn-default"><i className="fa fa-pencil"></i> Editar</a>
            */}

            <ul>
              <li>
                <b>Nom arxiu</b> : {this.props.name}
              </li>
              {/*
              <li>
                <b>Llegenda</b> : Lleganda de la imatge
              </li>
              */}
              <li>
                <b>Mida original</b> : {this.props.dimension}
              </li>
              <li>
                <b>Pes original</b> : {this.props.filesize}
              </li>
              <li>
                <b>Autor</b> : {this.props.author}
              </li>
              <li>
                <a href="" className="btn btn-link" onClick={this.props.onEdit}><i className="fa fa-pencil"></i> Editar</a>
                {/*
                <a href="" className="btn btn-link text-danger"><i className="fa fa-trash"></i> Esborrar</a>
                */}
              </li>
            </ul>
          </div>
        );
    }
}

export default SelectedImage;
