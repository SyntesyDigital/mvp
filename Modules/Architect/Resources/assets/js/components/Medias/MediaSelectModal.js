import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const acceptedFiles = 'image/jpeg,image/png,image/gif',
      maxFilesize = 20, // MB
      paramName = 'file',
      identifier = '.medias-dropfiles';


class MediaSelectModal extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          imageSelected : null
        };

        this._dropzone = null;
        this._table = $('#table-medias');

        console.log("MediaSelectModal :: construct");

        this.onModalClose = this.onModalClose.bind(this);
        this.selectImage = this.selectImage.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

    }

    componentDidMount()
    {

      console.log("MediaSelectModal :: componentDidMount");

      this.initDropzone();
      this.setDatatable();

    }

    initDropzone()
    {
        var _this = this;

        console.log("MediaSelectModal :: initDropzone");

        var settings = {
            url: routes['medias.store'],
            uploadMultiple: false,
            parallelUploads: 1,
            createImageThumbnails : false,
            // acceptedFiles: _this._settings.acceptedFiles,
            addRemoveLinks: false,
            maxFilesize: maxFilesize,
            paramName: paramName,
            /*
            thumbnail: function(file, dataUrl) {
                return false;
            }*/
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
            $('.medias-dropfiles').addClass("active");
        });

        this._dropzone.on("dragleave dragend dragover", function() {
            $('.medias-dropfiles').removeClass("active");
        });

        this._dropzone.on("maxfilesexceeded", function(file) {
            toastr.error('File ' + file.name + ' is too big !');
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
        toastr.success('File save correctly');
        _this.refresh();
    }

    setDatatable()
    {

        console.log("MediaSelectModal :: setDatatable");

        var _this = this;

        var table = $('#table-medias').DataTable({
    	    language: {
    	        "url": "/modules/architect/plugins/datatables/locales/french.json"
    	    },
    		processing: true,
          serverSide: true,
    	    pageLength: 20,
          language: {
              url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
          },
    	    ajax: routes["medias.data"],
    	    columns: [
    	        // {data: 'id', name: 'id', width: '40'},
                {data: 'preview', name: 'preview'},
    	        {data: 'uploaded_filename', name: 'uploaded_filename'},
                {data: 'type', name: 'type'},
                {data: 'author', name: 'author'},
    	        {data: 'action', name: 'action', orderable: false, searchable: false}
    	    ],
            initComplete: function(settings, json) {
                DataTableTools.init(this, {
                    onDelete: function(response) {
                        toastr.success(response.message, 'Succès !', {timeOut: 3000});
                        _this.refresh();
                    }
                });

                _this.initEvents();
    	    }
        });
    }

    refresh()
    {
        var _this = this;
        var table = $('#table-medias');
        var datatable = table.DataTable();

        datatable.ajax.reload(function(){
            _this.initEvents();

            // FIXME : Find a better way :)
            table.find('[data-toogle="delete"]').each(function(k,v){
                DataTableTools._delete(datatable, $(this));
            });
        });
    }

    initEvents()
    {
        var _this = this;
        $('#table-medias').find('.toogle-edit')
            .off('click')
            .on('click', function(e) {
                e.preventDefault();

                if(_this._editModal !== undefined) {
                    _this._editModal.modalOpen($(this).data('id'));
                }
            });
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

      return (
          <table className="table" id="table-medias">
              <thead>
                 <tr>
                     <th></th>
                     <th>Nom darxiu</th>
                     <th data-filter="select">Tipus</th>
                     <th data-filter="select">Autor</th>
                     <th></th>
                 </tr>
              </thead>
              <tfoot>
                 <tr>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                 </tr>
              </tfoot>
          </table>
        );

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
                            <div className="image no-selected medias-dropfiles">
                              <p align="center">
                                <strong>Arrossega un arxiu o</strong> <br />
                                <a href="#" className="btn btn-default"><i className="fa fa-upload"></i> Pujar arxiu </a>
                              </p>
                            </div>

                            <div className="progress">
                              <div className="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width:'0%'}}>
                                <span className="sr-only"></span>
                              </div>
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
