import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class MediaSelectModal extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          imageSelected : null
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.selectImage = this.selectImage.bind(this);
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
        //this.modalClose();
        this.props.onImageCancel();
    }

    componentDidMount(){
      //this.modalOpen();
    }

    modalOpen()
    {
        console.log("modalOpen");
        TweenMax.to($("#media-select"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
    }

    modalClose() {
        console.log("modalClose");
      var self =this;
        TweenMax.to($("#media-select"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
          self.setState({
            imageSelected : null
          });
        }});
    }

    selectImage(e){
      this.setState({
        imageSelected : {
          url : ASSETS+"modules/architect/images/default.jpg"
        }
      })
    }

    onSubmit(e){
      e.preventDefault();

      this.props.onImageSelected(this.state.imageSelected);

    }

    renderImages() {

      var images = [];

      for(var i=0;i<25;i++){
        images.push(
          <div className="grid-image" key={i}>
            <div className="image" style={{backgroundImage:"url(/modules/architect/images/default.jpg)"}} onClick={this.selectImage}></div>
          </div>
        )
      }

      return images;
    }

    render() {
        return (
          <div>
            <div className="custom-modal" id="media-select">
              <div className="modal-background"></div>


                <div className="modal-container">
                    <div className="modal-header">

                        <h2>Seleccionar media</h2>

                      <div className="modal-buttons">
                        <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                          <i className="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                  <div className="modal-content">
                    <div className="container">
                      <div className="row">
                        <div className="col-xs-8 grid-col">

                          <div className="grid-items">
                            {this.renderImages()}
                          </div>


                        </div>

                        { this.state.imageSelected == null &&
                          <div className="col-xs-4 image-col">
                            <div className="image no-selected">
                              <p align="center">
                                <strong>Arrossega un arxiu o</strong> <br />
                                <a href="#" className="btn btn-default"><i className="fa fa-upload"></i> Pujar arxiu </a>
                              </p>
                            </div>
                          </div>
                        }

                        { this.state.imageSelected != null &&
                          <div className="col-xs-4 image-col">
                            <div className="image-container">
                              <div className="image" style={{backgroundImage:"url(/modules/architect/images/default.jpg)"}} ></div>

                              {/*
                              <a href="" className="btn btn-default"><i className="fa fa-pencil"></i> Editar</a>
                              */}

                              <ul>
                                <li>
                                  <b>Nom arxiu</b> : nom_arxiu.jpg
                                </li>
                                <li>
                                  <b>Llegenda</b> : Lleganda de la imatge
                                </li>
                                <li>
                                  <b>Mida original</b> : 1900x460
                                </li>
                                <li>
                                  <b>Pes original</b> : 4000Kb
                                </li>
                                <li>
                                  <b>Autor</b> : Nom Autor
                                </li>
                                <li>
                                  <a href="" className="btn btn-link"><i className="fa fa-pencil"></i> Editar</a> <a href="" className="btn btn-link text-danger"><i className="fa fa-trash"></i> Esborrar</a>
                                </li>
                              </ul>
                            </div>
                            <div className="col-footer">

                              <a href="" className="btn btn-default" onClick={this.onModalClose}> Cancel·lar </a> &nbsp;
                              <a href="" className="btn btn-primary" onClick={this.onSubmit}> Afegir </a>

                            </div>
                          </div>
                        }


                      </div>
                    </div>

                  </div>
              </div>
              }
            </div>
          </div>
        );
    }
}

export default MediaSelectModal;
