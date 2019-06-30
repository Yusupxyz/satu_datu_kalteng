<!DOCTYPE html>
<html class="app">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="UPR" name="author">
    <meta content="UKT&SPP" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo base_url() . 'favicon.jpg'; ?>" rel="shortcut icon">
    <link href="<?php echo base_url() . 'logo3.png'; ?>" rel="logo3">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/tether/dist/css/tether.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/bootstrap/dist/css/bootstrap.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/font-awesome/css/font-awesome.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/batch-icons/style.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/dashicons/style.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/dripicons/webfont.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/eightyshades/style.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/foundation-icons/foundation-icons.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/metrize-icons/style.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/simple-line-icons/css/simple-line-icons.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/themify-icons/themify-icons.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/type-icons/style.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/weather-icons/css/weather-icons.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/animate/animate.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/fullcalendar/dist/fullcalendar.css'; ?>"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatable/media/css/dataTables.bootstrap4.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/dropzone/dist/dropzone.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/select2/dist/css/select2.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/bootstrap-daterangepicker/daterangepicker.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/fancybox/dist/jquery.fancybox.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/sweetalert/dist/sweetalert.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/exort/uploader.min.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/jquery-treegrid/jquery.treegrid.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/main.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/custom.css'; ?>"/>


    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/jquery/jquery-2.1.1.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/jquery-count-to/jquery.countTo.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/moment/min/moment.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/fullcalendar/dist/fullcalendar.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/chart.js/dist/Chart.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/datatable/media/js/jquery.dataTables.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/datatable/media/js/dataTables.bootstrap4.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/dropzone/dist/dropzone.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/select2/dist/js/select2.full.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/bootstrap-daterangepicker/daterangepicker.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/bootstrap-validator/dist/validator.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/fancybox/dist/jquery.fancybox.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/disabler-enabler/disabler.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/disabler-enabler/enabler.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/sweetalert/dist/sweetalert.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/super-datagrid/datagrid.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/exort/uploader.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/jquery-treegrid/jquery.treegrid.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/slimscroll/jquery.slimscroll.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/tether/dist/js/tether.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/app.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/datagrid-export.js'; ?>"></script>    
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
</head>
<body>