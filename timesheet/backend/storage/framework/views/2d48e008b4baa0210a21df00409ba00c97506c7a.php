
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>User Account <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
        </div>
        <div class="panel-body">
            <div class="m-b-5 form-inline">
                <div class="pull-right">
                    <div ng-show="f.tab=='list'">
                        <div class="input-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" onclick="SfExportExcel('div1')"><i
                                        class="fa fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" ng-click="oPrint()"><i
                                        class="fa fa fa-print"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" ng-click="oSearch(1)"><i
                                        class="fa fa fa-recycle"></i></button>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearch()"
                                placeholder="Search">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="oSearch()"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div ng-show="f.tab=='frm'">
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='c' && f.trash!=1"><i class="fa fa-save"></i> Create</button>
                        <button type="button" class="btn btn-sm btn-primary" ng-click="oSave()"
                            ng-show="f.crud=='u' && f.trash!=1"><i class="fa fa-save"></i> Update</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oCopy()" ng-show="f.crud=='u'"><i
                                class="fa fa-copy"></i> Copy</button>
                        <button type="button" class="btn btn-sm btn-danger" ng-click="oDel()"
                            ng-show="f.crud=='u'&& f.trash!=1"><i class="fa fa-trash"></i> Delete</button>
                        <button type="button" class="btn btn-sm btn-warning" ng-click="oRestore()"
                            ng-show="f.crud=='u' && f.trash==1"><i class="fa fa-recycle"></i> Restore</button>
                        <button type="button" class="btn btn-sm btn-info" ng-click="oLog()" ng-show="f.crud=='u'"><i
                                class="fa fa-clock-o"></i> Log</button>
                        <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
            <hr>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item
                    <br>Trashed
                </div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.userid)">
                            <td title="'Userid'" filter="{userid: 'text'}" sortable="'userid'">{{ v . userid }}</td>
                            <td title="'Username'" filter="{username: 'text'}" sortable="'username'">{{ v . username }}
                            </td>
                            
                            <td title="'Phone'" filter="{phone: 'text'}" sortable="'phone'">{{ v . phone }}</td>
                            <td title="'Gender'" filter="{gender: 'text'}" sortable="'gender'">{{ v . gender }}</td>
                            
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Userid</label>
                            <input type="text" ng-model="h.userid" id="h_userid" class="form-control input-sm" required
                                maxlength="15" ng-readonly="f.crud!='c'" tabindex="1">
                            <label>Phone</label>
                            <input type="text" ng-model="h.phone" id="h_phone" class="form-control input-sm" maxlength="30"
                                tabindex="5">
                        </div>
                        <div class="col-sm-3">
                            <label>Username</label>
                            <input type="text" ng-model="h.username" id="h_username" class="form-control input-sm" required
                                maxlength="30" tabindex="2">
                            <label>Email</label>
                            <input type="text" ng-model="h.email" id="h_email" class="form-control input-sm" maxlength="50"
                                tabindex="6">
                        </div>
                        <div class="col-sm-3">
                            <label>Password</label>
                            <input type="password" ng-model="h.password" id="h_password" class="form-control input-sm"
                                maxlength="64" tabindex="3">
                            <label>Gender</label>
                            <select ng-model="h.gender" id="h_gender" class="form-control input-sm" tabindex="7">
                                <option ng-repeat="v in [['L','Laki-laki'],['P','Perempuan']]" ng-value="v[0]">
                                    {{ v[1] }}</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Password Confirmation</label>
                            <input type="password" ng-model="h.repassword" id="h_repassword" class="form-control input-sm"
                                maxlength="64" tabindex="4">
                            <label>Default Project</label>
                            <select ng-model="h.def_plant" id="h_def_plant" class="form-control input-sm" tabindex="8">
                                <option ng-repeat="v in plantAll" ng-value="v.plant">{{ v . plantname }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Image Profile</label>
                            <select ng-model="h.url_img" id="h_url_img" class="form-control input-sm" tabindex="9">
                                <option ng-repeat="v in m" ng-value="v.name">{{ v . name . substr(19) }}</option>
                            </select>
                            <div class="thumbnail" ng-hide="h.url_img==null">
                                <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ h . url_img }}" alt="Image Profile">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Signature</label>
                            <select ng-model="h.url_sign" id="h_url_sign" class="form-control input-sm" tabindex="10">
                                <option ng-repeat="v in m" ng-value="v.name">{{ v . name . substr(19) }}</option>
                            </select>
                            <div class="thumbnail" ng-hide="h.url_sign==null">
                                <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{ h . url_sign }}" alt="Signature">
                            </div>
                        </div>
                    </div>
                    <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?php echo e(url('sys_syuser')); ?>");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                trash: 0,
                userid: "<?php echo e(Auth::user()->userid); ?>",
                plant: "<?php echo e(Auth::user()->def_plant); ?>"
            };
            $scope.h = {};
            $scope.m = [];

            $scope.oCekPlant = function() {
                SfService.httpGet("sys_syplant_cek_data", {
                    userid: $scope.f.userid,
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.cek_plant = jdata.data.data_cek_plant;
                });
            }
            $scope.oCekPlant();

            var uploader = $scope.uploader = new FileUploader({
                url: "<?php echo e(url('upload_file')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    item.formData = [{
                        id: $scope.h.userid,
                        path: 'sys_syuser',
                        s: 'i',
                        userid: $scope.f.userid,
                        plant: $scope.f.plant
                    }];
                },
                onSuccessItem: function(fileItem, response, status, headers) {
                    $scope.oGallery();
                }
            });

            $scope.oGallery = function() {
                SfGetMediaList('sys_syuser/' + $scope.h.userid, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
                });
            }

            $scope.oPlant = function() {
                SfService.httpGet("sys_syplant_all", {
                    plant: $scope.f.plant
                }, function(jdata) {
                    $scope.plantAll = jdata.data.plant_all;
                });
            }

            $scope.oNew = function() {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {};
                SfFormNew("#frm");
            }

            $scope.oCopy = function() {
                $scope.f.crud = 'c';
                $scope.h.userid = null;
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
                                trash: $scope.f.trash
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
                    $scope.f.crud = 'u';
                    $scope.oGallery();
                });
            }

            $scope.oDel = function(id, isRestore) {
                if (id == undefined) {
                    var id = $scope.h.userid;
                }
                SfService.delete(SfService.getUrl("/" + encodeURI(id)), {
                    restore: isRestore
                }, function(jdata) {
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
                            var jdata = JSON.parse(jsondata);
                            $("#" + selector).val(id).trigger('input');;
                        });
                        break;*/
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('sys_syuser', $scope.h.userid);
            }

            $scope.oSyncLdap = function() {
                swal({
                    title: "Are you sure?",
                    text: "Syncronize LDAP User. Maybe run in long time ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Syncronize',
                    preConfirm: () => {
                        return fetch("<?php echo e(url('sys_syuser_syncldap')); ?>")
                            .then(response => response.json())
                            .then(data => swal.insertQueueStep(data.ip))
                            .catch(() => {
                                swal.insertQueueStep({
                                    type: 'error',
                                    title: 'Unable to Syncronize'
                                })
                            });

                    }
                });
            }

            $scope.oSearch();
            $scope.oPlant();
        }]);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/web_admin/backend/resources/views/sys/syuser/syuser_frm.blade.php ENDPATH**/ ?>