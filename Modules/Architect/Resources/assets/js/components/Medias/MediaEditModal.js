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
            media : null,
            fields : {
                title : {},
                alt : {},
                description : {},
            },
            cropsOpen : false,
            languages : JSON.parse(this.props.languages),
        };

        this.onModalClose = this.onModalClose.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.toggleCrops = this.toggleCrops.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.handleModalCropClose = this.handleModalCropClose.bind(this);
    }

    initFields()
    {
        var fields = this.state.fields;
        this.state.languages.forEach(function(language) {
            fields.title[language.iso] = {
                'label' : language.name,
                'value' : ''
            };

            fields.alt[language.iso] = {
                'label' : language.name,
                'value' : ''
            };

            fields.description[language.iso] = {
                'label' : language.name,
                'value' : ''
            };
        });

        this.setState({
            fields : fields
        });
    }

    handleChange(field)
    {
        var locale = field.name.match(/\[(.*?)\]/i)[1];
        var name = field.name.replace('[' + locale + ']','');
        var fields = this.state.fields;
        fields[name][locale].value = field.value;

        this.setState({
            fields : fields
        });
    }

    toggleCrops(event)
    {
        event.preventDefault();

        this.setState({
            cropsOpen : true
        });
    }

    componentDidMount()
    {
        // IF media lib is present...
        if(medias) {
            medias._editModal = this;
        }
    }

    modalOpen(mediaId)
    {
        this.initFields();
        this.read(mediaId);
        TweenMax.to($("#media-edit"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
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

    read(mediaId)
    {
        axios.get('/architect/medias/' + mediaId)
            .then(response => {
                this.setState({
                    media: response.data.media,
                });

                if(response.data.media.metadata.fields !== undefined) {
                    this.setState({
                        fields: response.data.media.metadata.fields,
                    });
                }

                this.mediaFieldsList.loadMedia(response.data.media);
            });
    }

    onSubmit(e) {
        e.preventDefault();

        axios.put('/architect/medias/' + this.state.media.id + '/update', {
            metadata : {
                fields : this.state.fields
            }
        })
            .then(response => {
                console.log(response.data);
            });
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

                        {this.state.media &&
                          <div className="original-image" style={{backgroundImage:'url(/storage/medias/original/' + this.state.media.stored_filename + ')'}}></div>
                          }
                          <div className="image-actions">
                            <a href="" className="btn btn-default" onClick={this.toggleCrops}> <i className="fa fa-scissors"></i> Retalla </a>
                          </div>

                        </div>
                        <div className="col-xs-6 content-col">
                          <MediaFieldsList
                            ref={(mediaFieldsList) => this.mediaFieldsList = mediaFieldsList}
                            media={this.state.media}
                            fields={this.state.fields}
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
    var languages = document.getElementById('media-edit-modal').getAttribute('languages');

    ReactDOM.render(<MediaEditModal languages={languages}/>, document.getElementById('media-edit-modal'));
}
