@extends('layouts.coloradmin')

@section('title')Personal File @stop
@section('title-small')Cabinet @stop
@section('breadcrumb')
    <li class="active">File</li>
@stop
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            @component('layouts.common.coloradmin.panel_button') @endcomponent @yield('breadcrumb')
        </div>
        <div class="panel-body">
            @component('layouts.common.coloradmin.upload') @endcomponent

            <div>
                <h3 class="m-t-10"><i class="fa fa-paperclip"></i> Attachment List</h3>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Filename</th>
                                <th class="text-right">Size</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="v in m | filter: f.m_filter">
                                <td>@{{ $index + 1 }}</td>
                                <td>@{{ v . file_name }}</td>
                                <td class="text-right">@{{ (v . size) | number }} KB</td>
                                <td>
                                    <a href="<?= \App\Sf::fileFtpAuthUrl() ?>/@{{ v . name }}" target="_blank"><i class="fa fa-eye"></i></a> |
                                    <a href="<?= \App\Sf::fileFtpAuthUrl() ?>/@{{ v . name }}" target="_blank" download> <i class="fa fa-download"></i></a> |
                                    <a href="#" ng-click="SfDelMedia(v.name,oGallery())"> <i class="fa fa-trash text-danger"></i></a> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
        $scope.f = { crud: 'u', tab: 'list', trash: 0 ,userid:"{{ Auth::user()->userid }}"};
        $scope.h = {userid:"{{ Auth::user()->userid }}"};
        $scope.m = [];

        var uploader = $scope.uploader = new FileUploader({
            url: "{{ url('upload_file') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            onBeforeUploadItem: function(item) {
                item.formData = [{ id: $scope.h.userid, path: 'sys_system_personal_file', s: 'iv', userid: $scope.f.userid, plant: $scope.f.plant }];
            },
            onSuccessItem: function(fileItem, response, status, headers) {
                $scope.oGallery();
            }
        });

        $scope.oGallery = function() {
            SfGetMediaList('sys_system_personal_file/' + $scope.h.userid, function(jdata) {
                $scope.m = jdata.files;
                $scope.$apply();
            });
        }
        $scope.oGallery();
    }]);
        $(document).ready(function(){
        $('.form_uploader_more1').hide();
        $('div.form_uploader_more1').show();
        $('hr.form_uploader_hr').hide();
        });
    </script>
@endsection
