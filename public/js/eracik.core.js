/**
 * Eracik Core Functions
**/

eracik.app		=	function(){

	$this			=	this;
	/**
	 * Handle sidebar status
	**/
	this.sidebar		=	new function(){
		$( '.sidebar-toggle, .sidebar-footer' ).bind( 'click' , function(){
			if( $( 'body' ).hasClass( 'sidebar-collapse' ) ) {
				$this.options.save( 'dashboard-sidebar' , 'sidebar-expanded' , eracik.user.id );
			} else	{
				$this.options.save( 'dashboard-sidebar' , 'sidebar-collapse' , eracik.user.id );
			}
		});
	}

	this.options		=	new function(){
		/**
		 * Save Custom meta
		**/
		this.save		=	function( key , value , user_id, callback ){
			if( typeof user_id === 'undefined' ){
				// Objdata								=	_.object( [ key ], [ value ] ); Not tested
				eval( 'Objdata		= { '+ key + ' 	: 	value }' );
				Objdata.gui_saver_expiration_time	=	eracik.form_expire; // Saving Gui Expire Form
				Objdata 		=	_.extend( eracik.csrf_data, Objdata );

				$.ajax({
					url : eracik.dashboard_url + '/options/save?mode=json',
					data: Objdata,
					type : 'POST',
					beforeSend: function(){
						eracik.ui.loader.start();
					},
					success	:	function(){
						if( typeof callback !== 'undefined' ) {
							callback();
						}
					}
				});
			} else {
				// Objdata								=	_.object( [ key, 'user_id' ], [ value, user_id ] ); Not tested
				eval( 'Objdata		= { "' + key + '" 	: 	value, "user_id" : user_id }' );
				Objdata.gui_saver_expiration_time	=	eracik.form_expire; // Saving Gui Expire Form
				Objdata 		=	_.extend( eracik.csrf_data, Objdata );

				$.ajax({
					url : eracik.dashboard_url + '/options/save_user_meta?mode=json',
					data: Objdata,
					type : 'POST',
					beforeSend: function(){
						$this.ui.loader.start();
					},
					success	:	function(){
						if( typeof callback !== 'undefined' ) {
							callback();
						}
					}
				});
			}
		}
	}

	this.ui				=	new function(){
		this.loader		=	new function(){
			this.start	=	function(){
			}
		}
	}
};

// Eracik notify
eracik.notify			=	new function(){
	this.error			=	function( title, msg, url, dismiss, delay ){
		$.notify({
			icon			:	'fa fa-ban',
			title			:	title,
			message			:	msg,
			url				:	url,
		},{
			type			:	'danger',
			allow_dismiss	:	dismiss,
			delay			:	delay,
			z_index			:	8000
		})
	};

	// Info
	this.info			=	function( title, msg, url, dismiss, delay ){
		$.notify({
			icon			:	'fa fa-exclamation-circle',
			title			:	title,
			message			:	msg,
			url				:	url,
		},{
			type			:	'info',
			allow_dismiss	:	dismiss,
			delay			:	delay,
			z_index			:	8000
		})
	};

	// Warning
	this.warning			=	function( title, msg, url, dismiss, delay ){
		$.notify({
			icon			:	'fa fa-times',
			title			:	title,
			message			:	msg,
			url				:	url,
		},{
			type			:	'warning',
			allow_dismiss	:	dismiss,
			delay			:	delay,
			z_index			:	8000,
			globalPosition	:	'top left',
			showDuration	:	1000
		})
	};

	// Success
	this.success			=	function( title, msg, url, dismiss, delay ){
		$.notify({
			icon			:	'fa fa-check',
			title			:	title,
			message			:	msg,
			url				:	url,
		},{
			type			:	'success',
			allow_dismiss	:	dismiss,
			delay			:	delay,
			z_index			:	8000
		})
	};
}

eracik.loader			=	new function(){
	this.int			=	0;
	this.timeOutToClose;
	this.show			=	function(){

		this.int++;

		if( $( '#canvasLoader' ).length > 0 ) {
			clearTimeout( this.timeOutToClose );
		} else {
			if( this.int == 1 ) {
				if( $( '#spinner' ).length > 0 ) {
					var cl = new CanvasLoader( 'spinner' );
					cl.setColor('#ffffff'); // default is '#000000'
					cl.setDiameter(20); // default is 40
					cl.setDensity(56); // default is 40
					cl.setSpeed(3); // default is 2
					cl.show(); // Hidden by default
					$('#spinner').fadeIn(500);
				}
			}
		}
	}
	this.hide			=	function(){

		this.int--;

		if( this.int == 0 ){
			this.timeOutToClose	=	setTimeout( function(){
				$('#spinner').fadeOut(500, function(){
					$(this).html('').show();
				})
			}, 500 );
		}
	}
}

// Gui Options
eracik.options_data	=	{
    gui_saver_expiration_time	:	eracik.form_expire,
    gui_saver_option_namespace	:	null,
    gui_saver_use_namespace		:	false,
    user_id						:	eracik.user.id,
    gui_json					:	true
}

eracik.tools				=	new Object();
eracik.tools.remove_tags	=	function( string ){
	return string.replace(/(<([^>]+)>)/ig,"");
};

// Date Object
eracik.now				=	function(){
    return moment().format();
};

$(document).ready(function(){
	$( document ).ajaxComplete(function() {
	  eracik.loader.hide();
	});
	$( document ).ajaxError(function() {
	  eracik.loader.hide();
	});
	$( document ).ajaxSend(function() {
	  eracik.loader.show();
	});

	// Add CSRF Protection to each request
	$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
		// if( typeof originalOptions.type != 'undefined' ) {
		// 	if ( originalOptions.type.toUpperCase() === 'POST' || options.type.toUpperCase() === 'POST') {
		// 		if( typeof originalOptions.data == 'string' ) {
		// 			options.data	=	$.param( _.extend( eracik.csrf_data, $.parseParams( originalOptions.data ) ) );
		// 		} else if( typeof originalOptions.data == 'object' ) {
		// 			// Fix Grocery Crud issue while upload
		// 			if( typeof options.multipart == 'undefined' ) {
		// 				options.data	=	$.param( _.extend( eracik.csrf_data, originalOptions.data ) );
		// 			}
		// 		}
		// 	}
		// }
		if ( options.beforeSend ) {
			var oldBeforeSend	=	options.beforeSend;
		}

		options.beforeSend = function (xhr, settings) {
			if( typeof oldBeforeSend != 'undefined' ) {
				oldBeforeSend( xhr, settings );
			}
			xhr.setRequestHeader( eracik.rest.key, eracik.rest.value);
		}
	});
});

$(document).ready(function(){
	"use strict";
	new eracik.app();
});
