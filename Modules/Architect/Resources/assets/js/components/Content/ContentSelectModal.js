import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ContentDataTable from './ContentDataTable';

class ContentSelectModal extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          contentSelected : null,
          isOpen : false,
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.handleSelectItem = this.handleSelectItem.bind(this);
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
        this.props.onContentCancel();


    }

    componentDidMount(){
      //this.modalOpen();
    }

    handleSelectItem(item){
      this.props.onContentSelected(item);
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

    getModalRoute() {

      const field = this.props.field;

      var route = routes["contents.data"];

      if(field != null){
        if(field.type == "link" || field.type == "url"){
          return route+'?search=typology.has_slug:1;is_page:1';
        }
        else if(field.type == "widget" || field.type == "contents"){
          if(field.settings.typologyAllowed !== undefined && field.settings.typologyAllowed != null){
            return route+'?search=typology_id:'+field.settings.typologyAllowed;
          }
        }
      }

      return route;

    }


    render() {

        var zIndex = this.props.zIndex !== undefined ? this.props.zIndex : 10000;
        //only linkable contents
        var route = this.getModalRoute();

        console.log("ContentSelectModal :: Field => ",this.props.field,route);

        return (
          <div style={{zIndex:zIndex}}>
            <div className="custom-modal" id="content-select">
              <div className="modal-background"></div>


                <div className="modal-container">
                    <div className="modal-header">

                        <h2>Seleccionar contingut</h2>

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

                            <ContentDataTable
                              init={this.state.isOpen}
                              route={route}
                              onSelectItem={this.handleSelectItem}
                            />

                        </div>
                      </div>
                    </div>

                    <div className="modal-footer">
                      <a href="" className="btn btn-default" onClick={this.onModalClose}> Cancel·lar </a> &nbsp;
                    </div>

                  </div>

              </div>
            </div>
          </div>
        );
    }
}

export default ContentSelectModal;
