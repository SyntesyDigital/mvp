import React, {Component} from 'react';
import { render } from 'react-dom';

import BooleanSettingsField from './Settings/BooleanSettingsField';
import InputSettingsField from './Settings/InputSettingsField';
import CheckboxesSettingsField from './Settings/CheckboxesSettingsField';
import SelectorSettingsField from './Settings/SelectorSettingsField';

class TypologyModal extends Component {

  constructor(props) {
    super(props);

    this.handleFieldSettingsChange = this.handleFieldSettingsChange.bind(this);

  }

  handleFieldSettingsChange(field) {
      this.props.onSettingsFieldChange(field);
  }

  handleInputSettingsChange(event) {

  }

  render() {
    return (
      <div className="custom-modal" id={this.props.id}>
        <div className="modal-background"></div>


          <div className="modal-container">
            {this.props.field != null &&
              <div className="modal-header">

                  <i className={"fa "+this.props.field.icon}></i>
                  <h2>{this.props.field.name} | Cofiguració</h2>

                <div className="modal-buttons">
                  <a className="btn btn-default close-button-modal" onClick={this.props.onModalClose}>
                    <i className="fa fa-times"></i>
                  </a>
                </div>
              </div>
            }
            <div className="modal-content">
              <div className="container">
                <div className="row">
                  <div className="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

                    <BooleanSettingsField
                      field={this.props.field}
                      name="required"
                      onFieldChange={this.handleFieldSettingsChange}
                      label="Camp obligatori"
                    />


                    <InputSettingsField
                      field={this.props.field}
                      name="maxCharacters"
                      onFieldChange={this.handleFieldSettingsChange}
                      label="Caràcters màxims"
                      inputLabel="Indica el número màxim de caràcters"
                    />

                    <InputSettingsField
                      field={this.props.field}
                      name="fieldHeight"
                      onFieldChange={this.handleFieldSettingsChange}
                      label="Alçada del camp"
                      inputLabel="Indica la alçada en pixels"
                    />

                    <CheckboxesSettingsField
                      field={this.props.field}
                      name="typesAllowed"
                      onFieldChange={this.handleFieldSettingsChange}
                      label="Tipologies permeses"
                      options={[
                        {name:"Categories",value:1},
                        {name:"Events",value:2}
                      ]}
                    />

                    <SelectorSettingsField
                      field={this.props.field}
                      name="selectedList"
                      onFieldChange={this.handleFieldSettingsChange}
                      label="Llista seleccionada"
                      options={[
                        {name:"Llista 1",value:1},
                        {name:"Llista 2",value:2}
                      ]}
                    />


                  </div>
                </div>
              </div>

              <div className="modal-footer">
                <a href="" className="btn btn-default" onClick={this.props.onModalClose}> Tancar </a> &nbsp;
                {/*
                <a href="" className="btn btn-primary"> Guardar </a>
                */
                }
              </div>

            </div>
        </div>
        }
      </div>
    );
  }

}
export default TypologyModal;
