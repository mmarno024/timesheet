<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Calendar <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='dash'">Schedule</span>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" media='print' />
<link href="<?php echo e(url('coloradmin')); ?>/assets/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" />
<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo e(url('coloradmin')); ?>/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
    </div>
    <div class="panel-body p-0">
        <div class=" form-inline">
            <div class="pull-right">
                <div ng-show="f.tab=='list'">
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
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-title="Kembali ke Halaman Awal" ng-show="f.tab=='frm'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <div ng-show="f.tab=='dash'">
            <div class="vertical-box">
                <div class="vertical-box-column p-15 bg-silver width-200">
                    <div id="external-events" class="fc-event-list">
                        <h5 class="m-t-0 m-b-10">Draggable Events</h5>
                        <div class="fc-event" data-color="#00acac">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-success"></i></div> Meeting with Client
                        </div>
                        <div class="fc-event" data-color="#348fe2">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-primary"></i></div> IOS App Development
                        </div>
                        <div class="fc-event" data-color="#f59c1a">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-warning"></i></div> Group Discussion
                        </div>
                        <div class="fc-event" data-color="#ff5b57">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-danger"></i></div> New System Briefing
                        </div>
                        <div class="fc-event">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-inverse"></i></div> Brainstorming
                        </div>
                        <h5 class="m-t-20 m-b-10">Other Events</h5>
                        <div class="fc-event" data-color="#b6c2c9">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 1
                        </div>
                        <div class="fc-event" data-color="#b6c2c9">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 2
                        </div>
                        <div class="fc-event" data-color="#b6c2c9">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 3
                        </div>
                        <div class="fc-event" data-color="#b6c2c9">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 4
                        </div>
                        <div class="fc-event" data-color="#b6c2c9">
                            <div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 5
                        </div>
                    </div>
                </div>
                <div id="calendar" class="vertical-box-column p-15 calendar"></div>
            </div>
        </div>
        <div ng-show="f.tab=='list'">
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item<br>Trashed</div>
            <div id="div1" class="table-responsive">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" style="white-space: nowrap;">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.id)">
                        <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                        <td title="'Userid'" filter="{userid: 'text'}" sortable="'userid'">{{v.userid}}</td>
                        <td title="'Plant'" filter="{plant: 'text'}" sortable="'plant'">{{v.plant}}</td>
                        <td title="'Subj'" filter="{subj: 'text'}" sortable="'subj'">{{v.subj}}</td>
                        <td title="'Note'" filter="{note: 'text'}" sortable="'note'">{{v.note}}</td>
                        <td title="'Style'" filter="{style: 'text'}" sortable="'style'">{{v.style}}</td>
                        <td title="'Start At'" filter="{start_at: 'text'}" sortable="'start_at'">{{v.start_at}}</td>
                        <td title="'Finish At'" filter="{finish_at: 'text'}" sortable="'finish_at'">{{v.finish_at}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Id</label>
                        <input type="text" ng-model="h.id" id="h_id" class="form-control input-sm" readonly maxlength="">
                        <label>Userid</label>
                        <input type="text" ng-model="h.userid" id="h_userid" class="form-control input-sm" maxlength="15">
                        <label>Plant</label>
                        <input type="text" ng-model="h.plant" id="h_plant" class="form-control input-sm" maxlength="10">
                    </div>
                    <div class="col-sm-4">
                        <label>Subj</label>
                        <input type="text" ng-model="h.subj" id="h_subj" class="form-control input-sm" maxlength="100">
                        <label>Note</label>
                        <input type="text" ng-model="h.note" id="h_note" class="form-control input-sm" maxlength="65535">
                        <label>Style</label>
                        <input type="text" ng-model="h.style" id="h_style" class="form-control input-sm" maxlength="200">
                    </div>
                    <div class="col-sm-4">
                        <label>Start At</label>
                        <input type="text" ng-model="h.start_at" id="h_start_at" class="form-control input-sm" maxlength="">
                        <label>Finish At</label>
                        <input type="text" ng-model="h.finish_at" id="h_finish_at" class="form-control input-sm" maxlength="">
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <hr> <?php $__env->startComponent('layouts.common.coloradmin.form_attr'); ?> <?php echo $__env->renderComponent(); ?>
            </form>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('sys_sycalendar')); ?>");
    $scope.f = { crud: 'c', tab: 'dash', trash: 0, userid: "<?php echo e(Auth::user()->userid); ?>", plant: "<?php echo e(Session::get('plant')); ?>" };
    $scope.h = {};
    $scope.m = [];

    var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            item.formData = [{ id: $scope.h.group_id, path: 'sys_sycalendar', s: 'i', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.oGallery = function() {
        SfGetMediaList('sys_sycalendar/' + $scope.h.group_id, function(jdata) {
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

    $scope.oSave = function() {
        SfService.save("#frm", SfService.getUrl(), {
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oSearch();
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
            var id = $scope.h.id;
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
        SfLog('sys_sycalendar', $scope.h.id);
    }

    // $scope.oSearch();
    $scope.oAddCalendar = function(json) {
        $scope.h = {
            id:json._id,
            subj: json.title,
            start_at: moment(json.start).format("YYYY-MM-DD HH:MM"),
            finish_at: moment(json.end).format("YYYY-MM-DD HH:MM"),
            userid: $scope.f.userid,
            plant: $scope.f.plant,
            style: "#00acac"
        };
        $scope.oSave();

    }

    $scope.getListCalendar = function() {

        SfService.httpGet(SfService.getUrl('_listCalendar'), {
            userid: $scope.f.userid,
            plant: $scope.f.plant
        }, function(jdata) {
            console.log(jdata.data.arr);
            $("#calendar").fullCalendar( 'addEventSource', jdata.data.arr );
            return false;
        });

    }

}]);

var handleCalendarDemo = function() {

    $('#external-events .fc-event').each(function() {

        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true, // maintain when user navigates (see docs on the renderEvent method)
            color: ($(this).attr('data-color')) ? $(this).attr('data-color') : ''
        });
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });
    });

    var date = new Date();
    var currentYear = date.getFullYear();
    var currentMonth = date.getMonth() + 1;
    currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;

    $('#calendar').fullCalendar({
        header: {
            left: 'month,agendaWeek,agendaDay',
            center: 'title',
            right: 'prev,today,next '
        },
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function() {
            $(this).remove();
        },
        eventDrop:function(event){
            mainCtrl().oAddCalendar(event);
        },
        drop:function(event){
            console.log(event);
            mainCtrl().oAddCalendar(event);
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            swal({
                title: 'Write Notes',
                input: 'text',
                showCancelButton: true
            }).then((result) => {
                if (result.value) {
                    var title = result.value;
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        mainCtrl().oAddCalendar(eventData);
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                }
            })

        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: mainCtrl().getListCalendar()
    });
};

var Calendar = function() {
    "use strict";
    return {
        //main function
        init: function() {
            handleCalendarDemo();
        }
    };
}();

$(document).ready(function() {

    handleCalendarDemo();
    // mainCtrl().getListCalendar();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/sycalendar/sycalendar_frm.blade.php ENDPATH**/ ?>