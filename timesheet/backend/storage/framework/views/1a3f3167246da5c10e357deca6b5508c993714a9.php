<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Mobile Device <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
      }
    </style>
<div class="panel panel-success">
    <div class="panel-heading">
        <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
    </div>
    <div class="panel-body">
        <div class="m-b-5 form-inline">
            <div class="pull-right">
                <div ng-show="f.tab=='list'">
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_nmobdev']); ?> <?php echo $__env->renderComponent(); ?>
                    <div class="input-group">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i class="fa fa fa-file-excel-o"></i></button>
                            <button type="button" class="btn btn-success btn-sm" ng-click="oPrint()"><i class="fa fa fa-print"></i></button>
                            <button type="button" class="btn btn-success btn-sm" ng-click="oSearch(1)"><i class="fa fa fa-recycle"></i></button>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success btn-sm" ng-click="oSearch()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div ng-show="f.tab=='frm'">
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                    <button type="button" class="btn btn-sm btn-success" ng-click="oSave()" ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i class="fa fa-copy"></i> Copy</button>
                    <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()" ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()" ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                    <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i class="fa fa-clock-o"></i> Log</button>
                    <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_nmobdev','id'=>'h.device_id']); ?> <?php echo $__env->renderComponent(); ?> </span>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <br>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item<br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.device_id)">
                        <td title="'Device ID'" filter="{device_id: 'text'}" sortable="'device_id'">{{v.device_id}}</td>
                        
                        <td title="'Application ID'" filter="{appid: 'text'}" sortable="'appid'">{{v.appid}}</td>
                        <td title="'Application Version'" filter="{app_version: 'text'}" sortable="'app_version'">{{v.app_version}}</td>
                        
                        <td title="'User ID'" filter="{userid: 'text'}" sortable="'userid'">{{v.userid}}</td>
                        <td title="'User Name'" filter="{username: 'text'}" sortable="'username'">{{v.username}}</td>
                        
                        <td title="'Device Name'" filter="{device_name: 'text'}" sortable="'device_name'">{{v.device_name}}</td>
                        <td title="'Device Type'" filter="{device_type: 'text'}" sortable="'device_type'">{{v.device_type}}</td>
                        
                        
                        
                        
                        <td title="'Last Login'" filter="{last_login: 'text'}" sortable="'last_login'">{{v.last_login}}</td>
                        
                        
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label title='device_id'>Device ID</label>
                        <input type="text" ng-model="h.device_id" id="h_device_id" class="form-control input-sm" readonly maxlength="" ng-readonly="f.crud!='c' || true " placeholder="auto">
                        <label title='appid'>UUID</label>
                        <input type="text" ng-model="h.uuid" id="h_uuid" class="form-control input-sm" required readonly maxlength="15">
                        <label title='appid'>Application ID</label>
                        <input type="text" ng-model="h.appid" id="h_appid" class="form-control input-sm" required readonly maxlength="15">
                        <label title='app_version'>Application Version</label>
                        <input type="text" ng-model="h.app_version" id="h_app_version" class="form-control input-sm" readonly maxlength="15">
                        <label title='apikey'>API Key</label>
                        <input type="text" ng-model="h.apikey" id="h_apikey" class="form-control input-sm" readonly maxlength="100">
                        <label title='userid'>User ID</label>
                        <input type="text" ng-model="h.userid" id="h_userid" class="form-control input-sm" required readonly maxlength="15">
                        <label title='mac_addr'>Mac Address</label>
                        <input type="text" ng-model="h.mac_addr" id="h_mac_addr" class="form-control input-sm" readonly maxlength="15">
                        <label title='identifier'>Identifier</label>
                        <input type="text" ng-model="h.identifier" id="h_identifier" class="form-control input-sm" readonly maxlength="15">
                    </div>
                    <div class="col-sm-4">
                        <label title='device_name'>Device Name</label>
                        <input type="text" ng-model="h.device_name" id="h_device_name" class="form-control input-sm" readonly maxlength="30">
                        <label title='device_type'>Device Type</label>
                        <input type="text" ng-model="h.device_type" id="h_device_type" class="form-control input-sm" readonly maxlength="30">
                        <label title='device_info'>Device Info</label>
                        <textarea ng-model="h.device_info" id="h_device_info" class="form-control input-sm"></textarea>
                        <label title='device_email'>Device Email</label>
                        <input type="text" ng-model="h.device_email" id="h_device_email" class="form-control input-sm" readonly maxlength="30">
                        <label title='device_gsm'>Device GSM</label>
                        <input type="text" ng-model="h.device_gsm" id="h_device_gsm" class="form-control input-sm" readonly maxlength="30">
                        <label title='is_block'>Blocked Device</label>
                        <select ng-model="h.is_block" id="h_is_block" class="form-control input-sm">
                            <option ng-repeat="v in [[1,'Yes'],[2,'No']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label title='online_status'>Online Status</label>
                        <input type="text" ng-model="h.online_status" id="h_online_status" class="form-control input-sm" readonly maxlength="">
                        <label title='last_login'>Last Login</label>
                        <input type="text" ng-model="h.last_login" id="h_last_login" class="form-control input-sm" readonly maxlength="">
                        <label title='last_gps'>Last GPS / Position</label>
                        <input type="text" ng-model="h.last_gps" id="h_last_gps" class="form-control input-sm" readonly maxlength="30">
                        <label title='lat'>Latitude</label>
                        <input type="text" ng-model="h.lat" id="h_lat" class="form-control input-sm" readonly maxlength="30">
                        <label title='lat'>Longitude</label>
                        <input type="text" ng-model="h.lng" id="h_lng" class="form-control input-sm" readonly maxlength="30">
                        <label title='note'>Note</label>
                        <input type="text" ng-model="h.note" id="h_note" class="form-control input-sm" readonly maxlength="30">
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <hr><b>Device Location Last Detected</b>
                <div id="map"></div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz4KpxwT5vrHUTGJYpr8BHiWrxmDAUh50&callback=initMap">
                </script>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_nmobdev')); ?>");
    $scope.f = { crud: 'c', tab: 'list', trash: 0, userid: "<?php echo e(Auth::user()->userid); ?>", plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.m = [];

    var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
            item.formData = [{ id: $scope.h.device_id, path: 'trs_local_nmobdev', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_nmobdev/' + $scope.h.device_id, function(jdata) {
            $scope.m = jdata.files;
            $scope.$apply();
        });
    }

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {};
        $scope.m = [];
        SfFormNew("#frm");
    }

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.device_id = null;
    }

    $scope.oSearch = function(trash, order_by) {
        $scope.f.tab = "list";
        $scope.f.trash = trash;
        $scope.tableList = new NgTableParams({}, {
            getData: function($defer, params) {
                var $btn = $('button').button('loading');
                return $http.get(SfService.getUrl("_list"), {
                    params: {
                        page: $scope.tableList.page(),
                        limit: $scope.tableList.count(),
                        order_by: $scope.tableList.orderBy(),
                        q: $scope.f.q,
                        trash: $scope.f.trash,
                        plant: $scope.f.plant,
                        userid: $scope.f.userid
                    }
                }).then(function(jdata) {
                    $btn.button('reset');
                    $scope.tableList.total(jdata.data.data.total);
                    return jdata.data.data.data;
                }, function(error) {
                    $btn.button('reset');
                    swal('', error.data, 'error');
                });
            }
        });
    }

    $scope.oSave = function() {
        SfService.save("#frm", SfService.getUrl(), {
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oShow = function(id) {
        SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
            $scope.oNew();
            $scope.h = jdata.data.h;
            $scope.initMap($scope.h.lat,$scope.h.lng);
            $scope.f.crud = 'u';
            $scope.oGallery();
            if (chatCtrl() != undefined) {
                chatCtrl().listChat();
            }
        });
    }

    $scope.oDel = function(id, isRestore) {
        if (id == undefined) {
            var id = $scope.h.device_id;
        }
        SfService.delete(SfService.getUrl("/" + encodeURI(id)), { restore: isRestore }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oRestore = function(id) {
        $scope.oDel(id, 1);
    }

    $scope.oLookup = function(id, selector, obj) {
        switch (id) {
            /*case 'parent':
                SfLookup(SfService.getUrl("_lookup"), function(id, name, jsondata) {
                    $("#" + selector).val(id).trigger('input');;
                });
                break;*/
            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

    $scope.oLog = function() {
        SfLog('trs_local_nmobdev', $scope.h.device_id);
    }

    $scope.initMap=function(lat,lng) {
                    var myLatLng = { lat: lat, lng: lng };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 10,
                        center: myLatLng
                    });

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: 'Current Position'
                    });
                }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\me\smart\smart_back\resources\views/trs/local/nmobdev/nmobdev_frm.blade.php ENDPATH**/ ?>