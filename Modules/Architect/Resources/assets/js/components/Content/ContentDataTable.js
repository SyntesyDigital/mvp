import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class ContentDataTable extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          fields : []
        };
    }

    componentDidMount()
    {

      this._table = $('#table-contents');

      this.setDatatable();
    }

    setDatatable()
    {

        console.log("MediaSelectModal :: setDatatable");

        var _this = this;

        var table = this._table.DataTable({
    	    language: {
    	        "url": "/modules/architect/plugins/datatables/locales/french.json"
    	    },
    		processing: true,
          serverSide: true,
    	    pageLength: 20,
          language: {
              url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Catalan.json"
          },
    	    ajax: this.props.route,
    	    columns: [
    	        // {data: 'id', name: 'id', width: '40'},
              {data: 'title', name: 'title'},
              {data: 'typology', name: 'typology'},
              {data: 'updated', name: 'updated'},
              {data: 'author', name: 'author'},
              {data: 'status', name: 'status'},
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

    addField()
    {

    }

    initEvents()
    {
        var _this = this;
        $(document).on('click','.add-item',function(e){
          e.preventDefault();

          /*
          _this.setState({
            imageSelected : $(this).data('id')
          });
          */

          var item = {
            id : $(this).data('id'),
            name : $(this).data('name'),
            type : $(this).data('type'),
          };

          _this.props.onSelectItem(item);

        });

    }

    render() {
        return (
          <div>
            <table className="table" id="table-contents">
                <thead>
                   <tr>
                       <th>Nom</th>
                       <th>Tipus</th>
                       <th>Actualiztat</th>
                       <th>Autor</th>
                       <th>Estat</th>
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
                       <th></th>
                   </tr>
                </tfoot>
            </table>
          </div>
        );
    }
}

export default ContentDataTable;