import React, {Component} from 'react';
import { render } from 'react-dom';
import axios from 'axios';

class ContentBar extends Component {

  constructor(props){
    super(props);
  }

  duplicate(){
      axios.post('/architect/contents/' + this.props.content.id + '/duplicate', {})
          .then((response) => {
              if(response.data.content) {
                  window.location.href = "/architect/contents/" + response.data.content.id;
              }
          })
          .catch((error) => {
              //console.log(error.config);
          });
  }

  saveLayout(e) {
      e.preventDefault();
      this.props.onLayoutSave != undefined ? this.props.onLayoutSave() : null;
  }

  loadLayout(e) {
      e.preventDefault();
      this.props.onLoadLayout != undefined ? this.props.onLoadLayout() : null;
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
                            <a href="#" onClick={this.duplicate.bind(this)}>
                                <i className="fa fa-files-o"></i>
                                &nbsp;Duplicar
                            </a>
                        </li>

                        {this.props.onLoadLayout &&
                        <li>
                            <a href="#" onClick={this.loadLayout.bind(this)}>
                                <i className="fa fa-download"></i>
                                &nbsp;Carregar plantilla
                            </a>
                        </li>
                        }

                        {this.props.onLayoutSave &&
                        <li>
                            <a href="#" onClick={this.saveLayout.bind(this)}>
                                <i className="fa fa-upload"></i>
                                &nbsp;Guardar plantilla
                            </a>
                        </li>
                        }

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
