import React, {Component} from 'react';
import { render } from 'react-dom';

class TypologyFields extends Component {

  render() {
    return (
      <div className="col-md-9 page-content">

        <div className="typology-field">
          <div className="field-type">
            <i className="fa fa-align-left"></i> &nbsp; Text Enriquit
          </div>

          <div className="field-inputs">
            <div className="row">
              <div className="field-name col-xs-6">
                <input type="text" className="form-control" name="name" placeholder="Nom"/>
              </div>
              <div className="field-id col-xs-6">
                <input type="text" className="form-control" name="field_id" placeholder="Idenfiticador"/>
              </div>
            </div>
          </div>

          <div className="field-actions">
            <a href=""> <i className="fa fa-en"></i> Configuració</a>
          </div>
        </div>

        <div className="typology-field">
          <div className="field-type">
            <i className="fa fa-map-marker"></i> &nbsp; Localització
          </div>

          <div className="field-inputs">
            <div className="row">
              <div className="field-name col-xs-6">
                <input type="text" className="form-control" name="name" placeholder="Nom"/>
              </div>
              <div className="field-id col-xs-6">
                <input type="text" className="form-control" name="field_id" placeholder="Idenfiticador"/>
              </div>
            </div>
          </div>

          <div className="field-actions">
            <a href=""> <i className="fa fa-en"></i> Configuració</a>
          </div>
        </div>

        <div className="fields-list-container">

          <div className="list-container-content">
            Arrosega camps en aquesta zona
          </div>
        </div>

      </div>
    );
  }

}
export default TypologyFields;
