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
                    "extra_search": $('select[name="tags[]"]').val()
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
        }
    });

    var updateTable = function(){
      $('#table-candidates').DataTable().ajax.reload();
    };


    $('.toggle-select2').select2();
    $('.toggle-select2')
        .on('select2:select', function (e) {
            var data = e.params.data;
            filterTags.push(data.id);
            updateTable();
        })
        .on('select2:unselect', function (e) {
            var data = e.params.data;
            const index = filterTags.indexOf(data.id);
            if (index !== -1) {
              filterTags.splice(index, 1);
            }
            updateTable();
        });

});
