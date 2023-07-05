@extends('layouts.master')
@section('content')
<div class="row">

    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <h3 class="total">Lainnya</h3>
                    </div>
                </div>

                

            </div>
            <p>&nbsp;</p>
        </div>
    </div>

</div>
<script>
    var app = angular.module("myapp", [])
    app.controller("mainCtrl", ['$scope', '$http', '$interval', function($scope, $http, $interval) {
        $scope.xxx = 2;
        $scope.hello = {};
        $scope.hello.title1 = "Apps 1";
        $scope.hello.title2 = "Apps 2";

        console.log($scope.xxx);
    }]);
 </script>
@endsection