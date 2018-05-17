import React, {Component} from 'react';
import { render } from 'react-dom';

class TypologyBar extends Component {

  render() {
    return (
      <div className="page-bar">
        <div className="container">
          <div className="row">

            <div className="col-md-12">
              <a href="" className="btn btn-default"> <i className="fa fa-angle-left"></i> </a>
              <h1>
                Nova tipologia
              </h1>

              <div className="float-buttons pull-right">
                <a href="" className="btn btn-primary"> <i className="fa fa-cloud-upload"></i> &nbsp; Guardar </a>
              </div>

            </div>
          </div>
        </div>
      </div>

    );
  }

}
export default TypologyBar;
