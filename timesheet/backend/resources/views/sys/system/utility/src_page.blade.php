@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Search Page @stop
<!-- ------------------------------------------------------------------------------- -->
@section('title-small') @stop
<!-- ------------------------------------------------------------------------------- -->
@section('breadcrumb')
<span>Search</span> @stop
<!-- ------------------------------------------------------------------------------- -->
@section('content')
<div class="row">
    <div class="col-sm-8">
        <div class="input-group">
            <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()" placeholder="Search">
            <div class="input-group-btn">
                <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <hr>
        <div class="panel">
            <div class="panel-body">
                <div class="alert alert-warning" ng-show="list.length==0">
                    <i class="fa fa-warning fa-3x pull-left"></i>
                    <b>Sorry..!</b>
                    <br>
                    Nothing item can be found. Try again using another keyword.
                </div>
                <div ng-repeat="v in list">
                    <a ng-href="{{url('/')}}/@{{v.url}}">
                        <h4 class="text-success">@{{$index+1}}. @{{v.label}}</h4>
                        <p class="desc">
                            @{{v.rel_parent.rel_parent.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.rel_parent.label!=null"></i>
                            @{{v.rel_parent.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.rel_parent.label!=null"></i> @{{v.rel_parent.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.rel_parent.label!=null"></i> @{{v.rel_parent.label}}
                            <i class="fa fa-arrow-right" ng-show="v.rel_parent.label!=null"></i>  <b class="text-success">@{{v.label}}</b> (Route : @{{v.url}})
                        </p>
                    </a><hr>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', function($scope, $http, NgTableParams, SfService) {
    SfService.setUrl("{{url('sys_system')}}");
    $scope.f = { trash: 0, q: "{{@$request->search_keyword}}" };
    $scope.list = [];

    $scope.oSearch = function() {
        SfService.httpGet(SfService.getUrl('_src_result'), {
            f: $scope.f
        }, function(jdata) {
            $scope.list = jdata.data.data;
        });
    }

    $scope.oSearch();
}]);
</script>
@stop