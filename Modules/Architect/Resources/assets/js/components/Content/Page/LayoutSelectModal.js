import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class LayoutSelectModal extends Component {

    constructor(props)
    {
        super(props);
    }

    componentDidMount()
    {
        this.setDatatable();
    }

    setDatatable()
    {
        var _this = this;

        var table = $('#table-layouts').DataTable({
    	    language: {
    	        "url": "/modules/architect/plugins/datatables/locales/french.json"
    	    },
    		processing: true,
            serverSide: true,
    	    pageLength: 20,
              language: {
                  url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
              },
    	    ajax: '/architect/page-layouts',
    	    columns: [
                {data: 'name', name: 'name'},
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
        var table = $('#table-layouts');
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
        $(document).on('click','.select-layout',function(e){
          e.preventDefault();

          alert('Layout selected !');
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
    }

    modalOpen()
    {
        TweenMax.to($("#media-select"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
    }

    modalClose() {
      var self =this;
        TweenMax.to($("#media-select"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
          self.setState({
            imageSelected : null
          });
        }});
    }


    render() {

        var zIndex = this.props.zIndex !== undefined ? this.props.zIndex : 10000;

        return (
          <div style={{zIndex:zIndex}}>
            <div className="custom-modal">
              <div className="modal-background"></div>

                <div className="modal-container">
                    <div className="modal-header">

                        <h2>Seleccionar layout</h2>

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
                            Modal...
                          </div>


                        </div>

                      </div>
                    </div>

                  </div>
              </div>

            </div>
          </div>
        );
    }
}

export default LayoutSelectModal;
