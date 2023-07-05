<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>monitoring</title>
    <link rel="shortcut icon" href="{{ url('coloradmin') }}/assets/img/fav.png">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var SfBaseUrl = "{{ url('/') }}";

    </script>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ url('coloradmin') }}/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css"
        rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css"
        rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/css/animate.min.css" rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="{{ url('coloradmin') }}/assets/css/overide.css?ver=2019.01.13" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN JQUERY JS ================== -->
    <script src="{{ url('coloradmin') }}/assets/plugins/jquery/jquery-1.12.4.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/jquery/jquery-migrate-1.4.1.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/sweetalert2/sweetalert2.js"></script>
    <!-- ================== BEGIN JQUERY JS ================== -->

    <!-- ================== BEGIN ANGULAR JS ================== -->
    <script src="{{ url('coloradmin') }}/assets/plugins/angular/angular.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/angular/angular-cookies.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/angular/angular-route.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/angular/angular-sanitize.js"></script>
    <link href="{{ url('coloradmin') }}/assets/plugins/angular/ng-table/ng-table.min.css" rel="stylesheet" />
    <script src="{{ url('coloradmin') }}/assets/plugins/angular/ng-table/ng-table.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/moment/moment.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/moment/moment-with-locales.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/angular-strap/angular-strap.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/angular-strap/angular-strap.tpl.min.js"></script>
    <link href="{{ url('coloradmin') }}/assets/plugins/summernote/summernote.css" rel="stylesheet" />
    <script src="{{ url('coloradmin') }}/assets/plugins/summernote/summernote.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/summernote/angular-summernote.min.js"></script>
    <script src="{{ url('/js/apps/dynamic-number.min.js?ver=2019.06.12') }}"></script>
    <script src="{{ url('/js/apps/sfAngular.js?ver=2020.05.08') }}"></script>
    <script src="{{ url('/js/apps/sf.js?ver=2019.03.12') }}"></script>
    <!-- ================== END ANGULAR JS ================== -->

    <script src="{{ url('coloradmin') }}/assets/plugins/angular-file-upload/angular-file-upload.min.js"></script>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url('coloradmin') }}/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body ng-app="sfApp" ng-controller="topCtrl" id="topCtrl" onkeypress="return disableCtrlKeyCombination(event);"
    onkeydown="return disableCtrlKeyCombination(event);">
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixedxxx page-sidebar-minified ">
        @component('layouts.common.coloradmin.nav_top') @endcomponent
        @component('layouts.common.coloradmin.sidebar_left') @endcomponent
        <div ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl" class="content">
            <ol class="page-breadcrumb breadcrumb pull-right hidden-print">
                <li><a href="javascript:;">Home</a></li>
                <li><a href="javascript:;">@yield('title')</a></li>
                <li class="active"><a href="javascript:;">@yield('breadcrumb')</a></li>
            </ol>
            <h1 class="page-header hidden-print">@yield('title') <small>@yield('title-small')</small></h1>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div id="footer" class="footer hidden">
            © 2022 All Right Reserved
        </div>
        <div class="hidden">@component('layouts.common.coloradmin.theme_panel') @endcomponent</div>
        <a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url('coloradmin') }}/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ url('coloradmin') }}/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            App.init();
        });

    </script>
</body>

</html>
