import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

const acceptedFiles = 'application/pdf,application/doc',
      maxFilesize = 20, // MB
      paramName = 'file',
      identifier = '.docs-dropfiles';

export default class CustomerDocuments extends Component {

  constructor(props)
  {
      super(props);

        this.state = {
            config : props.config ? JSON.parse(atob(props.config)) : '',
            initializated: false,
            routes: {},
            items : [{
                id : 1,
                name : 'doc_1.pdf',
                url : 'sdfsdf'
            },{
                id : 1,
                name : 'doc_2.pdf',
                url : 'sdfsdf'
            }]
        };

        console.log('CONFIG =>', this.state.config);
      this._dropzone = null;

  }

  componentDidMount()
  {
      this.loadDocs();
  }

  initDropzone()
  {
      var _this = this;

      var settings = {
          url: _this.state.routes.upload,
          uploadMultiple: false,
          parallelUploads: 1,
          createImageThumbnails : false,
          //acceptedFiles: acceptedFiles,
          addRemoveLinks: false,
          maxFilesize: maxFilesize,
          paramName: paramName,
      };

      this._dropzone = new Dropzone(identifier, settings);

      this._dropzone.on("error", function(file, response) {
          toastr.error(response.errors.file[0]);
      });

      this._dropzone.on("totaluploadprogress", function(progress) {
          $(".progress-bar").parent().addClass("progress-striped active");
          $(".progress-bar").width(progress + "%");
          $(".progress-bar").html(progress + "%");
      });

      this._dropzone.on("maxfilesreached", function() {
          toastr.error('Too many files added !');
      });

      this._dropzone.on("dragenter", function() {
          $('.docs-dropfiles').addClass("active");
      });

      this._dropzone.on("dragleave dragend dragover", function() {
          $('.docs-dropfiles').removeClass("active");
      });

      this._dropzone.on("maxfilesexceeded", function(file) {
          toastr.error(Lang.get('fields.file_too_big'));
      });

      this._dropzone.on("queuecomplete", function(file, response) {
          setTimeout(function() {
              $(".progress-bar").parent().removeClass("progress-striped active");
              $(".progress-bar").width("0%");
              $(".progress-bar").html("");
          }, 2000);

          _this._dropzone.removeAllFiles(true);
      });

      this._dropzone.on("success", function(file, response) {
          _this.onSuccessUpload(_this);
      });
  }

  onSuccessUpload(_this)
  {
      toastr.success(Lang.get('fields.success'));
      _this.loadDocs();
  }

  loadDocs() {
      var self = this;
      if(this.state.config.type == "ajax") {
        axios.get(this.state.config.route)
            .then(function (response) {
                self.setState({
                    initializated : true,
                    items : response.data.documents ? response.data.documents : [],
                    routes : response.data.routes
                });

                self.initDropzone();
                self.loadDocs();
            }).catch(function (error) {
                console.log(error);
            });
      }
  }

  onRemoveField(id,e) {

    e.preventDefault();
    var self = this;

    bootbox.confirm({
        message: 'Etes-vous sur de vouloir supprimer ?',
        buttons: {
            confirm: {
                label: 'Oui',
                className: 'btn-primary'
            },
            cancel: {
                label: 'Non',
                className: 'btn-default'
            }
        },
        callback: function(result) {
            if (result) {

                axios.delete(self.state.routes.delete, {
                    params: {
                        id : id
                    }
                })
                .then(function (response) {
                    toastr.success('Document removed correctly');
                    self.loadDocs();
                }).catch(function (error) {
                    toastr.error('An error occurred');
                });

            }
        }
    });




  }

  renderDocs() {
    var self = this;

    if(!this.state.items) {
        return null;
    }

    return this.state.items.map((item, key) =>
      <div className="typology-field" key={key}>
        <div className="field-type">
          <i className={"fa fa-file"}></i> &nbsp; Document
        </div>

        <div className="field-inputs">
          <div className="field-name">
            {item.uploaded_filename}
          </div>

        </div>

        <div className="field-actions">
          <a href={'/'+item.url.replace('public','storage')+'/'+item.stored_filename} target="_blank" className="btn-link"> <i className="fa fa-download"></i>  </a> &nbsp;
          <a href="" className="remove-field-btn" onClick={self.onRemoveField.bind(this,item.id)}> <i className="fa fa-trash"></i>  </a>
          &nbsp;&nbsp;
        </div>
      </div>
    );

  }


  render() {

      var documents = this.state.initializated ? this.renderDocs() : '';

      return (
          <div className="container">

            <div className="row">
              <div className="col-md-4 image-col">

                <div className="image no-selected docs-dropfiles">
                  <p align="center">
                    <strong>{Lang.get('fields.drag_file')}</strong> <br />
                    <a href="#" className="btn btn-default"><i className="fa fa-upload"></i> {Lang.get('fields.upload_file')} </a>
                  </p>
                </div>

                <div className="progress">
                  <div className="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width:'0%'}}>
                    <span className="sr-only"></span>
                  </div>
                </div>

              </div>
              <div className="col-md-8">
                <div className="field-form fields-list-container">
                    {documents}
                </div>
              </div>
            </div>

          </div>
      );
  }

}

if (document.getElementById('customer_documents')) {
    var element = document.getElementById('customer_documents');
    var config = element.getAttribute('config');

    ReactDOM.render(<CustomerDocuments config={config} />, document.getElementById('customer_documents'));
}
