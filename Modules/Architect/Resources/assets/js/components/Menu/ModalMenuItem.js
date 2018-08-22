import React, {Component} from 'react';
import ReactDOM from 'react-dom';

// CONTENT FIELDS
import LinkField from './../Content/ContentFields/LinkField';
import ContentSelectModal from './../Content/ContentSelectModal';

import axios from 'axios';

export default class ModalMenuItem extends Component {

  constructor(props){
    super(props);

    this.state = {
      itemId : null,
      field : null,
      displayContentModal: false,
    };

    var self = this;

    this.translations = {};
    LANGUAGES.map(function(language){
        self.translations[language.iso] = true;
    });

    this.onModalClose = this.onModalClose.bind(this);
  }

  initFields()
  {

      var field = {
          id:0,
          identifier:"link",
          value:{},
          name:"Enllaç"
      };

      this.setState({
          field : field
      });
  }

  read(itemId) {
    console.log("ModalMenuItem :: read "+itemId);
    this.setState({
      itemId : itemId
    });
  }

  componentDidMount() {
    if(architect.menu.form !== undefined) {
        architect.menu.form._editModal = this;
    }
  }

  onModalClose(e){
      e.preventDefault();
      this.modalClose();
  }

  modalOpen(itemId) {

    if(itemId != null){
      this.read(itemId);
    }
    else {
      this.initFields();
    }

    TweenMax.to($("#modal-edit-menu"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
  }

  modalClose() {
    var self =this;

    TweenMax.to($("#modal-edit-menu"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){

      self.setState({
        field : null
      });

    }});
  }

  onFieldChange(field) {

    console.log("ModalMenuItem :: onFieldChange => ",field);

    var stateField = this.state.field;
    stateField.value = field.value;
    this.setState({
        field : stateField
    });

    //this.props.onUpdateData(stateField);

  }

  onSubmit(e) {
    e.preventDefault();
    const field = this.state.field;

    var _this = this;

    if(this.state.content) {
        this.update();
    } else {
        this.create();
    }
  }

  getFormData()
  {
      return {
          field : this.state.field
      };
  }

  create()
  {
      var _this = this;
      axios.post('/architect/menu/'+this.props.menu+'/create/', this.getFormData())
         .then((response) => {
             if(response.data.success) {
                 _this.onSaveSuccess(response.data);
             }
         })
         .catch((error) => {
             if (error.response) {
                 _this.onSaveError(error.response.data);
             } else if (error.message) {
                 toastr.error(error.message);
             } else {
                 console.log('Error', error.message);
             }
         });
  }

  update()
  {
      var _this = this;
      axios.put('/architect/menu/'+this.props.menu+'/' + this.state.itemId + '/update', this.getFormData())
          .then((response) => {
              if(response.data.success) {
                  _this.onSaveSuccess(response.data);
              }
          })
          .catch((error) => {
              if (error.response) {
                  _this.onSaveError(error.response.data);
              } else if (error.message) {
                  toastr.error(error.message);
              } else {
                  console.log('Error', error.message);
              }
          });
  }

  onSaveSuccess(response)
  {
      toastr.success('Menu guardat correctament!');

      this.modalClose();
      architect.menu.form.refresh();
  }


 onSaveError(response)
 {
     if(response.message) {
         toastr.error(response.message);
     }
   }

  /**************** CONTENT MODAL ********************/

  handleContentSelected(content){
      this.updateContent(content);
  }

  updateContent(content){

    var self = this;
    var layout = this.props.layout;
    var field = this.state.field;

    if(field.value == null){
      field.value = {};
    }
    else if(field.value.url !== undefined){
      delete field.value['url'];
    }

    field.value.content = content;

    this.setState({
      field : field,
      displayContentModal : false
    });

  }

  handleContentSelect(){
    this.setState({
      displayContentModal : true
    });
  }

  handleContentCancel(){
    this.setState({
      displayContentModal : false
    });
  }

  render() {

    return (

      <div>

        <ContentSelectModal
          display={this.state.displayContentModal}
          onContentSelected={this.handleContentSelected.bind(this)}
          onContentCancel={this.handleContentCancel.bind(this)}
          zIndex={11000}
        />

        <div className="custom-modal" id="modal-edit-menu" style={{zIndex:this.props.zIndex}}>
          <div className="modal-background"></div>


            <div className="modal-container">

              {this.state.field != null &&
                <div className="modal-header">

                    <i className={"fa "+this.state.field.icon}></i>
                    <h2>{this.state.field.name} | Edició</h2>

                  <div className="modal-buttons">
                    <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                      <i className="fa fa-times"></i>
                    </a>
                  </div>
                </div>
              }

              <div className="modal-content">
                <div className="container">
                  <div className="row">
                    <div className="col-xs-8 col-xs-offset-2 field-col">

                      {this.state.field != null &&
                        <LinkField
                            field={this.state.field}
                            hideTab={true}
                            translations={this.translations}
                            onFieldChange={this.onFieldChange.bind(this)}
                            onContentSelect={this.handleContentSelect.bind(this)}
                        />
                      }

                    </div>

                  </div>
                </div>

                <div className="modal-footer">
                  <a href="" className="btn btn-default" onClick={this.onModalClose}> Cancel·lar </a> &nbsp;
                  <a href="" className="btn btn-primary" onClick={this.onSubmit.bind(this)}> Acceptar </a> &nbsp;
                </div>

              </div>
          </div>
        </div>
      </div>
    );
  }

}

if (document.getElementById('menu-edit-modal')) {
  var element = document.getElementById('menu-edit-modal');
  var menu = element.getAttribute('menu');

  ReactDOM.render(<ModalMenuItem
      menu={menu}
    />, element);
}
