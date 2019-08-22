import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './TextField';

import {
  getFieldComponent
} from './../actions/';

class ModalListField extends Component {

  constructor(props){
    super(props);

    //console.log(" ModalListField :: construct ",props);

    this.state = {
      values : {}
    };

    this.onModalClose = this.onModalClose.bind(this);
  }

  componentDidMount() {

    if(this.props.display){
        this.modalOpen();
    }

  }

  componentWillReceiveProps(nextProps)
  {
    if(nextProps.display){
        this.modalOpen();
    } else {
        this.modalClose();
    }
  }

  onModalClose(e){
      e.preventDefault();
      this.props.onModalClose();
  }

  modalOpen()
  {
    $('body').css({overflow:'hidden'});
    TweenMax.to($("#modal-list-field"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
  }

  modalClose() {

    var self = this;
      TweenMax.to($("#modal-list-field"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
        $('body').css({overflow:'auto'});
      }});
  }



  renderItems() {

    if(this.props.fields === undefined || this.props.fields == null){
      return null;
    }

    var fields = [];

    for(var key in this.props.fields) {
      var field = this.props.fields[key];
      const FieldComponent = getFieldComponent(field.type);
      fields.push(<FieldComponent
          key={key}
          field={field}
          value={this.state.values[field.identifier]}
          onFieldChange={this.handleOnChange}
        />);
    }

    return fields;

  }

  render() {

    return (
      <div
        className="custom-modal"
        id="modal-list-field"
        style={{
          zIndex: this.props.zIndex !== undefined ? this.props.zIndex : 500
        }}
      >
          <div className="modal-background"></div>


          <div className="modal-container">
            <div className="modal-header">
              <h2>Ajouter contact</h2>

              <div className="modal-buttons">
                <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                  <i className="fa fa-times"></i>
                </a>
              </div>
            </div>

            <div className="modal-content">

              <div className="row">
                <div className="col-xs-12 col-md-10 col-md-offset-1">
                  {this.renderItems()}
                </div>
              </div>

              <div className="modal-footer">

                <a href="" className="btn btn-default" onClick={this.onModalClose}>
                  <i className="fa fa-angle-left"></i> Retour
                </a> &nbsp;
                <a href="" className="btn btn-primary" onClick={this.onModalClose}>
                  <i className="fas fa-plus"></i> Ajouter
                </a>
              </div>

            </div>
         </div>
      </div>
    );
  }

}

export default ModalListField;
