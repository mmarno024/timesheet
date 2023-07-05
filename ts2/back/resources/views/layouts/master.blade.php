<!doctype html>
<html lang="en">
    @include('layouts.header')
    <body ng-app="myapp" ng-controller="mainCtrl" id="mainCtrl">
        @include('layouts.nav_top')
        @yield('content')
        @include('layouts.footer')
        <script src="{{ url('public/finapp/assets/js/lib/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/finapp/assets/js/plugins/splide/splide.min.js') }}"></script>
        {{-- <script>
            AddtoHome("2000", "once");
        </script> --}}
    </body>
</html>