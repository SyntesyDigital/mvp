import React, {Component} from 'react';
import { render } from 'react-dom';
import {connect} from 'react-redux';

import {openModalContents} from './../actions/';

/*
*

    link : null,
    {
      "content":1,
      "params" : {
        "id_pol" : "element_identifier",
        "id_per" : ""
      }
    }

    Como se sabra si esta bien definido ?
    Porque todos los params, si los tiene seran diferente de "",

    De donde se saca los parametros que tiene la ruta ?

    Cuando se selecciona el contenido que información tenemos ?
      Aqui no hay modal todavia.
      Yo creo que en ajuter podemos poner los parametros que tiene
      Necesitamos recuperar el id y los parametros en array []
      O su id ? yo creo mejor por el identifier porque es lo que vamos a construir la ruta.
      ['id_per','id_pol'], o quiza id : [1,2]



*/

class LinkSettingsField extends Component {

  constructor(props) {
    super(props);

    var checkbox = null;
    var input = "";
    var display = false;

    this.state = {
      checkbox : checkbox,
      link : null,
      display : display
    };

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);

  }

  componentDidMount(){
    this.processProps(this.props);
  }

  componentWillReceiveProps(nextProps){
    this.processProps(nextProps);
  }

  processProps(nextProps){
    var checkbox = null;
    var link = null;
    var display = false;

    //console.log("LinkSettingsField :: componentWillRecieveProps");
    //console.log(nextProps);

    if(nextProps.field != null && nextProps.field[nextProps.source] != null &&
       nextProps.field[nextProps.source][nextProps.name] !== undefined){

      checkbox = nextProps.field[nextProps.source][nextProps.name] != null;
      display = true;

      link = nextProps.field[nextProps.source][nextProps.name] == null ?
        '' : nextProps.field[nextProps.source][nextProps.name];
    }

    this.setState({
      checkbox : checkbox,
      link : link,
      display : display
    });
  }

  getDefaultValue() {
    return {
      content : null,
      params : {}
    };
  }

  handleFieldChange(event) {

    var field = {
      name : this.props.name,
      source : this.props.source,
      value : event.target.checked ?
        this.getDefaultValue() : null
    };

    this.props.onFieldChange(field);
  }

  handleInputChange(event) {

    var field = {
      name : this.props.name,
      source : this.props.source,
      value : event.target.value
    };

    this.props.onFieldChange(field);

  }

  onContentSelect(event) {
    event.preventDefault();

    this.props.openModalContents();
  }

  renderSelectedPage() {

    const pageValues = null;

    if(pageValues != null){
      return (
        <div className="field-form fields-list-container">

          <div className="typology-field">
            {pageValues.typology !== undefined && pageValues.typology != null &&
              <div className="field-type">
                {pageValues.typology.icon !== undefined &&
                  <i className={"fa "+pageValues.typology.icon}></i>
                }
                &nbsp; {pageValues.typology.name !== undefined ? pageValues.typology.name : ''}
              </div>
            }

            {(pageValues.typology === undefined || pageValues.typology == null) &&
              <div className="field-type">
                <i className="far fa-file"></i>
                &nbsp; {Lang.get('fields.page')}
              </div>
            }


            <div className="field-inputs">
              <div className="row">
                <div className="field-name col-xs-6">
                  {pageValues.title ? pageValues.title : ""}
                </div>
              </div>
            </div>

            <div className="field-actions">
              <a href="" className="remove-field-btn" onClick={this.onRemoveField}> <i className="fa fa-trash"></i> {Lang.get('fields.delete')} </a>
              &nbsp;&nbsp;
            </div>
          </div>

        </div>
      );
    }
    else {
      return (
        <div className="add-content-button">
          <a href="" className="btn btn-default" onClick={this.onContentSelect.bind(this)}><i className="fa fa-plus-circle"></i> {Lang.get('fields.select')} </a>
        </div>
      );
    }

  }

  render() {

    const {checkbox,input} = this.state;

    return (

      <div style={{display : this.state.display ? 'block' : 'none'}}>
        <div className="setup-field" >
          <div className="togglebutton">
            <label>
                <input type="checkbox"
                  name={this.props.name}
                  checked={ this.state.checkbox != null ? checkbox : false }
                  onChange={this.handleFieldChange}
                />
                {this.props.label}
            </label>
          </div>


          <div className="setup-field-config" style={{display : this.state.checkbox != null && this.state.checkbox ? "block" : "none" }}>
            <div className="form-group bmd-form-group">
               <label htmlFor="num" className="bmd-label-floating">{this.props.inputLabel}</label>
               {this.renderSelectedPage()}
            </div>
          </div>

        </div>
      </div>

    );
  }

}

const mapStateToProps = state => {
    return {
        contents: state.contents,
        app: state.app
    }
}

const mapDispatchToProps = dispatch => {
    return {
        openModalContents : () => {
            return dispatch(openModalContents());
        }
    };
}

export default connect(mapStateToProps, mapDispatchToProps)(LinkSettingsField);
