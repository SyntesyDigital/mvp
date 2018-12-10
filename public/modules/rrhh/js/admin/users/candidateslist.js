$(function() {
    var dataSrc = [];
    table_candidats = $('#table-candidates').DataTable({
        language: {
            "url": "/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        order: [ 0, "desc" ],
        ajax:{
                "url": routes.data,
                "data": function ( d ) {
                  return $.extend( {}, d, {
                    "extra_search": $('input[name="tags"]').val()
                  } );
                }
        },
        columns: [
            {data: 'id', name: 'id', width: "40"},
            {data: 'lastname', name: 'lastname'},
            {data: 'status', name: 'status'},
            {data: 'postal_code', name: 'postal_code'},
            {data: 'location', name: 'location'},
            {data: 'type', name: 'type'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
            var _this = this;
            DataTableTools.init(this);

           /*  // Populate a dataset for autocomplete functionality
             // using data from first, second and third columns
             api.cells('tr', [1]).every(function(){
                // Get cell data as plain text
                var data = $('<div>').html(this.data()).text();
                if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
             });

             // Sort dataset alphabetically
             dataSrc.sort();

             // Initialize Typeahead plug-in
             $('.dataTables_filter input[type="search"]', api.table().container())
                .typeahead({
                   source: dataSrc,
                   afterSelect: function(value){
                      api.search(value).draw();
                   }
                }
            );*/
        }
   });

    $('#textarea')
        .textext({
            plugins : 'tags autocomplete',
        })
        .bind('getSuggestions', function(e, data) {
            var list = atags,
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || ''
                ;

            $(this).trigger('setSuggestions',{
                result: textext.itemManager().filter(list, query)
            });
        });
});
