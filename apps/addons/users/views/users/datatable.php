<script>
var DatatableScript = function() {   
    // Read
    var read = function() {
        var array = '<?php echo $users;?>';
        var dataSet;
        if (Object.keys(array).length) {
            dataSet = JSON.parse(array);
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
					overflow: 'visible',
                    width: 200,
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

                        output = '<div class="d-flex align-items-center">\
                            <div class="symbol symbol-40 symbol-'+state+' flex-shrink-0">\
                                <div class="symbol-label">' + row.username.substring(0, 1) + '</div>\
                            </div>\
                            <div class="ml-2">\
                                <div class="text-dark-75 font-weight-bold line-height-sm">' + row.username + '</div>\
                                <a href="#" class="font-size-sm text-dark-50 text-hover-primary">' +
                                row.group_name + '</a>\
                            </div>\
                        </div>';

						return output;
                    }
                }, {
                    field: 'email',
                    title: 'Email',
                    width: 200,
                }, {
                    field: 'last_login',
                    title: 'Last Login',
                    width: 200,
                }, {
                    field: 'last_activity',
                    title: 'Last Activity',
                    width: 200,
					template: function(row) {
						return (row.last_activity) ? moment(row.last_activity).fromNow(true) : '-';
					},
                }, {
                    field: 'banned',
                    title: 'Status',
                    width: 60,
					template: function(row) {
						var banned = {
							0 : {'title': 'Active', 'class': ' label-light-primary'},
							1 : {'title': 'Banned', 'class': ' label-light-danger'},
						};
						return '<span class="label font-weight-bold label-lg ' + banned[row.banned].class + ' label-inline">' + banned[row.banned].title + '</span>';
					},
                }, {
					field: 'Actions',
					title: 'Actions',
                    textAlign: 'right',
					sortable: false,
                    width: 100,
					overflow: 'visible',
                    autoHide: false,
					template: function(row) {
                        var edit  = '<button class="btn btn-sm btn-icon btn-light" disabled><i class="fas fa-pen"></i></button>';
                        var hapus = '<button class="btn btn-sm btn-icon btn-light" disabled><i class="fas fa-trash-alt"></i></button>';
                        if (<?php echo $this->aauth->get_user_id(); ?> == row.user_id) {
						edit = '\<a class="btn btn-sm btn-icon btn-light-primary btn-hover-primary "\
                                href="<?php echo site_url(array( 'admin', 'users', 'edit'));?>/'+ row.user_id +'">\
                                <i class="fas fa-user"></i>\
                            </a>';
                        hapus = '';                        
                        } else {
                            <?php if ( User::control('edit.users')) : ?>
                            edit = '\<a class="btn btn-sm btn-icon btn-light-primary btn-hover-primary "\
                                    href="<?php echo site_url(array( 'admin', 'users', 'edit'));?>/'+ row.user_id +'">\
                                    <i class="fas fa-pen"></i>\
                                </a>';
                            <?php endif; ?>

                            <?php if ( User::control('delete.users')) : ?>
                            hapus = '\<button class="btn btn-sm btn-icon btn-light-danger btn-hover-danger "\
                                    data-head="<?php echo _s( 'Would you like to delete this data?' ) ;?>"\
                                    data-url="<?php echo site_url(array( 'admin', 'users', 'delete'));?>/'+ row.user_id +'"\
                                    onclick="deleteConfirmation(this)">\
                                    <i class="fas fa-trash-alt"></i>\
                                </button>';
                            <?php endif; ?>
                        }

                        return '<div class="btn-group">'+ edit +' '+ hapus +'</div>';
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

        $('#kt_datatable_search_group').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'group_name');
        });

        $('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'banned');
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
</script>