<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Messages <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<!-- <link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" /> -->
<link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
<link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-wysihtml5/lib/css/wysiwyg-color.css" rel="stylesheet" />
<!-- ================== END PAGE CSS STYLE ================== -->
<div id="content" class="content content-full-width" style="margin: -20px -25px">
    <div class="vertical-box">
        <div class="vertical-box-column width-250">
            <div class="wrapper bg-silver text-center">
                <a href="javascript:;" ng-click="oNew()"  class="btn btn-success p-l-40 p-r-40 btn-sm">Compose</a>
            </div>
            <div class="wrapper">
                <p><b>FOLDERS</b></p>
                <ul class="nav nav-pills nav-stacked nav-sm">
                    <li ng-class="{active : f.dir=='inbox'}"><a href="javascript:;" ng-click="oDir('inbox')"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox</a></li>
                    <li ng-class="{active : f.dir=='sent'}"><a  href="javascript:;" ng-click="oDir('sent')"><i class="fa fa-send fa-fw m-r-5"></i> Sent</a></li>
                    <li ng-class="{active : f.dir=='trash'}"><a  href="javascript:;" ng-click="oDir('trash')"><i class="fa fa-trash-o fa-fw m-r-5"></i> Trash</a></li>
                </ul>
            </div>
        </div>
        <div class="vertical-box-column bg-white">
            <div class="wrapper bg-silver-lighter clearfix">
                <div class="btn-group m-r-5">
                    <a href="javascript:;" class="btn btn-white btn-sm" ng-click="f.tab='list'"  ng-show="f.tab=='frm' ||f.tab=='read'"><i class="fa fa-times"></i></a>
                </div>
                <div class="btn-group m-r-5">
                    <a href="javascript:;" class="btn btn-white btn-sm" ng-show="f.tab=='read'"><i class="fa fa-reply"></i></a>
                </div>
                <div class="btn-group m-r-5">
                    <a href="javascript:;" ng-click="oDel();" class="btn btn-white btn-sm p-l-20 p-r-20" ng-show="f.tab=='read'"><i class="fa fa-trash"></i></a>
                    <a href="javascript:;" ng-click="oSave()" class="btn btn-white btn-sm p-l-20 p-r-20" ng-show="f.tab=='frm'"><i class="fa fa-send"></i></a>
                    <a href="javascript:;" ng-click="oNew()" class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-file"></i></a>
                </div>
                <div class="pull-right form-inline">
                    <div class="input-group " ng-show="f.tab=='list'">
                        <input type="text" class="form-control input-sm" placeholder="Search" ng-enter="oSearch()" />
                        <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button" ng-click="oSearch()"><i class="fa fa-search"></i></button></span>
                    </div>
                    <div class="btn-group btn-toolbar m-l-5 hidden" ng-show="f.tab=='list'">
                        <a href="javascript:;" class="btn btn-white btn-sm disabled"><i class="fa fa-arrow-up"></i></a>
                        <a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-arrow-down"></i></a>
                    </div>
                    <div class="btn-group m-l-5">
                        <a href="javascript:;" class="btn btn-white btn-sm" ng-click="f.tab='list'"  ng-show="f.tab=='frm' ||f.tab=='read'"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="wrapper" ng-show="f.tab=='list'" style="min-height: 600px">
                <div class="email-content table-responsive">
                    <table xclass="table table-email" ng-table="tableList" class="table table-hover" style="white-space: nowrap;">
                        <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.msg_id)">
                            <td class="email-select"><a href="#" data-click="email-select-single"><i class="fa fa-square-o fa-fw"></i></a></td>
                            <td class="email-sender text-lowercase" title="'Sender'" sortable="'npk_from'">{{v.rel_npk_from.username}}</td>
                            <td class="email-sender text-lowercase" title="'To'">
                                <span ng-repeat="va in v.rel_symsgd1 | limitTo:2">{{va.rel_userid.username}},</span>
                            </td>
                            <td class="email-subject" title="'Subject'" sortable="'subj'">{{v.subj}}
                            </td>
                            <td class="email-date">{{v.created_at}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div ng-show="f.tab=='frm'">
                <div class="p-30 bg-white">
                    <form action="/" method="POST" name="email_to_form">
                        <label class="control-label">To : <span class="label label-primary pointer" ng-click="oLookup('syuser','to')">Add To</span></label>
                        <div class="m-b-15">
                            <span class="label label-inverse m-r-5"  ng-repeat="v in d | filter:{tocc:'to'}">{{v.userid}} {{v.username}} <i class="fa fa-times"></i></span>
                        </div>
                        <label class="control-label">Cc : <span class="label label-primary pointer" ng-click="oLookup('syuser','cc')">Add Cc</span></label>
                        <div class="m-b-15">
                            <span class="label label-inverse m-r-5"  ng-repeat="v in d | filter:{tocc:'cc'}">{{v.userid}} {{v.username}} <i class="fa fa-times"></i></span>
                        </div>
                        <label class="control-label">Bcc : <span class="label label-primary pointer" ng-click="oLookup('syuser','bc')">Add Bcc</span></label>
                        <div class="m-b-15">
                            <span class="label label-inverse m-r-5"  ng-repeat="v in d | filter:{tocc:'bc'}">{{v.userid}} {{v.username}} <i class="fa fa-times"></i></span>
                        </div>
                        <label class="control-label">Subject:</label>
                        <div class="m-b-15">
                            <input type="text" ng-model="h.subj" class="form-control" />
                        </div>
                        <label class="control-label">Content:</label>
                        <div class="m-b-15">
                            <textarea ng-model="h.body" class="textarea form-control" id="wysihtml5" placeholder="Enter text ..." rows="12"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary p-l-40 p-r-40" ng-click="oSave()">Send</button>
                    </form>
                </div>
            </div>
            <div class="wrapper" ng-show="f.tab=='read'">
                <h4 class="m-b-15 m-t-0 p-b-10 underline">{{h.subj}}</h4>
                <ul class="media-list underline m-b-20 p-b-15">
                    <li class="media media-sm clearfix">
                        <a href="javascript:;" class="pull-left"><img class="media-object rounded-corner" alt="" src="<?php echo e(\App\Sf::fileFtpUrl('/')); ?>/{{h.rel_npk_from.url_img}}" /></a>
                        <div class="media-body">
                            <span class="email-from text-inverse f-w-600">From {{h.rel_npk_from.username}} </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> {{h.rel_npk_from.created_at}}</span><br />
                            <div class="email-to">To:
                                <span ng-repeat="v in h.rel_symsgd1 | filter:{tocc:'to'}">{{v.rel_userid.username}},</span>
                            </div>
                            <div class="email-to">Cc:
                                <span ng-repeat="v in h.rel_symsgd1 | filter:{tocc:'cc'}">{{v.rel_userid.username}},</span>
                            </div>
                            <div class="email-to">Bcc:
                                <span ng-repeat="v in h.rel_symsgd1 | filter:{tocc:'bc'}">{{v.rel_userid.username}},</span>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="attached-document clearfix">
                    <li ng-repeat="v in m">
                        <div class="document-name"><a  target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl()); ?>/{{v.name}}">{{v.file_name}}</a></div>
                        <div class="document-file">
                            <a target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl()); ?>/{{v.name}}"><i class="fa fa-file-pdf-o"></i></a>
                        </div>
                        <div class="p-5 text-center">{{v.size}}KB</div>
                    </li>
                </ul>
                <p class="f-s-12 text-inverse" id="h_body_read"></p>
                <hr>
                <div ng-show="h.npk_from==f.userid">
                    <?php $__env->startComponent('layouts.common.coloradmin.upload'); ?> <?php echo $__env->renderComponent(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('sys_symsgh')); ?>");
    $scope.f = { crud: 'c', tab: 'list', trash: 0, userid: "<?php echo e(Auth::user()->userid); ?>", plant: "<?php echo e(Session::get('plant')); ?>", dir: 'inbox' };
    $scope.h = {};
    $scope.d = [];
    $scope.m = [];

    var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            item.formData = [{ id: $scope.h.msg_id, path: 'sys_symsgh', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('sys_symsgh/' + $scope.h.msg_id, function(jdata) {
            $scope.m = jdata.files;
            $scope.$apply();
        });
    }

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = { npk_from: $scope.f.userid };
        SfFormNew("#frm");
    }

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.msg_id = null;
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
                        dir: $scope.f.dir,
                        userid:$scope.f.userid
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

    $scope.oDir = function(tipe) {
        $scope.f.tab = 'list';
        $scope.f.dir = tipe;
        $scope.oSearch();
    }

    $scope.oSave = function() {
        $scope.h.body = $("#wysihtml5").val();
        SfService.save("#frm", SfService.getUrl(), {
            h: $scope.h,
            d: $scope.d,
            f: $scope.f
        }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oShow = function(id) {
        SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
            $scope.f.tab = 'read';
            $scope.h = jdata.data.h;
            $("#h_body_read").html($scope.h.body);
            $scope.oGallery();
        });
    }

    $scope.oDel = function(id, isRestore) {
        if (id == undefined) {
            var id = $scope.h.msg_id;
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
            case 'syuser':
                SfLookup("<?php echo e(url('sys_syuser_lookup')); ?>", function(id, name, jsondata) {
                    $scope.d.push({ userid: id, username: name, tocc: selector });
                    $scope.$apply();
                });
                break;
            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

    $scope.oLog = function() {
        SfLog('sys_symsgh', $scope.h.msg_id);
    }

    $scope.oDir('inbox');

    $("h1.page-header").hide();
    $("ol.page-breadcrumb").hide();
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/symsgh/symsgh_frm.blade.php ENDPATH**/ ?>