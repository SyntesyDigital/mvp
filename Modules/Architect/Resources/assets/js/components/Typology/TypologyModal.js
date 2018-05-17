import React, {Component} from 'react';
import { render } from 'react-dom';

class TypologyModal extends Component {

  render() {
    return (
      <div className="custom-modal">
        <div className="modal-background"></div>

        <div className="modal-container">
          <div className="modal-header">
            <i className="fa fa-font"></i>
            <h2>Nom camp | Cofiguració</h2>
            <h3></h3>

            <div className="modal-buttons">
              <a className="btn btn-default close-button-modal" href="#">
                <i className="fa fa-times"></i>
              </a>
            </div>
          </div>
          <div className="modal-content">
            <div className="container">
              <div className="row">
                <div className="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

                  <div className="setup-field">
                    <div className="togglebutton">
                      <label>
                          <input type="checkbox" />
                          Camp obligatori
                      </label>
                    </div>
                  </div>

                  <div className="setup-field">
                    <div className="togglebutton">
                      <label>
                          <input type="checkbox" />
                          Camp únic
                      </label>

                    </div>
                  </div>

                  <div className="setup-field">
                    <div className="togglebutton">
                      <label>
                          <input type="checkbox" />
                          Número de caràcters
                      </label>
                    </div>

                    <div className="setup-field-config">
                      <div className="form-group bmd-form-group">
                         <label htmlFor="num" className="bmd-label-floating">Número caràcters</label>
                         <input type="text" className="form-control" id="num"/>
                      </div>
                    </div>

                  </div>

                  <div className="setup-field">
                    <div className="togglebutton">
                      <label>
                          <input type="checkbox" />
                          Tipografias permitidas
                      </label>
                    </div>

                    <div className="setup-field-config">

                      <div className="form-group bmd-form-group">



                        <label className="form-check-label">
                            <input className="form-check-input" type="checkbox" value=""/>
                            News
                        </label>

                        &nbsp;&nbsp;

                        <label className="form-check-label">
                            <input className="form-check-input" type="checkbox" value=""/>
                            Page
                        </label>

                      </div>
                    </div>

                  </div>

                  <div className="setup-field">
                    <div className="togglebutton">
                      <label>
                          <input type="checkbox" />
                          Número de caràcters
                      </label>
                    </div>

                    <div className="setup-field-config">
                      <div className="form-group bmd-form-group">
                         <label htmlFor="num" className="bmd-label-floating">Número caràcters</label>
                         <input type="text" className="form-control" id="num"/>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>

            <div className="modal-footer">
              <a href="" className="btn btn-default"> Tancar </a> &nbsp;
              <a href="" className="btn btn-primary"> Guardar </a>
            </div>

          </div>
        </div>
      </div>
    );
  }

}
export default TypologyModal;
