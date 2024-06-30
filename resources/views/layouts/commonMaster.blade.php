<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    {{--
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" /> --}}
    {{--
    <link rel="icon" type="image/png" href="./assets/img/favicon.ico" /> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        School PCA | Admin Panel
    </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
        name="viewport" />

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css"
        integrity="sha512-/k658G6UsCvbkGRB3vPXpsPHgWeduJwiWGPCGS14IQw3xpr63AEMdA8nMYG2gmYkXitQxDTn6iiK/2fD4T87qA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Data Table CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">

    <!-- Bootstrap CSS Files -->
    <!-- <link href="./assets/css/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    <!-- Styles -->
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
    {{-- {{ asset(mix('assets/css/light-bootstrap-dashboard.css?v=2.0.0')) }} --}}
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link href="./assets/css/demo.css" rel="stylesheet" /> -->
</head>

<body>

    {{-- Layout Content --}}
    @yield('layoutContent')

    <!--   Core JS Files   -->
    <!-- <script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script> -->
    <!-- Jquery -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

    <!-- Bootstrap js  -->
    <!-- <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- FONT AWESOME -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Datatables js -->
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src='https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js'></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!--  Chartist Plugin  -->
    <script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

    <!-- Notification -->
    <script type="text/javascript">
        $(document).ready(function() {
            notify = {
                showSuccessNotification: function(from, align, message, type) {
                    $.notify({
                        icon: "mdi mdi-check-circle-outline",
                        message: message,
                    }, {
                        type: 'primary',
                        timer: 7000,
                        placement: {
                            from: from,
                            align: align,
                        },
                    });
                },
                showWarningNotification: function(from, align, message) {
                    $.notify({
                        icon: "mdi mdi-alert-circle-outline",
                        message: message,
                    }, {
                        type: "warning",
                        timer: 7000,
                        placement: {
                            from: from,
                            align: align,
                        },
                    });
                },
            }
        });
    </script>
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0 ') }}" type="text/javascript"></script>

    <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>


    <script src="{{ asset('assets/js/ajax-call.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();
        });
    </script>

    <!-- responsive sidebar js -->

    <script>
        function myshow() {
            let againclick = document.getElementById("show");
            againclick.classList.add("right");
        }

        function left() {
            let weclick = document.getElementById("show");
            weclick.classList.remove("right");
        }
    </script>

    @stack('scripts')

</body>


</html>
