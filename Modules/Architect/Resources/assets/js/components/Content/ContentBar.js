import React, {Component} from 'react';
import { render } from 'react-dom';

class ContentBar extends Component {

  constructor(props){
    super(props);

    console.log("ContentBar => ",props);

  }

  render() {
    return (
      <div className="page-bar">
        <div className="container">
          <div className="row">

            <div className="col-md-12">
              <a href={routes.contents} className="btn btn-default"> <i className="fa fa-angle-left"></i> </a>
              <h1>
                {this.props.icon != "" &&
                  <i className={"fa "+this.props.icon}></i>
                }
                {'\u00A0'}

                { this.props.name != "" ? this.props.name : "Nou contingut" }

              </h1>

              <div className="float-buttons pull-right">

              { this.props.content !== undefined && this.props.content != null && !architect.currentUserHasRole('author') &&
                <div className="actions-dropdown">
                  <a href="#" className="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
                    Accions
                    <b className="caret"></b>
                    <div className="ripple-container"></div>
                  </a>
                    <ul className="dropdown-menu dropdown-menu-right default-padding">
                        <li className="dropdown-header"></li>
                        <li>
                            <a href="#">
                                <i className="fa fa-plus-circle"></i>
                                &nbsp;Nou
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i className="fa fa-files-o"></i>
                                &nbsp;Duplicar
                            </a>
                        </li>
                        <li>
                            <a href="#" className="text-danger">
                                <i className="fa fa-trash text-danger"></i>
                                &nbsp;
                                <span className="text-danger">Esborrar</span>
                            </a>
                        </li>
                    </ul>
                  </div>
                }

                { this.props.content !== undefined && this.props.content != null &&
                  <a href={routes['previewContent'].replace(':id',this.props.content.id)} target="_blank" className="btn btn-default" > <i className="fa fa-eye"></i> &nbsp; Previsualitzar </a>
                }
                <a href="" className="btn btn-primary" onClick={this.props.onSubmitForm} > <i className="fa fa-cloud-upload"></i> &nbsp; Guardar </a>
              </div>

            </div>
          </div>
        </div>
      </div>

    );
  }

}
export default ContentBar;
