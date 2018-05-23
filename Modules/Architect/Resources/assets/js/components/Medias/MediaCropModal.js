import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Cropper from 'react-cropper';
import 'cropperjs/dist/cropper.css';

class MediaCropModal extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          crops : [
            {
              name : "thumbnail",
              width : 500,
              height : 500,
              ratio : "1:1",
              url : "/modules/architect/images/default-thumb.jpg",
              error : ""
            },
            {
              name : "banner",
              width : 1000,
              height : 500,
              ratio : "2:1",
              url : "/modules/architect/images/default-banner.jpg",
              error : "Imatge original massa petita per obtenir bona qualitat"
            }
          ],
          selected : null
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.selectCrop = this.selectCrop.bind(this);
        this.onCropClose = this.onCropClose.bind(this);
        this.onCropSubmit = this.onCropSubmit.bind(this);


    }

    componentWillReceiveProps(nextProps){
      console.log("MediaCropModal :: componentWillReceiveProps");
      console.log(nextProps);

      if(nextProps.display){
        this.modalOpen();
      }
      else {
        this.modalClose();
      }
    }

    componentDidMount(){
      console.log("MediaEditModal :: open");
      //TO TEST modal 
      //this.modalOpen();
    }

    modalOpen() {
      TweenMax.to($("#media-crops"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
    }

    modalClose() {
      TweenMax.to($("#media-crops"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){

      }});
    }

    onCropClose(event){
      event.preventDefault();

      this.setState({
        selected : null
      })


    }

    onCropSubmit(event){
      event.preventDefault();

      console.log("onCropSubmit");
      console.log(this.refs.cropper.getCroppedCanvas().toDataURL());

      //TODO guardar el resultado en la nueva imagen

    }

    onCropDone(){
      // image in dataUrl
      //console.log(this.refs.cropper.getCroppedCanvas().toDataURL());
      //console.log(this.refs.cropper);
    }

    selectCrop(event) {

      var id = $(event.target).closest('.crop-item').attr('id');
      console.log("select crop : "+id)

      this.setState({
        selected : id
      })
    }

    onModalClose(e){
      e.preventDefault();

      this.props.onModalClose();
    }

    renderCrops() {
      return (
        this.state.crops.map((item,i) => (
          <div
              id={i}
              className={"crop-item "+(this.state.selected != null && this.state.selected == i ? "selected" : "")}
              key={i}
              onClick={this.selectCrop}
            >
            <div className="crop-info">
              <p className="crop-title">
                {item.name}
              </p>
              <p className="crop-dimensions">
                <b>Mida máxima</b>: {item.width}x{item.height} <br/>
                <b>Ratio</b>: {item.ratio}
              </p>
              {item.error != "" &&
                <p className="error-message">
                  {item.error}
                </p>
              }
            </div>
            <div className="crop-image" style={{backgroundImage:'url('+item.url+')'}}>
            </div>

          </div>
        ))
      );
    }

    render() {

        var crop = null;
        if(this.state.selected != null){
          crop = this.state.crops[this.state.selected];
        }

        return (
          <div className="custom-modal" id="media-crops">
            <div className="modal-background"></div>


              <div className="modal-container">
                  <div className="modal-header">

                      <h2>Retalla media</h2>

                    <div className="modal-buttons">
                      <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                        <i className="fa fa-times"></i>
                      </a>
                    </div>
                  </div>
                <div className="modal-content">
                  <div className="container">
                    <div className="row">
                      <div className="col-xs-6 image-col">

                        <h3>Original 1200x600 ( ratio 1:2 )</h3>


                        {crop != null &&
                          <Cropper
                            ref='cropper'
                            src={WEBROOT+'/modules/architect/images/default.jpg'}
                            style={{height: 400, width: '100%'}}
                            // Cropper.js options
                            aspectRatio={crop.width / crop.height}
                            guides={false}
                            crop={this.onCropDone.bind(this)}
                          />
                        }

                        {crop == null &&
                          <div className="original-image" style={{backgroundImage:'url(/modules/architect/images/default.jpg)'}}>
                          </div>
                        }

                        <div className="image-actions">

                          {this.state.selected == null &&
                            <p>
                              Selecciona una opció de la llista de la dreta
                            </p>
                          }

                          {this.state.selected != null &&
                            <div>
                              <a href="" className="btn btn-default" onClick={this.onCropClose}> Tancar </a>
                              <a href="" className="btn btn-primary" onClick={this.onCropSubmit}> Guardar </a>
                            </div>
                          }
                        </div>

                      </div>
                      <div className="col-xs-6 content-col">

                          {this.renderCrops()}

                      </div>
                    </div>
                  </div>

                  <div className="modal-footer">
                    <a href="" className="btn btn-default" onClick={this.onModalClose}> Tancar </a> &nbsp;
                  </div>

                </div>
            </div>
            }
          </div>
        );
    }
}

export default MediaCropModal;
