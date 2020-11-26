<script>
var SainScript = function() {
    // Read
    var read = function() {
        var datatable = $('#kt_datatable').KTDatatable({
            search: {
                input: $('#search_query'),
                key: 'generalSearch'
            },
            columns: [{
                field: 'Checkall',
                title: '#',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                overflow: 'visible',
                textAlign: 'right',
                autoHide: false,
                width:70,
            }]
        });
        
        datatable.on(
            'datatable-on-check datatable-on-uncheck',
            function(e) {
                var checkedNodes = datatable.rows('.datatable-row-active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_records').html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form').collapse('show');
                } else {
                    $('#kt_datatable_group_action_form').collapse('hide');
                }
            }
        );
    };

    return {
        init: function() {
            read();
        },
    };

}();

jQuery(document).ready(function() {
    SainScript.init();
});

</script>