import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import UserForm from './UserForm';

class ModalEditUser extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          saving : false,
          contentSelected : null,
          isOpen : false,
          errors : ''
        };

        this.onModalClose = this.onModalClose.bind(this);
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
        this.props.onUserCancel();


    }

    componentDidMount(){
      //this.modalOpen();
    }

    modalOpen()
    {
        TweenMax.to($("#content-select"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
        this.setState({
          isOpen : true
        });
    }

    modalClose() {
      var self =this;
        TweenMax.to($("#content-select"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
          self.setState({
            imageSelected : null,
            isOpen : false
          });
        }});
    }


    onUserSubmit(e) {

      e.preventDefault();

      //process the Form
      var userAttributes = this.userForm.getAttributes();
      console.log("ModalEditUser :: userAttributes => ",userAttributes);

      var self = this;

      //TODO save the user info
      /*
      axios.post('/architect/customer/user/store', userAttributes)
         .then((response) => {
             if(response.data.success) {
                 self.props.onUserSubmit();
             }
         })
         .catch((error) => {
             if (error.response) {
                 self.onSaveError(error.response.data);
             } else if (error.message) {
                 toastr.error(error.message);
             } else {
                 console.log('Error', error.message);
             }

         });
      */

    }

    onSaveError(response)
    {
        var errors = response.errors ? response.errors : null;
        var _this = this;
        var stateErrors = {};

        if(errors) {

            var fields = errors.fields ? errors.fields : null;

            if(fields) {
                fields.map(function(field){
                   Object.keys(field).map(function(identifier){
                       stateErrors[identifier] = field[identifier];
                   })
                });
            }

        }

        console.log('ERROR ====>', stateErrors);

        this.setState({
          errors : stateErrors
        });

        if(response.message) {
            toastr.error(response.message);
        }
      }


    render() {

        var zIndex = this.props.zIndex !== undefined ? this.props.zIndex : 10000;
        //only linkable contents

        //console.log("ModalEditUser :: Field => ",this.props.field,route);

        return (
          <div style={{zIndex:zIndex}}>
            <div className="custom-modal" id="content-select">
              <div className="modal-background"></div>


                <div className="modal-container">
                    <div className="modal-header">

                        <h2>{this.props.user_id != null ? 'Edit User ' : 'Create user' } </h2>

                      <div className="modal-buttons">
                        <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                          <i className="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                  <div className="modal-content">
                    <div className="container">
                      <div className="row">
                        <div className="col-xs-12">

                            <UserForm
                              ref={m => { this.userForm = m; }}
                            />

                        </div>
                      </div>
                    </div>

                    <div className="modal-footer">
                      <a href="" className="btn btn-default" onClick={this.onModalClose}> {Lang.get('modals.cancel')}</a> &nbsp;
                      <a href="" className="btn btn-primary" onClick={this.onUserSubmit.bind(this)}> {Lang.get('modals.accept')}</a> &nbsp;
                    </div>

                  </div>

              </div>
            </div>
          </div>
        );
    }
}

export default ModalEditUser;
