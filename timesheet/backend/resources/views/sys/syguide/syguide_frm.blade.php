@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')User Guide @stop
<!-- ------------------------------------------------------------------------------- -->
@section('title-small') @stop
<!-- ------------------------------------------------------------------------------- -->
@section('breadcrumb')
    <span ng-show="f.tab=='dash'">Home</span>
    <span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> @stop
<!-- ------------------------------------------------------------------------------- -->
@section('content')
    <link href="{{ url('coloradmin') }}/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"
        rel="stylesheet" />
    <link href="{{ url('coloradmin') }}/assets/plugins/bootstrap-wysihtml5/lib/css/wysiwyg-color.css" rel="stylesheet" />
    <script src="{{ url('coloradmin') }}/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="{{ url('coloradmin') }}/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
    <div class="" ng-show="f.tab=='dash'">
        <div class="row">
            <div class="col-sm-4 p-0 hidden-print">
                <label>Categories</label>
                <select class="form-control input-sm" ng-model="f.cat" ng-change="oSearchNav()">
                    <option value="">All Categories</option>
                    <option ng-repeat="v in f.arrcat" ng-value="v[0]">@{{ v[1] }}</option>
                </select>
                <div class="input-group p-b-15 p-t-15">
                    <input type="text" class="form-control input-sm" ng-model="f.q" ng-enter="oSearchNav()"
                        placeholder="Search">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default btn-sm" ng-click="oSearchNav()"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
                <table ng-table="tableNav" show-filter="false" class="table d table-hover">
                    <tr ng-repeat="v in $data" class="pointer " ng-click="oRead(v.id)">
                        <td title="'Guidance List'" filter="{subj: 'text'}" sortable="'subj'"
                            ng-class="{'bg-silver': v.id == h.id}"><i class="fa fa-arrow-right"></i> @{{ v . subj }}
                        </td>
                    </tr>
                </table><br><br><br>
                <hr>
                <?php if (\App\Sf::allowed('SYS_SYGUIDE_R')): ?>
                <div class="text-center"><a href="javascript:;" ng-click="oSearch();">Add New</a></div>
                <?php endif;?>
            </div>
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading f-s-20 f-w-700">
                        @component('layouts.common.coloradmin.panel_button') @endcomponent
                        <div>@{{ h . subj }} &nbsp;</div>
                    </div>
                    <div class="panel-body">
                        <div ng-if="status=='error'">
                            <div class="alert alert-danger">
                                @{{ msg }}
                            </div>
                        </div>
                        <div>
                            <div id="body-show">
                            </div>
                            <div ng-show="m.length>0">
                                <h3>Atachment</h3>
                                <ol>
                                    <li ng-repeat="v in m"><a target="_blank"
                                            href="{{ \App\Sf::fileFtpAuthUrl() }}/@{{ v . name }}">@{{ v . file_name }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary" ng-hide="f.tab=='dash'">
        <div class="panel-heading">
            @component('layouts.common.coloradmin.panel_button') @endcomponent @yield('breadcrumb')
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
                        @component('layouts.common.coloradmin.upload') @endcomponent
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='dash';oSearchNav();"
                    ng-title="Kembali ke Halaman Awal"><i class="fa fa-arrow-left"></i> Home</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru"
                    ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
                <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'"
                    ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
            <br>
            <div ng-show="f.tab=='list'">
                <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted
                    item<br>Trashed</div>
                <div id="div1" class="table-responsive">
                    <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover"
                        style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                            <td title="'Id'" filter="{id: 'text'}" sortable="'id'">@{{ v . id }}</td>
                            <td title="'Subject'" filter="{subj: 'text'}" sortable="'subj'">@{{ v . subj }}</td>
                            <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">@{{ v . plant }}</td>
                            <td title="'Category'" filter="{cat: 'text'}" sortable="'cat'">@{{ v . cat }}</td>
                            <td title="'Tag'" filter="{tag: 'text'}" sortable="'tag'">@{{ v . tag }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <form action="#" name="frm" id="frm">
                    <div>
                        <label>Subject</label>
                        <input type="text" ng-model="h.subj" id="h_subj" class="form-control input-sm" required
                            maxlength="200">
                    </div>
                    <div class="p-t-15">
                        <textarea id="wysihtml5" ng-model="h.body" id="h_body" class="form-control input-sm"
                            rows="15"></textarea>
                    </div>
                    <div class="row p-t-5">
                        <div class="col-sm-4">
                            <label>Category</label>
                            <div class="input-group">
                                <select ng-model="h.cat" id="h_cat" class="form-control input-sm">
                                    <option ng-repeat="v in f.arrcat" ng-value="v[0]">@{{ v[1] }}</option>
                                </select>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-default" ng-click="addCombo('path')"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <input type="hidden" ng-model="h.id" id="h_id" class="form-control input-sm" maxlength="">
                            <div ng-if="false">
                                <label>Plant</label>
                                <select ng-model="h.plant" id="h_plant" class="form-control input-sm">
                                    <option ng-value="null">All Plant</option>
                                    <?php foreach ($syplant as $k => $v): ?>
                                    <option ng-value="{{ $v->plant }}">{{ $v->plant }} {{ $v->plantname }}
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Tag</label>
                            <input type="text" ng-model="h.tag" id="h_tag" class="form-control input-sm" maxlength="200">
                        </div>
                    </div>
                    <hr> @component('layouts.common.coloradmin.form_attr') @endcomponent
                </form>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("{{ url('sys_syguide') }}");
            $scope.f = {
                crud: 'c',
                tab: 'dash',
                trash: 0,
                userid: "{{ Auth::user()->userid }}",
                plant: "{{ Auth::user()->def_plant }}",
                arrcat: [],
                cat: ''
            };
            <?php
foreach ($syguide_cat as $key => $v): ?>
                $scope.f.arrcat.push(["{{ $v->cat }}", "{{ $v->cat }}"]);
            <?php
endforeach;?>
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
                url: "{{ url('upload_file') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onBeforeUploadItem: function(item) {
                    item.formData = [{
                        id: $scope.h.id,
                        path: 'sys_syguide',
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
                SfGetMediaList('sys_syguide/' + $scope.h.id, function(jdata) {
                    $scope.m = jdata.files;
                    $scope.$apply();
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
                $scope.h.id = null;
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

            $scope.oSearchNav = function(trash, order_by) {
                $scope.f.trash = trash;
                $scope.tableNav = new NgTableParams({}, {
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl("_list"), {
                            params: {
                                page: $scope.tableNav.page(),
                                limit: $scope.tableNav.count(),
                                order_by: $scope.tableNav.orderBy(),
                                q: $scope.f.q,
                                cat: $scope.f.cat,
                                trash: $scope.f.trash
                            }
                        }).then(function(jdata) {
                            $btn.button('reset');
                            $scope.tableNav.total(jdata.data.data.total);
                            return jdata.data.data.data;
                        }, function(error) {
                            $btn.button('reset');
                            swal('', error.data, 'error');
                        });
                    }
                });
            }

            $scope.oSave = function() {
                $scope.h.body = $("#wysihtml5").val();
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
                    $('iframe').contents().find('.wysihtml5-editor').html($scope.h.body);
                });
            }

            $scope.oRead = function(id) {
                SfService.httpGet(SfService.getUrl("_read"), {
                    id: id
                }, function(jdata) {
                    $("#body-show").html('');
                    $scope.h = jdata.data.h;
                    $scope.msg = jdata.data.msg;
                    $scope.status = jdata.data.status;
                    $("#body-show").html($scope.h.body);
                    $scope.oGallery();
                });
            }

            $scope.oDel = function(id, isRestore) {
                if (id == undefined) {
                    var id = $scope.h.id;
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
                            $("#" + selector).val(id).trigger('input');;
                        });
                        break;*/
                    default:
                        swal('Sorry', 'Under construction', 'error');
                        break;
                }
            }

            $scope.oLog = function() {
                SfLog('sys_syguide', $scope.h.id);
            }

            $scope.addCombo = function(id) {
                switch (id) {
                    case 'path':
                        swal({
                                title: 'Add new path',
                                input: 'text',
                                showCancelButton: true,
                            })
                            .then((value) => {
                                $scope.f.arrcat.push([value.value, value.value]);
                                $scope.$apply();
                            });
                        break;
                }
            }

            $scope.oSearchNav();

            var handleEmailToInput = function() {
                // $("#email-to").tagit({ availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"] });
            };
            var handleEmailContent = function() {
                $("#wysihtml5").wysihtml5();
            };
            var EmailCompose = function() {
                "use strict";
                return {
                    init: function() {
                        handleEmailToInput();
                        handleEmailContent()
                    }
                }
            }()

            EmailCompose.init();
            $("ul.wysihtml5-toolbar li a.btn").addClass('btn-sm');
        }]);

    </script>
@endsection
