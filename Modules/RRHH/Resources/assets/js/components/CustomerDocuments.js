import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const acceptedFiles = 'application/pdf,application/doc',
      maxFilesize = 20, // MB
      paramName = 'file',
      identifier = '.docs-dropfiles';

export default class CustomerDocuments extends Component {

  constructor(props)
  {
      super(props);

      this.state = {
        items : [
          {
            id : 1,
            name : 'doc_1.pdf',
            url : 'sdfsdf'
          },
          {
            id : 1,
            name : 'doc_2.pdf',
            url : 'sdfsdf'
          }

        ]
      };

      this._dropzone = null;

  }

  componentDidMount()
  {

    this.initDropzone();
    this.loadDocs();

  }

  initDropzone()
  {
      var _this = this;

      console.log("CustomerDocuments :: initDropzone");

      var settings = {
          url: routes['uploadPost'],
          uploadMultiple: false,
          parallelUploads: 1,
          createImageThumbnails : false,
          //acceptedFiles: acceptedFiles,
          addRemoveLinks: false,
          maxFilesize: maxFilesize,
          paramName: paramName,
      };

      console.log(settings);

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

    //TODO api to load docs
    /*
    axios.get('/architect/customer/docs/')
      .then(function (response) {

          if(response.status == 200
              && response.data.data !== undefined
              && response.data.data.length > 0)
          {
              self.setState({
                  items : response.data.data
              });
          }

      }).catch(function (error) {
         console.log(error);
       });
    */

  }

  onRemoveField(id,e) {

    e.preventDefault();

    console.log("CustomerDocuments :: onRemoveField => ",id);

    var self = this;

    //TODO api remove item by id
    /*
      axios.post('/architect/customer/docs/remove', {
          id : id
      })
      .then((response) => {
          toastr.success('User remove correctly');

          self.loadUsers();
      })
      .catch((error) => {
          toastr.error('An error occurred');
      });
    */

  }

  renderDocs() {

    var self = this;

    return this.state.items.map((item, key) =>
      <div className="typology-field" key={key}>
        <div className="field-type">
          <i className={"fa fa-file"}></i> &nbsp; Document
        </div>

        <div className="field-inputs">
          <div className="field-name">
            {item.name}
          </div>

        </div>

        <div className="field-actions">
          <a href={item.url} target="_blank" className="btn-link"> <i className="fa fa-download"></i>  </a> &nbsp;
          <a href="" className="remove-field-btn" onClick={self.onRemoveField.bind(this,item.id)}> <i className="fa fa-trash"></i>  </a>
          &nbsp;&nbsp;
        </div>
      </div>
    );

  }


  render() {

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
                    {this.renderDocs()}
                </div>
              </div>
            </div>

          </div>
      );
  }

}

if (document.getElementById('customer_documents')) {
    ReactDOM.render(<CustomerDocuments />, document.getElementById('customer_documents'));
}
