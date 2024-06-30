var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;
var mobile_menu_visible = 0,
    mobile_menu_initialized = false,
    toggle_initialized = false,
    bootstrap_nav_initialized = false,
    $sidebar,
    isWindows;

$(document).ready(function () {
    window_width = $(window).width();

    // check if there is an image set for the sidebar's background
    lbd.checkSidebarImage();

    // Init navigation toggle for small screens
    if (window_width <= 991) {
        lbd.initRightMenu();
    }

    //  Activate the tooltips
    $('[rel="tooltip"]').tooltip();

    //      Activate regular switches
    if ($("[data-toggle='switch']").length != 0) {
        $("[data-toggle='switch']").bootstrapSwitch();
    }

    $(".form-control")
        .on("focus", function () {
            $(this).parent(".input-group").addClass("input-group-focus");
        })
        .on("blur", function () {
            $(this).parent(".input-group").removeClass("input-group-focus");
        });

    // Fixes sub-nav not working as expected on IOS
    $("body").on("touchstart.dropdown", ".dropdown-menu", function (e) {
        e.stopPropagation();
    });
});

// activate collapse right menu when the windows is resized
$(window).resize(function () {
    if ($(window).width() <= 991) {
        lbd.initRightMenu();
    }
});

lbd = {
    misc: {
        navbar_menu_visible: 0,
    },
    checkSidebarImage: function () {
        $sidebar = $(".sidebar");
        image_src = $sidebar.data("image");

        if (image_src !== undefined) {
            sidebar_container =
                '<div class="sidebar-background" style="background-image: url(' +
                image_src +
                ') "/>';
            $sidebar.append(sidebar_container);
        } else if (mobile_menu_initialized == true) {
            // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
            $sidebar_wrapper.find(".navbar-form").remove();
            $sidebar_wrapper.find(".nav-mobile-menu").remove();

            mobile_menu_initialized = false;
        }
    },

    initRightMenu: function () {
        $sidebar_wrapper = $(".sidebar-wrapper");

        if (!mobile_menu_initialized) {
            $navbar = $("nav").find(".navbar-collapse").first().clone(true);

            nav_content = "";
            mobile_menu_content = "";

            //add the content from the regular header to the mobile menu
            $navbar.children("ul").each(function () {
                content_buff = $(this).html();
                nav_content = nav_content + content_buff;
            });

            nav_content =
                '<ul class="nav nav-mobile-menu">' + nav_content + "</ul>";

            $navbar_form = $("nav").find(".navbar-form").clone(true);

            $sidebar_nav = $sidebar_wrapper.find(" > .nav");

            // insert the navbar form before the sidebar list
            $nav_content = $(nav_content);
            $nav_content.insertBefore($sidebar_nav);
            $navbar_form.insertBefore($nav_content);

            $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(
                function (event) {
                    event.stopPropagation();
                }
            );

            mobile_menu_initialized = true;
        } else {
            console.log("window with:" + $(window).width());
            if ($(window).width() > 991) {
                // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
                $sidebar_wrapper.find(".navbar-form").remove();
                $sidebar_wrapper.find(".nav-mobile-menu").remove();

                mobile_menu_initialized = false;
            }
        }

        if (!toggle_initialized) {
            $toggle = $(".navbar-toggler");

            $toggle.click(function () {
                if (mobile_menu_visible == 1) {
                    $("html").removeClass("nav-open");

                    $(".close-layer").remove();
                    setTimeout(function () {
                        $toggle.removeClass("toggled");
                    }, 400);

                    mobile_menu_visible = 0;
                } else {
                    setTimeout(function () {
                        $toggle.addClass("toggled");
                    }, 430);

                    main_panel_height = $(".main-panel")[0].scrollHeight;
                    $layer = $('<div class="close-layer"></div>');
                    $layer.css("height", main_panel_height + "px");
                    $layer.appendTo(".main-panel");

                    setTimeout(function () {
                        $layer.addClass("visible");
                    }, 100);

                    $layer.click(function () {
                        $("html").removeClass("nav-open");
                        mobile_menu_visible = 0;

                        $layer.removeClass("visible");

                        setTimeout(function () {
                            $layer.remove();
                            $toggle.removeClass("toggled");
                        }, 400);
                    });

                    $("html").addClass("nav-open");
                    mobile_menu_visible = 1;
                }
            });

            toggle_initialized = true;
        }
    },
};

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
}

$(document).ready(function () {
    // sidebar dropdown links
    // $("#formsDropdown-1").click(function () {
    //   $("#formsExamples-1").slideToggle("fast");
    // });
    // $("#formsDropdown-2").click(function () {
    //   $("#formsExamples-2").slideToggle("fast");
    // });
    // $("#formsDropdown-3").click(function () {
    //   $("#formsExamples-3").slideToggle("fast");
    // });

    // initialize the DataTable
    $("#example").DataTable({
        //disable sorting on last column
        columnDefs: [{ orderable: false, targets: 2 }],
        language: {
            //customize pagination prev and next buttons: use arrows instead of words
            paginate: {
                previous: '<span class="fa fa-chevron-left"></span>',
                next: '<span class="fa fa-chevron-right"></span>',
            },
            //customize number of elements to be displayed
            lengthMenu:
                'Display <select class="form-control input-sm">' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">All</option>' +
                "</select> results",
        },
    });

    // show hide branch select and create admin
    // Initially hide both sections
    $("#select-admin").hide();
    $("#create-admin").hide();

    // Show/Hide sections based on radio button selection
    $('input[name="admin-option"]').change(function () {
        if ($("#select-admin-radio").is(":checked")) {
            $("#select-admin").show();
            $("#create-admin").hide();
        } else if ($("#create-admin-radio").is(":checked")) {
            $("#select-admin").hide();
            $("#create-admin").show();
        }
    });

    // Product Delete Logic
    $(".delete-btn-product").on("click", function () {
        var url = $(this).data("href");
        $("#confirmDeleteBtn").attr("href", url);
    });
    // Category Delete Logic
    $(".delete-btn-category").on("click", function () {
        var url = $(this).data("href");
        $("#confirmDeleteCategory").attr("href", url);
    });
    // Accept P.O.
    // $(".po-accept").on("click", function () {
    //   var id = $(this).data("id");
    //   $("#confirm-accept-po").data("id", id);
    // });
});
