<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon icon -->
    <link rel="stylesheet" href="{{ asset('backend/custom/font-awesome/all.min.css') }}" >
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" > --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/custom/datatables/dataTables.dateTime.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/custom/datatables/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/css/toastr.min.css') }}">
    <link href="{{ asset('backend/vendor/summernote/summernote.css') }}" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{ asset('backend/custom/jquery/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('backend/custom/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/custom/html2canvas/html2canvas.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> --}}
    <!-- Sweet Alert 2 -->
    <script src="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/toastr/js/toastr.min.js') }}"></script>


    <!-- Datatable -->
    <script src="{{ asset('backend/custom/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/custom/datatables/sum().js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.0/api/sum().js"></script> --}}

    {{-- <script src="{{ asset('backend/js/plugins-init/datatables.init.js') }}"></script> --}}


</head>

<body>
