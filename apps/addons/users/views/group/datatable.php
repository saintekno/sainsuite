<script>
var DatatableScript = function() {   
    // Read
    var read = function() {
        var dataSet;
		if ('<?php echo $groups;?>' !== '') {
            dataSet = JSON.parse('<?php echo $groups;?>');
        }
        var datatable = $('#kt_datatable').KTDatatable({
			data: {
				type: 'local',
				source: dataSet,
				pageSize: 10, // display 20 records per page
			},
            // columns definition
            columns: [
                {
                    field: 'checkbox',
                    title: '',
                    template: '{{id}}',
                    sortable: false,
                    width: 20,
                    textAlign: 'center',
                    selector: {class: 'kt-checkbox--solid'},
                }, {
                    field: 'username',
                    title: 'User',
                    template: function(row) {
                        var stateNo = KTUtil.getRandomInt(0, 7);
                        var states = [
                            'success',
                            'primary',
                            'danger',
                            'success',
                            'warning',
                            'dark',
                            'primary',
                            'info'];
                        var state = states[stateNo];

                        var output = '<div class="d-flex align-items-center">\
                            <div class="symbol symbol-40 symbol-'+state+' flex-shrink-0">\
                                <div class="symbol-label">' + row.name.substring(0, 1) + '</div>\
                            </div>\
                            <div class="ml-2">\
                                <div class="text-dark-75 font-weight-bold line-height-sm">' + row.name + '</div>\
                                <a href="#" class="font-size-sm text-dark-50 text-hover-primary">' +
                                row.definition + '</a>\
                            </div>\
                        </div>';

						return output;
                    }
                }, {
					field: 'Actions',
					title: 'Actions',
                    textAlign: 'right',
					sortable: false,
					overflow: 'visible',
                    autoHide: false,
					template: function(row) {
                        var edit  = '<i class="fas fa-pen"></i>';
                        var hapus = '<i class="fas fa-trash-alt"></i>';
                        <?php if ( User::control('edit.group')) : ?>
						edit = '\
                            <a class="btn btn-sm btn-icon btn-light-primary btn-hover-primary "\
                                href="<?php echo site_url(array( 'admin', 'group', 'edit'));?>/'+ row.id +'">\
                                <i class="fas fa-pen"></i>\
                            </a>\
                        ';
                        <?php endif; ?>

                        <?php if ( User::control('delete.group')) : ?>
                        hapus = '\
                            <button class="btn btn-sm btn-icon btn-light-danger btn-hover-danger "\
                                data-head="<?php echo _s( 'Would you like to delete this data?' ) ;?>"\
                                data-url="<?php echo site_url(array( 'admin', 'group', 'delete'));?>/'+ row.id +'"\
                                onclick="deleteConfirmation(this)">\
                                <i class="fas fa-trash-alt"></i>\
                            </button>\
                        ';
                        <?php endif; ?>

                        return edit +' '+hapus;
					},
				}
            ],
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
    DatatableScript.init();
});

</script>