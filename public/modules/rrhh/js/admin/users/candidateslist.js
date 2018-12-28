$(function() {

    var filterTags = [];

    $('#table-candidates').DataTable({
        language: {
            "url": "/modules/rrhh/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        order: [0, "desc"],
        ajax: {
            "url": routes.data,
            "data": function(d) {
                return $.extend({}, d, {
                    "extra_search": $('input[name="tags"]').val()
                });
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
        initComplete: function() {
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

    var updateTable = function(){

      //TODO filter datatable by tags
      //datatable.fiterByTags(filterTags)
    };


    $('.toggle-select2').select2();

    $('.toggle-select2').on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data);

        filterTags.push(data.id);
        console.log("Filter tags vale : ",filterTags);

        updateTable();

    });

    $('.toggle-select2').on('select2:unselect', function (e) {
        var data = e.params.data;
        console.log("unselect : ", data);

        const index = filterTags.indexOf(data.id);

        if (index !== -1) {
          filterTags.splice(index, 1);
        }

        console.log("Filter tags vale : ",filterTags);

        updateTable();

    });

});
