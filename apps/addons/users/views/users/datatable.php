<script>
var DatatableScript = function() {   
    // Read
    var read = function() {
        var dataSet = <?php echo $users;?>;
        var temp;
        for (i=0; i<dataSet.length; i++) 
        {
            if (isJson(dataSet[i].value)) {
                temp = JSON.parse(dataSet[i].value.toString());
                dataSet[i].value = temp;
            }
        }
        var datatable = $('#kt_datatable').KTDatatable({
			data: {
				type: 'local',
				source: dataSet,
				pageSize: 10, // display 20 records per page
			},
            search: {
                input: $('#search_query'),
                key: 'generalSearch'
            },  
            // columns definition
            columns: [
                {
                    field: 'checkbox',
                    title: '',
                    template: '{{user_id}}',
                    sortable: false,
                    width: 20,
                    textAlign: 'center',
                    selector: {class: 'kt-checkbox--solid'},
                }, {
                    field: 'username',
                    title: 'User',
                    width: 250,
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
                                <div class="symbol-label">' + row.username.substring(0, 1) + '</div>\
                            </div>\
                            <div class="ml-2">\
                                <div class="text-dark-75 font-weight-bold line-height-sm">' + row.username + '</div>\
                                <a href="#" class="font-size-sm text-dark-50 text-hover-primary">' +
                                row.email + '</a>\
                            </div>\
                        </div>';

						return output;
                    }
                }, {
                    field: 'last_login',
                    title: 'Last Login',
                }, {
                    field: 'last_activity',
                    title: 'Last Activity',
					template: function(row) {
						return (row.last_activity) ? moment(row.last_activity).fromNow(true) : '-';
					},
                }, {
                    field: 'banned',
                    title: 'Status',
                    width: 50,
					template: function(row) {
						var banned = {
							0 : {'title': 'None', 'class': ' label-light-primary'},
							1 : {'title': 'Banned', 'class': ' label-light-danger'},
						};
						return '<span class="label font-weight-bold label-lg ' + banned[row.banned].class + ' label-inline">' + banned[row.banned].title + '</span>';
					},
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
                        <?php if ( User::control('edit.users')) : ?>
						edit = '\
                            <a class="btn btn-sm btn-icon btn-light-primary btn-hover-primary "\
                                href="<?php echo site_url(array( 'admin', 'users', 'edit'));?>/'+ row.user_id +'">\
                                <i class="fas fa-pen"></i>\
                            </a>\
                        ';
                        <?php endif; ?>

                        <?php if ( User::control('delete.users')) : ?>
                        hapus = '\
                            <button class="btn btn-sm btn-icon btn-light-danger btn-hover-danger "\
                                data-head="<?php echo _s( 'Would you like to delete this data?' ) ;?>"\
                                data-url="<?php echo site_url(array( 'admin', 'users', 'delete'));?>/'+ row.user_id +'"\
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

        $('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'group_name');
        });
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

function isJson(item) {
    item = typeof item !== "string"
        ? JSON.stringify(item)
        : item;

    try {
        item = JSON.parse(item);
    } catch (e) {
        return false;
    }

    if (typeof item === "object" && item !== null) {
        return true;
    }

    return false;
}
</script>