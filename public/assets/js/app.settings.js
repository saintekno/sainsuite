"use strict";

var KTAppSettings = {
    "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1200
    },
    "colors": {
        "theme": {
            "base": {
                "white": "#ffffff",
                "primary": "#1BC5BD",
                "secondary": "#E5EAEE",
                "success": "#1BC5BD",
                "info": "#6993FF",
                "warning": "#FFA800",
                "danger": "#F64E60",
                "light": "#F3F6F9",
                "dark": "#212121"
            },
            "light": {
                "white": "#ffffff",
                "primary": "#1BC5BD",
                "secondary": "#ECF0F3",
                "success": "#C9F7F5",
                "info": "#E1E9FF",
                "warning": "#FFF4DE",
                "danger": "#FFE2E5",
                "light": "#F3F6F9",
                "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff",
                "primary": "#ffffff",
                "secondary": "#212121",
                "success": "#ffffff",
                "info": "#ffffff",
                "warning": "#ffffff",
                "danger": "#ffffff",
                "light": "#464E5F",
                "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#ECF0F3",
            "gray-300": "#E5EAEE",
            "gray-400": "#D6D6E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#80808F",
            "gray-700": "#464E5F",
            "gray-800": "#1B283F",
            "gray-900": "#212121"
        }
    },
    "font-family": "Poppins"
};

// Class definition
var offcanvas = function () {
	// Elements
	var offcanvas;

	// Private functions
	var _initAside = function () {
		// Mobile offcanvas for mobile mode
		offcanvas = new KTOffcanvas('kt_profile_aside', {
            overlay: true,
            baseClass: 'offcanvas-mobile',
            //closeBy: 'kt_user_profile_aside_close',
            toggleBy: 'kt_subheader_mobile_toggle'
        });
    }
    
    var menuAside = function(){
        $('#kt_aside').on('click', '.aside-primary a', function() {
            var $this = $(this);
            var linkId = $this.attr('href');
            localStorage.removeItem("menuAside");
            localStorage.removeItem("menuNavheader");
            localStorage.setItem("menuAside", linkId);
        });

        var selectedLinkId = localStorage.getItem("menuAside");
        var menuNavheader = localStorage.getItem("menuNavheader");

        if (selectedLinkId !== null) {
            $('.aside-primary a[href="'+ selectedLinkId +'"]').tab("show");
        }

        if (menuNavheader == null) {
            $('.navheader-nav a[href="'+ selectedLinkId +'"]').addClass("active");
        }

        if (selectedLinkId == 'app' || selectedLinkId == 'settings') {
            $('#kt_body').removeClass('aside-minimize');
            $('.aside-toggle').removeClass('d-none');
        }
    }

    var menuAside2 = function(){
        $('#kt_aside_tab_1').on('click', '.list a', function() {
            var $this = $(this);
            var linkId = $this.attr('href');
            
            $this.find('a').removeClass("active");
            $this.addClass("active");

            localStorage.setItem("menuAside2", linkId);
        });

        var selectedLinkId = localStorage.getItem("menuAside2");

        if (selectedLinkId !== null) {
            $('.list a[href="'+ selectedLinkId +'"]').trigger("click");
        }
    }

    var menuNavheader = function(){
        $('#kt_header').on('click', '.navheader-nav a', function() {
            var $this = $(this);
            var linkId = $this.attr('href');
            
            $this.find('a').removeClass("active");
            $this.addClass("active");
            
            localStorage.setItem("menuNavheader", linkId);
        });
        
        var selectedLinkId = localStorage.getItem("menuNavheader");
        
        if (selectedLinkId !== null) {
            $('.navheader-nav a[href="'+ selectedLinkId +'"]').trigger("click");
        }
    }

    var cekClass = function() {
        if ($(".navheader-nav .nav-item").length) {
            $('#kt_body').addClass('header-fixed');
            $('#kt_header').removeClass('d-none');
        }
        if ($(".toolbar_menu a").length) {
            $('#kt_body').addClass('subheader-enabled');
            $('#kt_subheader').removeClass('d-none');
        }
    }

	return {
		// public functions
		init: function() {
			_initAside();
            menuAside();
            menuAside2();
            menuNavheader();
            cekClass();
		}
	};
}();

jQuery(document).ready(function() {
	offcanvas.init();
});