import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MediaFieldsList from './MediaFieldsList';
import MediaCropModal from './MediaCropModal';
import axios from 'axios';

export default class MediaEditModal extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            image : "",
          fields : {
            titleCa : "",
            titleEs : "",
            titleEn : "",
            altCa : "",
            altEn : "",
            altEs : "",
            descriptionCa : "",
            descriptionEn : "",
            descriptionEs : ""
          },
          cropsOpen : false
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.toggleCrops = this.toggleCrops.bind(this);
        this.handleModalCropClose = this.handleModalCropClose.bind(this);

    }

    handleChange(field) {

      const fields = this.state.fields;
      fields[field.name] = field.value;

      this.setState({
        fields : fields
      });

    }

    toggleCrops(event) {
      event.preventDefault();

      this.setState({
        cropsOpen : true
      });
    }

    componentDidMount(){
      console.log("MediaEditModal :: open");
      //this.modalOpen();
    
      if(medias) {
          medias._editModal = this;
      }
    }

    modalOpen(mediaId) {
        TweenMax.to($("#media-edit"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
        var _this = this;
        axios.get('/architect/medias/' + mediaId)
            .then(response => {
                this.setState({
                    image: '/storage/medias/' + response.data.media.stored_filename
                });
            });
    }

    modalClose() {
      TweenMax.to($("#media-edit"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){

      }});
    }

    onModalClose(){
        this.modalClose();
    }

    handleModalCropClose(){
      this.setState({
        cropsOpen : false
      });
    }

    onSubmit() {

    }

    render() {
        return (
          <div>
            <MediaCropModal
              display = {this.state.cropsOpen}
              onModalClose = {this.handleModalCropClose}
            />

            <div className="custom-modal" id="media-edit">
              <div className="modal-background"></div>


                <div className="modal-container">
                    <div className="modal-header">

                        <h2>Edita media</h2>

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

                        {this.state.image && 
                          <div className="original-image" style={{backgroundImage:'url('+ this.state.image + ')'}}></div>
                          }
                          <div className="image-actions">
                            <a href="" className="btn btn-default" onClick={this.toggleCrops}> <i className="fa fa-scissors"></i> Retalla </a>
                          </div>

                        </div>
                        <div className="col-xs-6 content-col">

                          <MediaFieldsList
                            fields= {this.state.fields}
                            onHandleChange={this.handleChange}
                          />

                        </div>
                      </div>
                    </div>

                    <div className="modal-footer">
                      <a href="" className="btn btn-default" onClick={this.onModalClose}> Tancar </a> &nbsp;
                      <a href="" className="btn btn-primary" onClick={this.onSubmit}> Guardar </a>
                    </div>

                  </div>
              </div>
              }
            </div>
          </div>
        );
    }
}

if (document.getElementById('media-edit-modal')) {
    ReactDOM.render(<MediaEditModal />, document.getElementById('media-edit-modal'));
}
