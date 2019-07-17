import React, {Component} from 'react';
import { render } from 'react-dom';
import {connect} from 'react-redux';

import {openModalContents, clearContent} from './../actions/';

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
      display : display,
      content : null
    };

    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);

  }

  componentDidMount(){
    this.processProps(this.props);
  }

  componentWillReceiveProps(nextProps){

    //to check if need to proces or not
    var contentUpdated = false;

    if(nextProps.contents.content != null ) {
        //update the content
        var updateContent = false;
        if(this.state.content != null) {
          //check if is not the same to avoid multiple updates
          if(this.state.content.id !=nextProps.contents.content.id){
            //is different update
            updateContent = true;
          }
        }
        else {
          //just update
          updateContent = true;
        }

        if(updateContent){
            this.handleContentUpdate(nextProps.contents.content);
            contentUpdated = true;
        }
    }
    else if(nextProps.contents.content == null && this.state.content != null){
        //delete the content
        this.handleContentUpdate(null);
        contentUpdated = true;
    }

    //if not updated then process props, if updated it will come here after update
    if(!contentUpdated) {
      this.processProps(nextProps);
    }
  }

  processProps(nextProps){
    var checkbox = null;
    var link = null;
    var display = false;
    var content = null;

    //console.log("LinkSettingsField :: componentWillRecieveProps");
    //console.log(nextProps);

    if(nextProps.field != null && nextProps.field[nextProps.source] != null &&
       nextProps.field[nextProps.source][nextProps.name] !== undefined){

      checkbox = nextProps.field[nextProps.source][nextProps.name] != null;
      display = true;

      link = nextProps.field[nextProps.source][nextProps.name] == null ?
        '' : nextProps.field[nextProps.source][nextProps.name];
    }

    if(nextProps.contents.content != null){
      content = nextProps.contents.content;
    }

    this.setState({
      checkbox : checkbox,
      link : link,
      display : display,
      content : content
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

  handleContentUpdate(content) {

    var contentValue = {
      content : null,
      params : {}
    };

    if(content != null){
      contentValue.content = content;
    }

    var field = {
      name : this.props.name,
      source : this.props.source,
      value : contentValue
    };

    //update the state for comparision
    this.setState({
      content : content
    });

    //propagate to main field
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

  onRemoveField(event) {
    event.preventDefault();

    this.props.clearContent();
  }

  renderSelectedPage() {

    const {content} = this.state;

    if(content != null){
      return (
        <div className="field-form fields-list-container">

          <div className="typology-field">
            <div className="field-type">
              <i className="far fa-file"></i>
              &nbsp; {Lang.get('fields.page')}
            </div>

            <div className="field-inputs">
              <div className="row">
                <div className="field-name col-xs-6">
                  {content.title ? content.title : ""}
                </div>
              </div>
            </div>

            <div className="field-actions">
              <a href="" className="remove-field-btn" onClick={this.onRemoveField.bind(this)}> <i className="fa fa-trash"></i> {Lang.get('fields.delete')} </a>
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
        },
        clearContent : () => {
            return dispatch(clearContent());
        }
    };
}

export default connect(mapStateToProps, mapDispatchToProps)(LinkSettingsField);
