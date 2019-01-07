import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

class ModalEditUser extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          saving : false,
          contentSelected : null,
          isOpen : false,
          errors : '',
          routes : this.props.routes,
          fields : {
            lastname : '',
            firstname : '',
            email : '',
            telephone : '',
            password : '',
            password_confirmation : ''
          }
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    componentWillReceiveProps(nextProps)
    {
      if(nextProps.display){
          if(!this.state.isOpen){
            var editItem = nextProps.selectedItem !== undefined && nextProps.selectedItem != null ? nextProps.selectedItem : null;
            var fields = this.state.fields;

            if(editItem != null){
                this.setState({
                    'selectedItem': editItem
                });
                $.extend(fields,editItem);
            }
            this.modalOpen(fields);
          }
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

    modalOpen(fields)
    {
        TweenMax.to($("#content-select"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
        this.setState({
          isOpen : true,
          fields : fields
        });
    }

    modalClose() {

      var fields = this.state.fields;
      for(var key in fields){
        fields[key] = '';
      }

      var self =this;
        TweenMax.to($("#content-select"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
          self.setState({
            imageSelected : null,
            isOpen : false,
            fields : fields
          });
        }});
    }


    onUserSubmit(e) {
      e.preventDefault();
      var self = this;
      var user = this.state.selectedItem;
      var query = user ? axios.put(user.routes.update, this.state.fields) : axios.post(this.state.routes.create, this.state.fields);

      query
         .then((response) => {
             self.props.onUserSubmit();
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

      handleChange(e){

        const {fields} = this.state;

        fields[e.target.id] = e.target.value;

        this.setState({
          fields : fields
        });
      }


    render() {

        var zIndex = this.props.zIndex !== undefined ? this.props.zIndex : 10000;
        const {fields} = this.state;

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

                          <div className="col-md-offset-1 col-md-10 col-xs-12">

                            <div className="row">
                              <div className="col-md-6 form-group">
                                  <label htmlFor="name">Nom</label>
                                  <input type="text" className="form-control" id="lastname" name="modal[lastname]" placeholder="" value={fields.lastname} onChange={this.handleChange}/>
                              </div>
                              <div className="col-md-6 form-group">
                                  <label htmlFor="name">Prénom</label>
                                  <input type="text" className="form-control" id="firstname" name="modal[firstname]" placeholder="" value={fields.firstname} onChange={this.handleChange}/>
                              </div>
                              <div className="col-md-6 form-group">
                                  <label htmlFor="name">Email</label>
                                  <input type="text" className="form-control" id="email" name="modal[email]" placeholder="" value={fields.email} onChange={this.handleChange}/>
                              </div>
                              <div className="col-md-6 form-group">
                                  <label htmlFor="name">Telephone</label>
                                  <input type="text" className="form-control" id="telephone" name="modal[telephone]" placeholder="" value={fields.telephone} onChange={this.handleChange}/>
                              </div>

                              <div className="col-md-6 form-group">
                                  <label htmlFor="name">Mot de passe</label>
                                  <input type="password" className="form-control" id="password" name="modal[password]" minLength="6" placeholder=""value={fields.password} onChange={this.handleChange}/>
                              </div>
                              <div className="col-md-6 form-group">
                                  <label htmlFor="name">Confirmez le mot de passe</label>
                                  <input type="password" className="form-control" id="password_confirmation" name="modal[password_confirmation]" minLength="6" placeholder="" value={fields.password_confirmation} onChange={this.handleChange}/>
                              </div>
                            </div>


                          </div>

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
