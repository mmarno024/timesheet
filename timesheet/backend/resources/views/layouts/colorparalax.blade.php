<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>monitoring</title>
    <link rel="shortcut icon" href="{{ url('neptuneparalax') }}/assets/img/fav.png">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ url('colorparalax') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('colorparalax') }}/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ url('colorparalax') }}/assets/css/animate.min.css" rel="stylesheet" />
    <link href="{{ url('colorparalax') }}/assets/css/style.min.css" rel="stylesheet" />
    <link href="{{ url('colorparalax') }}/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="{{ url('colorparalax') }}/assets/css/theme/default.css" id="theme" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url('colorparalax') }}/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body data-spy="scroll" data-target="#header-navbar" data-offset="51"
    onkeypress="return disableCtrlKeyCombination(event);" onkeydown="return disableCtrlKeyCombination(event);">
    <div id="page-container" class="fade">
        <div id="header" class="header navbar navbar-transparent navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand">
                        <span class="brand-logo"></span>
                        <span class="brand-text">
                            {{ \App\Sf::getParsys('APP_LABEL') }}
                        </span>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/sys_syweb_page?q=home') }}">HOME</a></li>
                        <li><a href="{{ url('/sys_syweb_page?q=about') }}">ABOUT</a></li>
                        <li><a href="{{ url('/sys_syweb_page?q=gallery') }}">GALLERY</a></li>
                        <li><a href="{{ url('/sys_syweb_page?q=team') }}">TEAM</a></li>
                        <li><a href="{{ url('/sys_syweb_page?q=contact') }}">CONTACT</a></li>
                        <li><a
                                href="{{ \Auth::check() ? url('home') : url('login') }}">{{ \Auth::check() ? 'ADMIN PAGE' : 'SIGN IN' }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @yield('content')
        <div id="footer" class="footer">
            <div class="container">
                <div class="footer-brand">
                    <div class="footer-brand-logo"></div>
                    {{ \App\Sf::getParsys('APP_LABEL') }}
                </div>
                <p>
                    &copy; Copyright Color Admin {{ date('Y') }} <br />
                    {{ \App\Sf::getParsys('APP_DESC') }}. Created by <a href="mailto:it.wp@dsngroup.co.id">IT
                        DSNWP</a>
                </p>
                <p class="social-list">
                    <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-fw"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                    <a href="#"><i class="fa fa-google-plus fa-fw"></i></a>
                    <a href="#"><i class="fa fa-dribbble fa-fw"></i></a>
                </p>
            </div>
        </div>

        <div class="theme-panel hidden">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i
                    class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Blue">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default"
                            data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body"
                            data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector"
                            data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url('colorparalax') }}/assets/plugins/jquery/jquery-1.12.4.min.js"></script>
    <script src="{{ url('colorparalax') }}/assets/plugins/jquery/jquery-migrate-1.4.1.min.js"></script>
    <script src="{{ url('colorparalax') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('colorparalax') }}/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="{{ url('colorparalax') }}/assets/plugins/scrollMonitor/scrollMonitor.js"></script>
    <script src="{{ url('colorparalax') }}/assets/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
        });

    </script>
</body>

</html>
