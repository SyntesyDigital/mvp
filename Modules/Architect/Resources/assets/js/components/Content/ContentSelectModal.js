import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class ContentSelectModal extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          contentSelected : null
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
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

    onSubmit(e){
      e.preventDefault();

      var rand = parseInt(Math.random()*100);

      this.props.onContentSelected({id:rand,name:"Event "+rand,type:"event",label:"Event",icon:"fa-calendar"});

    }

    modalOpen()
    {
        TweenMax.to($("#content-select"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
    }

    modalClose() {
      var self =this;
        TweenMax.to($("#content-select"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
          self.setState({
            imageSelected : null
          });
        }});
    }

    render() {
        return (
          <div>
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



                        </div>
                      </div>
                    </div>

                    <div className="modal-footer">
                      <a href="" className="btn btn-default" onClick={this.onModalClose}> Cancel·lar </a> &nbsp;
                      <a href="" className="btn btn-primary" onClick={this.onSubmit}> Afegir </a>
                    </div>

                  </div>



              </div>
            </div>
          </div>
        );
    }
}

export default ContentSelectModal;
