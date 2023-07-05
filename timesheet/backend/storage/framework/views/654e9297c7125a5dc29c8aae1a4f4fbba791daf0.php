<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Dashboard | Melon - Flat &amp; Responsive Admin Template</title>
    <link href="<?php echo e(url('melon')); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/><![endif]-->
    <link href="<?php echo e(url('melon')); ?>/assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('melon')); ?>/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('melon')); ?>/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('melon')); ?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(url('melon')); ?>/assets/css/fontawesome/font-awesome.min.css">
    <!--[if IE 7]><link rel="stylesheet" href="<?php echo e(url('melon')); ?>/assets/css/fontawesome/font-awesome-ie7.min.css"><![endif]-->
    <!--[if IE 8]><link href="<?php echo e(url('melon')); ?>/assets/css/ie8.css" rel="stylesheet" type="text/css"/><![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/libs/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/libs/lodash.compat.min.js"></script>
    <!--[if lt IE 9]><script src="<?php echo e(url('melon')); ?>/assets/js/libs/html5shiv.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/touchpunch/jquery.ui.touch-punch.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/event.swipe/jquery.event.move.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/event.swipe/jquery.event.swipe.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/libs/breakpoints.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/respond/respond.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/cookie/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js">
    </script>
    <script type="text/javascript"
        src="<?php echo e(url('melon')); ?>/assets/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
    <!--[if lt IE 9]><script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/flot/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/sparkline/jquery.sparkline.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/flot/jquery.flot.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/flot/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/flot/jquery.flot.growraf.min.js"></script>
    <script type="text/javascript"
        src="<?php echo e(url('melon')); ?>/assets/plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/daterangepicker/daterangepicker.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/blockui/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/noty/jquery.noty.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/noty/layouts/top.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/noty/themes/default.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/plugins.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/plugins.form-components.js"></script>


    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/datatables/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/datatables/tabletools/TableTools.min.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/datatables/colvis/ColVis.min.js"></script>
    <script type="text/javascript"
        src="<?php echo e(url('melon')); ?>/assets/plugins/datatables/columnfilter/jquery.dataTables.columnFilter.js">
    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/plugins/datatables/DT_bootstrap.js"></script>


    <script>
        $(document).ready(function() {
            App.init();
            Plugins.init();
            FormComponents.init()
        });

    </script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/custom.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/demo/pages_calendar.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/demo/charts/chart_filled_blue.js"></script>
    <script type="text/javascript" src="<?php echo e(url('melon')); ?>/assets/js/demo/charts/chart_simple.js"></script>
</head>

<body>
    <header class="header navbar navbar-fixed-top" role="banner">
        <div class="container">
            <ul class="nav navbar-nav">
                <li class="nav-toggle">
                    <a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a>
                </li>
            </ul>
            <a class="navbar-brand" href="#">
                
                <strong>WEBMON</strong> </a>
            
            </a>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-male"></i><span
                            class="username">Login</span></a>
                </li>
            </ul>
        </div>

    </header>
    <div id="container" class="fixed-header sidebar-closed">
        <div id="sidebar" class="sidebar-fixed">
            <div id="sidebar-content">
                <form class="sidebar-search">
                    <div class="input-box">
                        <button type="submit" class="submit"><i class="icon-search"></i></button><span><input
                                type="text" placeholder="Search..."></span>
                    </div>
                </form>
                <div class="sidebar-search-results">
                    <i class="icon-remove close"></i>
                    <div class="title">Documents</div>
                    <ul class="notifications">
                        <li>
                            <a href="javascript:void(0);">
                                <div class="col-left">
                                    <span class="label label-info"><i class="icon-file-text"></i></span>
                                </div>
                                <div class="col-right with-margin">
                                    <span class="message"><strong>John Doe</strong> received $1.527,32</span><span
                                        class="time">finances.xls</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="col-left">
                                    <span class="label label-success"><i class="icon-file-text"></i></span>
                                </div>
                                <div class="col-right with-margin">
                                    <span class="message">My name is <strong>John Doe</strong> ...</span><span
                                        class="time">briefing.docx</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="title">Persons</div>
                    <ul class="notifications">
                        <li>
                            <a href="javascript:void(0);">
                                <div class="col-left">
                                    <span class="label label-danger"><i class="icon-female"></i></span>
                                </div>
                                <div class="col-right with-margin">
                                    <span class="message">Jane <strong>Doe</strong></span><span class="time">21 years
                                        old</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul id="nav">
                    <li class="current">
                        <a href="index-2.html"><i class="icon-dashboard"></i> Dashboard </a>
                    </li>
                </ul>
            </div>
            <div id="divider" class="resizeable"></div>
        </div>
        <div id="content">
            <div class="container">
                <div class="crumbs" style="margin-bottom:10px;">
                    <ul id="breadcrumbs" class="breadcrumb">
                        <li>
                            <i class="icon-home"></i><a href="index-2.html">Dashboard</a>
                        </li>
                        <li class="current">
                            <a href="pages_calendar.html" title="">Logger</a>
                        </li>
                    </ul>
                    <ul class="crumb-buttons">
                        <li class="range" style="margin-top:8px;">
                            <i class="icon-calendar"></i><span>2021-11-11</span>
                        </li>
                    </ul>
                </div>




                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-2">
                        <label class="control-label">Pilih :</label><br />
                        <select class="form-control" name="select">
                            <option value="opt1">Instansi</option>
                            <option value="opt2">Alat</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Instansi:</label><br />
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="icon-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Alat:</label><br />
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="icon-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Keyword :</label><br />
                        <input type="text" class="form-control">
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">&nbsp;</label><br />
                            <button class="btn btn-success" type="button">Cari Data</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="widget box" style="padding:20px">

                        <div class="widget-content no-padding">
                            <table
                                class="table table-hover table-striped table-condensed table-bordered table-highlight-head">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>table</td>
                                        <td>Default table styling</td>
                                    </tr>
                                    <tr>
                                        <td>table-striped</td>
                                        <td>Different background for even rows</td>
                                    </tr>
                                    <tr>
                                        <td>table-bordered</td>
                                        <td>Default bordered table</td>
                                    </tr>
                                    <tr>
                                        <td>table-hover</td>
                                        <td>Change background color for rows on hover</td>
                                    </tr>
                                    <tr>
                                        <td>table-condensed</td>
                                        <td>Smaller padding</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
    </div>
    <script type="text/javascript">
        if (location.host == "envato.stammtec.de" || location.host == "themes.stammtec.de") {
            var _paq = _paq || [];
            _paq.push(["trackPageView"]);
            _paq.push(["enableLinkTracking"]);
            (function() {
                var a = (("https:" == document.location.protocol) ? "https" : "http") + "://analytics.stammtec.de/";
                _paq.push(["setTrackerUrl", a + "piwik.php"]);
                _paq.push(["setSiteId", "17"]);
                var e = document,
                    c = e.createElement("script"),
                    b = e.getElementsByTagName("script")[0];
                c.type = "text/javascript";
                c.defer = true;
                c.async = true;
                c.src = a + "piwik.js";
                b.parentNode.insertBefore(c, b)
            })()
        };

    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/layouts/melonadmin.blade.php ENDPATH**/ ?>