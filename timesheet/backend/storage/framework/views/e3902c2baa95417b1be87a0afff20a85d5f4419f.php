<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?> <?php echo e(@$request->cat); ?> Project <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span ng-show="f.tab=='list'">Data List</span>
<span ng-show="f.tab=='frm'">Form Entry</span>
<span ng-show="f.tab=='todo'">Todays Task List</span>
<?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>

<div class="panel panel-success">
    <div class="panel-heading">
        <?php $__env->startComponent('layouts.common.coloradmin.panel_button'); ?> <?php echo $__env->renderComponent(); ?> <?php echo $__env->yieldContent('breadcrumb'); ?>
    </div>
    <div class="panel-body">
        <div class="m-b-5 form-inline">
            <div class="pull-right">
                <div ng-show="f.tab=='list'">
                    <?php $__env->startComponent('layouts.common.coloradmin.guide',['tag'=>'trs_local_nprojh']); ?> <?php echo $__env->renderComponent(); ?>
                    <div class="input-group">
                        <div class="btn-group">
                            <!-- <button type="button" class="btn btn-success btn-sm" onclick="SfExportExcel('div1')"><i class="fa fa fa-file-excel-o"></i></button> -->
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
                    <span ng-if="f.crud!='c'"> <?php $__env->startComponent('layouts.common.coloradmin.chat',['route'=>'trs_local_nprojh','id'=>'h.proj_no']); ?> <?php echo $__env->renderComponent(); ?> </span>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="oNew()" ng-attr-title="Buat Baru" ng-show="f.tab=='list' && f.trash!=1"><i class="fa fa-plus"></i> New</button>
            <button type="button" class="btn btn-sm btn-info" ng-click="oTodaystask()" ng-attr-title="Tugas hari ini" ng-show="f.tab=='list'"><i class="fa fa-bell"></i> Today's Task</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('d6_aa')" ng-attr-title="Report" ng-show="f.template=='AA' && f.tab == 'list'"><i class="fa fa-table"></i> Report</button>
            <button type="button" class="btn btn-sm btn-inverse" ng-click="f.tab='list'" ng-attr-title="Kembali ke Halaman Awal" ng-show="f.tab!='list'"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <br>
        <div ng-show="f.tab=='list'">
            <div class="row ">
                <div class="col-sm-4">
                    <label>Type</label>
                    <select class="form-control input-sm" ng-model="f.type">
                        <option ng-repeat="v in arrtype" ng-value="v['id']">{{v['label']}}</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label ng-if="f.template !== 'QCC'">Object</label>
                    <label ng-if="f.template == 'QCC'">Bagian</label>
                    <select class="form-control input-sm" ng-model="f.obj">
                        <option ng-repeat="v in arrobj" ng-value="v['id']">{{v['label']}}</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label ng-if="f.template !== 'QCC'">Sub Object</label>
                    <label ng-if="f.template == 'QCC'">Nama Team</label>
                    <select class="form-control input-sm" ng-model="f.sub_obj">
                        <option ng-repeat="v in arrsub_obj | filter:{note:f.obj}:false " ng-value="v['id']" >{{v['label']}}</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>Status</label>
                    <select class="form-control input-sm" ng-model="f.stat">
                        <option ng-repeat="v in arrstat" ng-value="v['id']">{{v['label']}}</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>Year</label>
                    <input type="text" class="input-sm form-control" ng-model="f.year" awnum="default" ng-enter="oSearch()">
                </div>
                <div class="col-sm-4" ng-if="f.template == 'AA'">
                    <label>Request By</label>
                    <select class="form-control input-sm" ng-model="f.request_by" ng-if="f.sub_obj">
                        <option ng-repeat="v in arrreq_by | filter:{note:f.sub_obj}:false " ng-value="v['id']" >{{v['label']}}</option>
                    </select>
                    <select class="form-control input-sm" ng-model="f.request_by" ng-if="f.sub_obj == ''">
                        <option ng-repeat="v in arrreq_byall" ng-value="v['id']" >{{v['label']}}</option>
                    </select>
                </div>
                <div ng-class="{'col-sm-4': f.template !== 'AA', 'col-sm-12': f.template == 'QCC'}">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-sm btn-success btn-block" ng-click="oSearch()"><i class="fa fa-refresh"></i> Refresh</button>
                </div>
            </div><hr/>
            <div class="alert alert-warning" ng-show="f.trash==1"><i class="fa fa-warning fa-2x"></i> This is deleted item<br>Trashed</div>
            <div class="table-responsive"  style="white-space: nowrap;" ng-show="f.template !== 'QCC'">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover">
                    <tr ng-repeat="v in $data" class="pointer" ng-click="oShow(v.proj_no)">
                        <td title="'Project No'" filter="{proj_no: 'text'}" sortable="'proj_no'">{{v.proj_no}}</td>
                        <td title="'Object'" filter="{obj: 'text'}" sortable="'obj'" class="text-lowercase">{{v.obj_name=null?v.obj:v.obj_name}}</td>
                        <td title="'Sub Object'" filter="{sub_obj: 'text'}" sortable="'sub_obj'" class="text-lowercase">{{v.sub_obj_name=null?v.sub_obj:v.sub_obj_name}}</td>
                        <td title="'Project Name'" filter="{proj_name: 'text'}" sortable="'proj_name'" class="text-success">{{v.proj_name}}</td>
                        <td title="'Progress'" filter="{progress: 'text'}" sortable="'progress'" class="">
                            <div class="progress m-0">
                                <div class="progress-bar   " ng-class="{'progress-bar-success':v.progress>=100, 'progress-bar-warning':v.progress<100 && v.progress>0 , 'progress-bar-danger':v.progress<=0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{v.progress}}%;">
                                    {{v.progress}}%
                                </div>
                            </div>
                        </td>
                        <td title="'Status'" filter="{stat: 'text'}" sortable="'stat'" class="text-lowercase">{{v.stat_name==null?v.stat:v.stat_name}}</td>
                        <td title="'Request By'" filter="{requester: 'text'}" sortable="'requester'" class="text-lowercase">{{v.requester_name==null?v.requester:v.requester_name}}</td>
                        <td title="'Date'" filter="{proj_date: 'text'}" sortable="'proj_date'">{{v.proj_date}}</td>
                        <td title="'Note'" filter="{note: 'text'}" sortable="'note'">{{v.note}}</td>
                    </tr>

                </table>
            </div>
            <div class="table-responsive" style="white-space: nowrap;" ng-show="f.template == 'QCC'">
                <table ng-table="tableList" show-filter="false" class="table table-condensed table-hover" >
                    <tr ng-repeat="v in $data" class="pointer"  ng-click="oShow(v.proj_no)">
                        <td title="'BAGIAN'" filter="{obj: 'text'}" sortable="'obj'" class="text-uppercase" style="white-space: normal;">
                            <i class="fa fa-building"></i> {{v.obj_name=null?v.obj:v.obj_name}}
                        </td>
                        <td title="'TEAM'" filter="{sub_obj: 'text'}" sortable="'sub_obj'" class="text-uppercase" style="white-space: normal;">
                            <b class="text-bold text-primary"><u>{{v.sub_obj_name=null?v.sub_obj:v.sub_obj_name}}</u></b><br/>
                            <i class="fa fa-user"></i> {{v.requester_name==null?v.requester:v.requester_name}}
                        </td>
                        <td title="'Tema'" filter="{proj_name: 'text'}" sortable="'proj_name'" class="text-success text-bold" style="white-space: normal;">
                            <i class="fa fa-lightbulb-o"></i> <em>{{v.proj_name}}</em>
                        </td>
                        <td title="'Progress'" style="white-space: normal;">
                            <b class="badge" ng-class="{'badge-danger': v1.progress <= 60, 'badge-warning': v1.progress > 60 && v1.progress < 80, 'badge-success': v1.progress >= 80 && v1.progress < 100, 'badge-primary': v1.progress >= 100}" ng-repeat='v1 in v.rel_d3' style="margin: 2px;font-size: 11px;">L{{ $index + 1 }} : {{ v1.progress | number:0 }} %</b>

                        </td>
                        <td title="'Date'" filter="{proj_date: 'text'}" sortable="'proj_date'">
                            {{v.proj_date | date}} <br/>
                            <span class="badge badge-info"><i class="fa fa-calendar"></i> {{ (v.nama_semester)  }}</span>
                        </td>
                        <td title="'Nomor'" filter="{proj_no: 'text'}" sortable="'proj_no'" style="white-space: normal;"><em>{{v.proj_no}}</em></td>
                    </tr>

                </table>
            </div>
        </div>
        <div ng-show="f.tab=='frm'">
            <form action="#" name="frm" id="frm">
                <div class="row">
                    <div class="col-sm-4">
                        <label title='proj_no' ng-if="f.template !== 'QCC'">Project No</label>
                        <label title='proj_no' ng-if="f.template == 'QCC'">Nomor</label>
                        <input type="text" ng-model="h.proj_no" id="h_proj_no" class="form-control input-sm" readonly maxlength="15" ng-readonly="true">
                        <label title='proj_date'>Date</label>
                        <input type="date" ng-model="h.proj_date" id="h_proj_date" class="form-control input-sm" required maxlength="">
                        <label title='proj_name' ng-if="f.template !== 'QCC'">Project Name</label>
                         <label title='proj_name' ng-if="f.template == 'QCC'">Tema</label>
                        <input type="text" ng-model="h.proj_name" id="h_proj_name" class="form-control input-sm" required maxlength="100">
                    </div>
                    <div class="col-sm-4">
                        <label title='proj_type'>Type</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.proj_type+' | '+h.proj_type_name" id="h_proj_type" class="form-control input-sm" readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('proj_type','h_proj_type')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <label title='obj' ng-if="f.template !== 'QCC'">Object</label>
                        <label title='obj' ng-if="f.template == 'QCC'">Bagian</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.obj+' | '+h.obj_name" id="h_obj" class="form-control input-sm" readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('obj','h_obj')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <label title='sub_obj' ng-if="f.template !== 'QCC'">Sub Object</label>
                        <label title='sub_obj' ng-if="f.template == 'QCC'">Nama Team</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.sub_obj+' | '+h.sub_obj_name" id="h_sub_obj" class="form-control input-sm" readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('sub_obj','h_sub_obj')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label title='ticket' ng-if="f.template !== 'AA' && f.template !== 'QCC'">Ref. Ticket</label>
                        <div class="input-group" ng-if="f.template !== 'AA' && f.template !== 'QCC'">
                            <input type="text" ng-value="h.ticket+' | '+h.ticket_name" id="h_ticket" class="form-control input-sm" readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('ticket','h_ticket')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                        <label title='proj_source' ng-if="f.template == 'AA'">Referensi Project</label>
                        <div class="input-group" ng-if="f.template == 'AA'">
                            <input type="text" ng-model="h.proj_source" id="h_proj_source" class="form-control input-sm" readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('proj_source','h_proj_source')"><i class="fa fa-search"></i></button>
                                <button class="btn btn-danger btn-sm" type="button" ng-click="h.proj_source=null"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <label title='requester' ng-if="f.template !== 'QCC'">Request By</label>
                        <label title='requester' ng-if="f.template == 'QCC'">Theme Leader</label>
                        <div class="input-group">
                            <input type="text" ng-value="h.requester+' | '+h.requester_name" id="h_requester" class="form-control input-sm" readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('requester','h_requester')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <label title='stat' ng-if="f.template !== 'QCC'">Project Status</label>
                        <div class="input-group" ng-if="f.template !== 'QCC'">
                            <input type="text" ng-value="h.stat+' | '+h.stat_name" id="h_stat" class="form-control input-sm" required readonly maxlength="15">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button" ng-click="oLookup('stat','h_stat')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <label ng-if="false" title='note'>Note</label>
                        <input ng-if="false" type="text" ng-model="h.note" id="h_note" class="form-control input-sm" maxlength="50">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-success m-0">Description</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="progress">
                            <div class="progress-bar  progress-bar-striped" ng-class="{'progress-bar-success':calcProgress()>=100, 'progress-bar-warning':calcProgress()<100 && calcProgress()>0 , 'progress-bar-danger':calcProgress()<=0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{calcProgress()}}%;"> Progress {{calcProgress()}}%</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label title='proj_desc' class="text-bold">Project Name : {{h.proj_name}}</label>
                        <span class="btn btn-sm btn-xs btn-success" ng-click="h.proj_desc_edit=!h.proj_desc_edit"><i class="fa fa-pencil"></i> Edit</span>
                    </div>
                </div>

                <div ng-if="h.proj_desc_edit==true">
                    <summernote config="options" ng-model="h.proj_desc"></summernote>
                </div>
                <div ng-if="h.proj_desc_edit!=true">
                    <p ng-bind-html="h.proj_desc"></p>
                </div>
                <hr>
                <ul class="nav nav-pills">
                    <li class="active"><a href="ui_tabs_accordions.html#nav-pills-tab-2" data-toggle="tab" aria-expanded="false">Member <span class="badge">{{h.rel_d1.length}}</span> </a></li>
                    <li class=""><a href="ui_tabs_accordions.html#nav-pills-tab-3" data-toggle="tab" aria-expanded="false"  ng-if="f.template !== 'QCC'">Docs <span class="badge">{{h.rel_d2.length}}</span></a></li>
                    <li class=""><a href="ui_tabs_accordions.html#nav-pills-tab-4" data-toggle="tab" aria-expanded="false"  ng-if="f.template !== 'QCC'">Schedule <span class="badge">{{h.rel_d3.length}}</span></a></li>
                    <li class=""><a href="ui_tabs_accordions.html#nav-pills-tab-5" data-toggle="tab" aria-expanded="false"  ng-if="f.template !== 'QCC'">Cost <span class="badge">{{h.rel_d4.length}}</span></a></li>
                    <li class=""><a href="ui_tabs_accordions.html#nav-pills-tab-6" data-toggle="tab" aria-expanded="false"  ng-if="f.template !== 'QCC'">Notulen <span class="badge">{{h.rel_d5.length}}</span></a></li>
                    <li class="" ng-if="f.template !== 'AA' && f.template !== 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-7" data-toggle="tab" aria-expanded="false">Ticket <span class="badge">{{h.rel_has_ticket.length}}</span></a></li>
                    <li class="" ng-if="f.template !== 'AA' && f.template !== 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-8" data-toggle="tab" aria-expanded="false">Activity <span class="badge">{{h.rel_has_actv.length}}</span></a></li>
                    <li class="" ng-if="f.template !== 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-9" data-toggle="tab" aria-expanded="false">Plan Achievement <span class="badge">{{h.rel_d6.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-4" data-toggle="tab" aria-expanded="false">Prolog <span class="badge">{{h.rel_d3.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-11" data-toggle="tab" aria-expanded="false">L1 <span class="badge">{{h.rel_dl1.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-12" data-toggle="tab" aria-expanded="false">L2 <span class="badge">{{h.rel_dl2.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-13" data-toggle="tab" aria-expanded="false">L3 <span class="badge">{{h.rel_dl3.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-14" data-toggle="tab" aria-expanded="false">L4 <span class="badge">{{h.rel_dl4.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-15" data-toggle="tab" aria-expanded="false">L5 <span class="badge">{{h.rel_dl5.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-16" data-toggle="tab" aria-expanded="false">L6 <span class="badge">{{h.rel_dl6.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-17" data-toggle="tab" aria-expanded="false">L7 <span class="badge">{{h.rel_dl7.length}}</span></a></li>
                    <li class="" ng-if="f.template == 'QCC'"><a href="ui_tabs_accordions.html#nav-pills-tab-18" data-toggle="tab" aria-expanded="false">L8 <span class="badge">{{h.rel_dl8.length}}</span></a></li>
                </ul>
                <div class="tab-content p-t-0">
                    <div class="tab-pane fade active in" id="nav-pills-tab-2">
                        <div class="row">
                             <div class="col-sm-6"><h3 class="">MEMBER</h3></div>
                             <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('d1')" ng-if="f.template == 'QCC'"><i class="fa fa-line-chart"></i> Grafik Skill</button>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item" ng-repeat="v in h.rel_d1">
                                <div class="row">
                                    <div class="col-sm-3 pointer" ng-click="oLookup('d1_position',$index)">
                                        {{$index+1}}.
                                        <span ng-if="v.position!=null" class="text-success">{{v.position_name==null?v.position:v.position_name}}</span>
                                        <span ng-if="v.position==null" class="text-danger">Click here</span>
                                    </div>
                                    <div class="col-sm-5">
                                        <span ng-if="v.isldap == 1">
                                            <i class="fa fa-user"></i>
                                            <span ng-if="v.userid!=null" class="pointer" ng-click="oLookup('d1_userid',$index)">{{v.userid}} <i class="text-success">{{v.username}}</i></span>
                                            <span ng-if="v.userid==null" class="text-danger pointer"  ng-click="oLookup('d1_userid',$index)">Click here</span>

                                            <span class="label label-info pointer pull-right" ng-click="v.isldap = 0; v.userid = null">LDAP</span>
                                        </span>

                                        <span ng-if="v.isldap == 0" class="form-inline p-0">
                                            <i class="fa fa-user"></i>
                                            <input type="text" ng-model="v.userid" class="form-control input-sm dash-border-text" size="60" placeholder="Username..."/>
                                            <span class="label label-danger pointer pull-right" ng-click="v.isldap = 1; v.userid = null">Non LDAP</span>
                                        </span>

                                    </div>
                                    <div class="col-sm-3 p-0">
                                        <input type="text" ng-model="v.note" class="form-control input-sm no-border-text" style="margin: -6px;" placeholder="Note...">
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="pointer text-danger text-right" ng-click="oDelrow('d1',$index)"> <i class="fa fa-times"></i></div>

                                        <div class="pointer text-warning text-right" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1"  ng-if="f.template == 'QCC'"><i class="fa fa-chevron-right"></i></div>
                                        <div class="pointer text-warning text-right" ng-if="v.dethide == 1" ng-click="v.dethide = 0"  ng-if="f.template == 'QCC'"><i class="fa fa-chevron-down"></i></div>
                                    </div>
                                </div>
                                <div ng-if="f.template == 'QCC' && v.dethide == 1">
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-6"><h4 class="text-bold text-primary">Skill of Member</h4></div>
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveD1d($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                            <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                        </div>
                                    </div>
                                    <form action="#" id="frmD1d-{{ $index }}" class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="text-bold text-danger"> Skill of 8 Steps</label>
                                                <table class="table table-bordered table-striped table-condensed">
                                                    <thead><tr><th width="40%">Skill</th><th width="30%">Target</th><th width="30%">Level</th></tr></thead>
                                                    <tbody>
                                                        <tr ng-repeat="v1 in sk8steps">
                                                            <td class="text-bold">{{ v1.skill }}</td>
                                                            <td class="p-0">
                                                                <input type="text" ng-model="rel_d1d[v.id]['sk8steps'][v1.skill]['target']" class="form-control input-sm dash-border-text text-right" ng-init="rel_d1d[v.id]['sk8steps'][v1.skill]['target'] = v1.target" ng-if="rel_d1d[v.id]['sk8steps'][v1.skill]['target'] == null"/>
                                                                <input type="text" ng-model="rel_d1d[v.id]['sk8steps'][v1.skill]['target']" class="form-control input-sm dash-border-text text-right" ng-if="rel_d1d[v.id]['sk8steps'][v1.skill]['target']"/>
                                                            </td>
                                                            <td class="p-0">
                                                                <input type="text" ng-model="rel_d1d[v.id]['sk8steps'][v1.skill]['nilai']" class="form-control input-sm dash-border-text text-right"/>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="col-sm-6">
                                                <label class="text-bold text-danger"> Skill of 7 Tools</label>
                                                <table class="table table-bordered table-striped table-condensed">
                                                    <thead><tr><th width="40%">Skill</th><th width="30%">Target</th><th width="30%">Level</th></tr></thead>
                                                    <tbody>
                                                        <tr ng-repeat="v1 in sk7tools">
                                                            <td class="text-bold">{{ v1.skill }}</td>
                                                            <td class="p-0">
                                                                <input type="text" ng-model="rel_d1d[v.id]['sk7tools'][v1.skill]['target']" class="form-control input-sm dash-border-text text-right" ng-init="rel_d1d[v.id]['sk7tools'][v1.skill]['target'] = v1.target" ng-if="rel_d1d[v.id]['sk7tools'][v1.skill]['target'] == null"/>
                                                                <input type="text" ng-model="rel_d1d[v.id]['sk7tools'][v1.skill]['target']" class="form-control input-sm dash-border-text text-right" ng-if="rel_d1d[v.id]['sk7tools'][v1.skill]['target']"/>
                                                            </td>
                                                            <td class="p-0">
                                                                <input type="text" ng-model="rel_d1d[v.id]['sk7tools'][v1.skill]['nilai']" class="form-control input-sm dash-border-text text-right"/>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="text-bold text-danger"> Skill of Presentation</label>
                                                <table class="table table-bordered table-striped table-condensed">
                                                    <thead><tr><th width="40%">Skill</th><th width="30%">Target</th><th width="30%">Level</th></tr></thead>
                                                    <tbody>
                                                        <tr ng-repeat="v1 in skpresent">
                                                            <td class="text-bold">{{ v1.skill }}</td>
                                                            <td class="p-0">
                                                                <input type="text" ng-model="rel_d1d[v.id]['skpresent'][v1.skill]['target']" class="form-control input-sm dash-border-text text-right" ng-init="rel_d1d[v.id]['skpresent'][v1.skill]['target'] = v1.target" ng-if="rel_d1d[v.id]['skpresent'][v1.skill]['target'] == null"/>
                                                                <input type="text" ng-model="rel_d1d[v.id]['skpresent'][v1.skill]['target']" class="form-control input-sm dash-border-text text-right" ng-if="rel_d1d[v.id]['skpresent'][v1.skill]['target']"/>
                                                            </td>
                                                            <td class="p-0">
                                                                <input type="text" ng-model="rel_d1d[v.id]['skpresent'][v1.skill]['nilai']" class="form-control input-sm dash-border-text text-right"/>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('d1')"><i class="fa fa-plus"></i> Add Member</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-3">
                        <h3 class="">Documents</h3>
                        <ul class="list-group">
                            <li class="list-group-item" ng-repeat="v in h.rel_d2">
                                <div class="row">
                                    <div class="col-sm-4">
                                        {{$index+1}}. <span class="pointer" ng-click="oLookup('d2_doc_type',$index)">
                                            <span ng-if="v.doc_type!=null && v.doc_type_name==null" class="text-success">{{v.doc_type}}</span>
                                            <span ng-if="v.doc_type_name!=null" class="text-success">{{v.doc_type_name}}</span>
                                            <span ng-if="v.doc_type==null" class="text-danger">Click here</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm no-border-text" ng-model="v.file_name" style="margin: -6px" placeholder="Pilih file...">
                                            <option ng-repeat="v in m" ng-value="v.name">{{v.name.substr(35)}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" ng-model="v.doc_name" class="form-control input-sm no-border-text" style="margin: -6px;" placeholder="Doc Name...">
                                    </div>
                                    <div class="col-sm-2">
                                        <span ng-if="v.file_name!=null">
                                            <a class="pointer text-success text-bold" target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}"><i class="fa fa-eye"></i> </a>
                                            <a class="pointer text-success text-bold" target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}" download><i class="fa fa-download"></i> </a>
                                        </span>
                                        <span class="pointer text-danger" ng-click="oDelrow('d2',$index)"> <i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('d2')"><i class="fa fa-plus"></i> Add Document</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-4">
                        <h3 class="" ng-if="f.template !== 'QCC'">Schedule (Plan & Actual)</h3>

                        <div class="row"  ng-if="f.template == 'QCC'">
                            <div class="col-sm-6"><h3 class="">Prolog</h3></div>
                            <div class="col-sm-6 text-right"><br/><button type="button" class="btn btn-sm btn-warning" ng-click="oReport('prolog')"><i class="fa fa-table"></i> Report</button></div>
                        </div>


                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_d3" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('d3',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div ng-class="{'col-sm-7':f.template !== 'AA', 'col-sm-5':f.template == 'AA'}"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="2" ng-readonly="f.template == 'QCC'"></textarea></div>
                                    <div ng-class="{'col-sm-4':f.template !== 'AA', 'col-sm-3':f.template == 'AA'}"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="2"></textarea></div>
                                    <div class="col-sm-3" ng-if="f.template == 'AA'">
                                        <select ng-model="v.detail_group" class="form-control input-sm dash-border-text ">
                                            <option ng-repeat="v in [['COGS','COGS'],['PRODUCTIVITY','PRODUCTIVITY'],['ON PLAN','ON PLAN'],['CAPACITY','CAPACITY'],['SAVING AP','SAVING AP'],['WOOD COST','WOOD COST'],['OPERATIONAL COST','OPERATIONAL COST'],['ACCURACY','ACCURACY'],['SAFETY','SAFETY']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row p-t-5" ng-if="f.template !== 'QCC'">
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Plan Start</label>
                                        <input type="date" ng-model="v.plan_start" class="form-control input-sm dash-border-text">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Plan End</label>
                                        <input type="date" ng-model="v.plan_end" class="form-control input-sm dash-border-text">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Actual Start</label>
                                        <input type="date" ng-model="v.act_start" class="form-control input-sm  dash-border-text">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Actual End</label>
                                        <input type="date" ng-model="v.act_end" class="form-control input-sm dash-border-text">
                                    </div>
                                </div>
                                <div class="row p-t-5" ng-if="f.template == 'QCC'">
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Plan Start</label>
                                        <input type="month" ng-model="v.plan_start" class="form-control input-sm dash-border-text">
                                        <label class="m-b-0">Week Plan Start</label>
                                        <select ng-model="v.wplan_start" class="form-control input-sm dash-border-text">
                                            <option ng-repeat="v in [['W1','W1'], ['W2','W2'], ['W3','W3'], ['W4','W4']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Plan End</label>
                                        <input type="month" ng-model="v.plan_end" class="form-control input-sm dash-border-text">
                                        <label class="m-b-0">Week Plan End</label>
                                        <select ng-model="v.wplan_end" class="form-control input-sm dash-border-text">
                                            <option ng-repeat="v in [['W1','W1'], ['W2','W2'], ['W3','W3'], ['W4','W4']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Actual Start</label>
                                        <input type="month" ng-model="v.act_start" class="form-control input-sm  dash-border-text">
                                        <label class="m-b-0">Week Actual Start</label>
                                        <select ng-model="v.wact_start" class="form-control input-sm dash-border-text">
                                            <option ng-repeat="v in [['W1','W1'], ['W2','W2'], ['W3','W3'], ['W4','W4']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="m-b-0">Actual End</label>
                                        <input type="month" ng-model="v.act_end" class="form-control input-sm dash-border-text">
                                        <label class="m-b-0">Week Actual End</label>
                                        <select ng-model="v.wact_end" class="form-control input-sm dash-border-text">
                                            <option ng-repeat="v in [['W1','W1'], ['W2','W2'], ['W3','W3'], ['W4','W4']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row p-t-5">
                                    <div class="col-sm-3 text-right">
                                        <div class="input-group">
                                            <div class="input-group-addon bg-white" style="font-size: small;">Progress %</div>
                                            <input type="text" ng-model="v.progress" class="form-control input-sm dash-border-text" awnum="default" placeholder="0%">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="progress m-t-10" style="height: 5px">
                                            <div class="progress-bar  progress-bar-striped" ng-class="{'progress-bar-success':v.progress>=100, 'progress-bar-warning':v.progress<100 && v.progress>0 , 'progress-bar-danger':v.progress<=0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 1em; width: {{v.progress}}%;"> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 p-t-5 pointer" ng-click="oLookup('d3_status',$index)">Status :
                                        <span ng-if="v.status!=null" class="text-sm text-primary">#{{v.status_name==null?v.status:v.status_name}}</span>
                                        <span ng-if="v.status==null" class="text-sm text-danger">Click here</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="pointer" ng-click="oLookup('d3_userid',$index)">
                                            <i class="fa fa-user"></i>
                                            <span ng-if="v.userid!=null" class="text-lowercase" ng-attr-title="v.userid"> <i class="text-success">{{v.username}}</i></span>
                                            <span ng-if="v.userid==null" class="text-danger">Click here</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-1 p-t-5">
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null && f.template == 'AA'" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1 && f.template == 'AA'" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>
                                </div>
                                <div class="row" ng-if="f.template == 'AA' || f.template == 'QCC'">
                                    <div class="col-sm-12 p-t-10">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-paperclip"></i> Document</div>
                                            <select class="form-control input-sm" ng-model="v.file_name">
                                                <option ng-repeat="v in m" ng-value="v.name">{{v.name.substr(41)}}</option>
                                            </select>
                                            <div class="input-group-btn" ng-if="v.file_name!=null && v.file_name!=''">
                                                <a ng-if="f.template == 'AA'" class="btn btn-sm btn-success" target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}"><i class="fa fa-eye"></i></a>
                                                <a ng-if="f.template == 'QCC'" class="btn btn-sm btn-warning" href="#" ng-click="(v.showpic == 1 ? v.showpic = null : v.showpic = 1 )"><i class="fa fa-picture-o"></i></a>
                                                 <a ng-if="f.template == 'QCC'" class="btn btn-sm btn-danger" target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}"><i class="fa fa-file-pdf-o"></i></a>

                                            </div>

                                        </div>
                                        <div ng-if="v.file_name != null && v.file_name != '' && f.template == 'QCC' && v.showpic == 1" style="margin-bottom: 0px;" class="thumbnails">
                                            <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}" alt="Url Image" width="100%" onerror="this.src='<?=url('coloradmin/assets/img/no-pict.png')?>'">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-12">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6"><h4 class="text-bold text-primary">DETAIL ACTIVITY</h4></div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveD3d1($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save Detail</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmD3d1-{{ $index }}">
                                            <table class="table table-condensed d3m">
                                               <thead><tr><th class="text-center">ITEM</th><th class="text-center">YTD</th><th class="text-center" ng-repeat="a in range(1,12)">{{ moment(('00' + a).substr(-2) + "/01/2020").format("MMM") }}</th></tr></thead>
                                               <tbody ng-repeat="(k1,v1) in rel_d3m[v.detail_group]">
                                                   <tr>
                                                       <td ng-class="{'text-bold text-success': v1.reff == null}" style="white-space: nowrap;" ><span ng-if="v1.reff !== null">--- </span>{{ v1.item }}</td>
                                                       <td class="text-right text-bold text-primary"><span ng-if="rel_d3d1[v.id][k1]['ytd']['nilai']">{{ rel_d3d1[v.id][k1]['ytd']['nilai'] | number }}</span></td>
                                                       <td class="text-right" ng-repeat="a in range(1,12)" style="padding: 0px;vertical-align: middle">
                                                           <input type="text" ng-model="rel_d3d1[v.id][k1][a]['nilai']" class="form-control input-sm dash-border-text text-right" awnum="default" placeholder="0" ng-if="v1.fillable == 1" ng-keyup="fCalcd3d1(v.id, k1, a)">
                                                           <span ng-if="v1.formula && v1.formula !== 'AVERAGE'" class="text-right text-bold text-primary" style="padding: 0px;padding-right: 10px !important;">{{ rel_d3d1[v.id][k1][a]['nilai'] | number }}</span>
                                                       </td>
                                                   </tr>


                                               </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('d3')"  ng-if="f.template !== 'QCC'"><i class="fa fa-plus"></i> Add Schedule</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-5">
                        <h3 class="">Cost</h3>
                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_d4">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5 text-right text-bold">
                                        {{$index+1}}
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" ng-model="v.cost_item" class="form-control input-sm dash-border-text text-success" placeholder="Item Name...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" ng-model="v.qty" class="form-control input-sm dash-border-text text-right" placeholder="Qty" awnum="default">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" ng-model="v.cost_value" class="form-control input-sm dash-border-text text-right" placeholder="Rp" awnum="default">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" ng-model="v.note" class="form-control input-sm dash-border-text text-info" placeholder="Note...">
                                    </div>
                                    <div class="col-sm-1 p-5">
                                        <div class="pointer text-danger " ng-click="oDelrow('d4',$index)"> <i class="fa fa-times"></i></div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-4">
                                        <div class="pull-right">Total</div>
                                        <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('d4')"><i class="fa fa-plus"></i> Add Cost</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="dash-border-text text-right p-r-5" style="border-width: 1px;">{{sum(h.rel_d4,'qty') | number}}</div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="dash-border-text text-right p-r-5" style="border-width: 1px;">{{sum(h.rel_d4,'cost_value') | number}}</div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-1"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-6">
                        <div class="" ng-repeat="v in h.rel_d5">
                            <h3 class="panel-title text-success text-bold">#{{$index+1}} {{v.meeting_name}}</h3>
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="date" ng-model="v.meeting_date" class="form-control input-sm dash-border-text" placeholder="Date...">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" ng-model="v.meeting_name" class="form-control input-sm dash-border-text" placeholder="Meeting Name..">
                                </div>
                                <div class="col-sm-4 hidden">
                                    <input type="text" ng-model="v.note" class="form-control input-sm no-border-text" placeholder="Note..">
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-paperclip"></i></div>
                                            <select class="form-control input-sm" ng-model="v.file_name">
                                                <option ng-repeat="v in m" ng-value="v.name">{{v.name.substr(35)}}</option>
                                            </select>
                                            <div class="input-group-btn" ng-if="v.file_name!=null && v.file_name!=''">
                                                <a class="btn btn-sm btn-success" target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" target="_blank" href="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v.file_name}}" download><i class="fa fa-download"></i></a>
                                                <div class="btn btn-sm btn-danger" ng-click="oDelrow('d5',$index)"> <i class="fa fa-times"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <span class="btn btn-xs btn-success" ng-click="v.notulen_edit=!v.notulen_edit"><i class="fa fa-pencil"></i> Notulen</span>
                                </div>
                            </div>
                            <div ng-if="v.notulen_edit==true">
                                <summernote config="options" ng-model="v.notulen" style="border-radius: 0px;"></summernote>
                            </div>
                            <div ng-if="v.notulen_edit!=true">
                                <p ng-bind-html="v.notulen" class=""></p>
                            </div>
                            <hr>
                        </div>
                        <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('d5')"><i class="fa fa-plus"></i> Add Notulen</button>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-7">
                        <h3 class="">Tickets</h3>
                        <div class="">
                            <div class="" ng-repeat="v in h.rel_has_ticket">
                                <div class="pull-right">{{moment(v.req_date).format('DD MMM YYYY')}}</div>
                                <div class="text-bold">
                                    #{{$index+1}}. {{v.user_req_name}} : {{v.user_req}} <i class="fa fa-arrow-right"></i>
                                    {{v.user_assign==null?v.user_assign:v.user_assign_name}}
                                </div>
                                <div class="text-success p-l-20">{{v.problem}}</div>
                                <div class="label label-info pull-right">{{v.status}}</div>
                                <div class="text-muted  p-l-20">__ Ticket No. {{v.ticket}}</div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-8">
                        <h3 class="">Activities</h3>
                        <div class="">
                            <div class="" ng-repeat="v in h.rel_has_actv">
                                <div class="pull-right" ng-attr-title="Until {{moment(v.end_time).format('DD MMM YYYY HH:mm')}}">{{moment(v.start_time).format('DD MMM YYYY HH:mm')}}</div>
                                <div class="text-bold">
                                    #{{$index+1}}. {{v.username==null?v.userid:v.username}} <code>{{moment(v.end_time).diff(moment(v.start_time),'hour',true) |number:1}} Hours</code>
                                </div>
                                <div class="text-success p-l-20">{{v.activity}}</div>
                                <div class="label label-info pull-right">{{v.status}}</div>
                                <div class="text-muted  p-l-20">__ Ref#{{v.id}}, Ticket No. {{v.ticket}}</div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-9">
                        <h3 class="">Plan Achievement</h3>
                        <ul class="list-group">
                            <li class="list-group-item" ng-repeat="v in h.rel_d6" ng-hide="v.hide == 1">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="col-sm-1 p-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('d6',$index)"> <i class="fa fa-times"></i></span>
                                        <span class="badge badge-primary">{{$index+1}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 p-10">
                                        <select class="form-control input-sm no-border-text" ng-model="v.cat" style="margin: -6px">
                                            <option ng-repeat="v in [['MONTH','MONTH']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 p-5">
                                        <input type="month" ng-model="v.cat_name" ng-if="v.cat == 'MONTH'" class="form-control input-sm dash-border-text">
                                    </div>
                                    <div class="col-sm-2  p-5">
                                        <input type="text" ng-model="v.plan" class="form-control input-sm dash-border-text text-right" placeholder="Plan" awnum="default">
                                    </div>
                                    <div class="col-sm-2  p-5">
                                        <input type="text" ng-model="v.actual" class="form-control input-sm dash-border-text text-right" placeholder="Actual" awnum="default">
                                    </div>
                                    <div class="col-sm-2 p-10">
                                        <select class="form-control input-sm no-border-text" ng-model="v.uom" style="margin: -6px">
                                            <option ng-repeat="v in [['M2','M2'], ['M3','M3'], ['TON','TON'], ['IDR','IDR'], ['USD','USD'], ['JAM','JAM'], ['%','%'], ['M2/M3','M2/M3'], ['M2/MP/JAM','M2/MP/JAM'], ['M3/MP/JAM','M3/MP/JAM'], ['TON/MP/JAM','TON/MP/JAM'], ['SAT','SAT']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9  p-5">
                                        <input type="text" ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note">
                                    </div>
                                    <div class="col-sm-3 p-10 text-center">
                                        <span class="text-warning text-bold">ACV : {{ v.actual/v.plan*100 | number:0 }} %</span>
                                    </div>


                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('d6')"><i class="fa fa-plus"></i> Add Plan Achievement</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-11">
                        <div class="row">
                            <div class="col-sm-6"><h3 class="">L1 : PENENTUAN TEMA</h3></div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l1')"><i class="fa fa-line-chart"></i> Pareto</button>
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l1a')"><i class="fa fa-bar-chart"></i> Grafik SQPCH</button>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_dl1" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('dl1',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div class="col-sm-4"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="3" ng-readonly="f.template == 'QCC' && $index == 0"></textarea></div>
                                    <div class="col-sm-3"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="3"></textarea></div>
                                    <div class="col-sm-3">
                                        <select ng-model="v.category" class="form-control input-sm dash-border-text ">
                                            <option ng-repeat="v in [['SQPCHS1','SQPCH'], ['PARETO','PARETO']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                        <input type="text" ng-model="v.data_pengukuran" class="form-control input-sm dash-border-text" placeholder="Frekuensi Kejadian" awnum="default"  ng-if="v.category == 'PARETO'">
                                    </div>
                                    <div class="col-sm-1 p-t-5" >
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>

                                </div>

                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-12" ng-if="v.category == 'SQPCHS1'">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6"><h4 class="text-bold text-primary">SQPCH</h4></div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveDl1d($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl1d-{{ $index }}" class="table-responsive">
                                            <table class="table table-condensed d3m">
                                               <thead><tr><th class="text-center">ITEM</th><th class="text-center">YTD</th><th class="text-center" ng-repeat="a in range(1,12)">{{ moment(('00' + a).substr(-2) + "/01/2020").format("MMM") }}</th>
                                                </tr></thead>
                                               <tbody ng-repeat="(k1,v1) in rel_d3m[v.category]">
                                                   <tr>
                                                       <td ng-class="{'text-bold text-success': v1.reff == null}" style="white-space: nowrap;" >
                                                            <span ng-if="v1.reff !== null">--- </span>{{ v1.item }}
                                                       </td>
                                                       <td class="text-right text-bold text-primary"><span ng-if="rel_d3d1[v.id][k1]['ytd']['nilai'] !== null && v1.reff !== null">{{ rel_d3d1[v.id][k1]['ytd']['nilai'] | number }}</span></td>
                                                       <td colspan="12" ng-if="v1.reff == null">
                                                           <input type="text" ng-model="rel_d3d1[v.id][k1]['ket']" class="form-control input-sm dash-border-text" placeholder="Keterangan">
                                                       </td>
                                                       <td class="text-right" ng-repeat="a in range(1,12)" style="padding: 0px;vertical-align: middle" ng-if="v1.reff !== null">
                                                           <input type="text" ng-model="rel_d3d1[v.id][k1][a]['nilai']" class="form-control input-sm dash-border-text text-right" awnum="default" placeholder="0" ng-if="v1.fillable == 1"  ng-keyup="fCalcd3d1(v.id, k1, a)">
                                                           <span ng-if="v1.formula" class="text-right text-bold text-primary" style="padding: 0px;padding-right: 10px !important;">{{ rel_d3d1[v.id][k1][a]['nilai'] | number }}</span>
                                                       </td>
                                                    </tr>
                                               </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                            </li>
                             <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('dl1')"><i class="fa fa-plus"></i> Add L1</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-12">
                         <div class="row">
                            <div class="col-sm-8"><h3 class="">L2 : ANALISA KONDISI YANG ADA</h3></div>
                            <div class="col-sm-4 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l2')"><i class="fa fa-table"></i> Anakonda</button>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_dl2" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('dl2',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div class="col-sm-6"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="3"></textarea></div>
                                    <div class="col-sm-4"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="3"></textarea></div>

                                    <div class="col-sm-1 p-t-5" >
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>

                                </div>
                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-12">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6"><h4 class="text-bold text-primary">Analisa 4M & 1E</h4></div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveDl2d($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl2d-{{ $index }}" class="table-responsive">
                                            <table class="table table-bordered table-condensed">
                                                <thead><tr><th>Faktor</th><th>Kontrol Item</th><th>Kontrol Poin</th><th>Standard</th><th>Actual</th><th>Potensi</th></tr></thead>
                                                <tbody>
                                                    <tr ng-repeat="fact in factorl2">
                                                        <td class="text-left text-bold text-danger" width="10%">{{ fact }}</td>
                                                        <td class="text-center p-0">
                                                            <textarea class="form-control input-sm dash-border-text " rows="3" ng-model="rel_dl2d[v.id][fact]['item_control']"></textarea>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <textarea class="form-control input-sm dash-border-text " rows="3" ng-model="rel_dl2d[v.id][fact]['control_point']"></textarea>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <textarea class="form-control input-sm dash-border-text " rows="3" ng-model="rel_dl2d[v.id][fact]['standard']"></textarea>


                                                        </td>
                                                        <td class="text-center p-0">
                                                            <textarea class="form-control input-sm dash-border-text " rows="3" ng-model="rel_dl2d[v.id][fact]['actual']"></textarea>

                                                        </td>
                                                        <td class="text-center p-0">
                                                            <span ng-if="rel_dl2d[v.id][fact]['standard'] !== rel_dl2d[v.id][fact]['actual']" class="text-bold text-danger" style="font-size: 30px;">X</span>
                                                            <span ng-if="rel_dl2d[v.id][fact]['standard'] == rel_dl2d[v.id][fact]['actual']" class="text-bold text-success" style="font-size: 30px;">O</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>


                            </li>
                             <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('dl2')"><i class="fa fa-plus"></i> Add L2</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-13">
                        <div class="row">
                             <div class="col-sm-6"><h3 class="">L3 : PENETAPAN TARGET</h3></div>
                             <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l3')"><i class="fa fa-line-chart"></i> Grafik Target</button>
                            </div>
                        </div>

                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_dl3" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('dl3',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div class="col-sm-4"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="3"></textarea></div>
                                    <div class="col-sm-3"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="3"></textarea></div>
                                     <div class="col-sm-3">
                                        <select ng-model="v.category" class="form-control input-sm dash-border-text ">
                                            <option ng-repeat="v in [['PA','PLAN ACHIVEMENT'], ['SMARTPLAN','SMART PLAN']]" ng-value="v[0]">{{v[1]}}</option>
                                        </select>
                                        <input type="text" ng-model="v.data_pengukuran" class="form-control input-sm dash-border-text" placeholder="Frekuensi Kejadian" awnum="default"  ng-if="v.category == 'PARETO'">
                                    </div>

                                    <div class="col-sm-1 p-t-5" >
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>

                                </div>
                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-12" ng-if="v.category == 'PA'">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6"><h4 class="text-bold text-primary">PLAN TARGET ACHIEVEMENT</h4></div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveDl3d($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl3d-{{ $index }}"  class="table-responsive">
                                            <table class="table table-condensed">
                                               <thead>
                                                    <tr>
                                                        <th class="text-center">ITEM</th><th class="text-center" ng-repeat="a in range(1,12)">{{ moment(('00' + a).substr(-2) + "/01/2020").format("MMM") }}</th>
                                                    </tr>
                                               </thead>
                                               <tbody>
                                                    <tr ng-repeat="(k1,v1) in ['TARGET', 'PLAN', 'ACTUAL']">
                                                        <td class="text-bold text-danger">{{ v1 }}</td>
                                                        <td ng-repeat="a in range(1,12)" class="p-0">
                                                            <input type="text" class="form-control input-sm dash-border-text text-right" ng-model="rel_dl3d[v.id][v1][a]"  awnum="default">
                                                        </td>
                                                    </tr>
                                               </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="col-sm-12" ng-if="v.category == 'SMARTPLAN'">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6"><h4 class="text-bold text-primary">SMART Analyzed of PLAN</h4></div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveDl3d2($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl3d2-{{ $index }}" class="table-responsive">
                                            <table class="table table-condensed">
                                               <thead>
                                                    <tr>
                                                        <th class="text-center">ITEM</th><th>DESCRIPTION</th>
                                                    </tr>
                                               </thead>
                                               <tbody>
                                                    <tr ng-repeat="(k1,v1) in ['SPESIFIC', 'MEASURABLE', 'ACHIEVABLE', 'REALISTIC', 'TIME FRAME']">
                                                        <td class="text-bold text-danger" width="20%">{{ v1 }}</td>
                                                        <td class="p-0">
                                                            <textarea class="form-control input-sm dash-border-text" ng-model="rel_dl3d2[v.id][v1]"></textarea>
                                                        </td>
                                                    </tr>
                                               </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                            </li>
                             <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('dl3')"><i class="fa fa-plus"></i> Add L3</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-14">
                        <div class="row">
                            <div class="col-sm-6"><h3 class="">L4 : ANALISA SEBAB AKIBAT</h3></div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l4')"><i class="fa fa-table"></i> Fishbond Diagram</button>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_dl4" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('dl4',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div class="col-sm-6"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="3"></textarea></div>
                                    <div class="col-sm-4"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="3"></textarea></div>

                                    <div class="col-sm-1 p-t-5" >
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>

                                </div>
                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-12">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6"><h4 class="text-bold text-primary">FISHBOND DIAGRAM</h4></div>
                                            <div class="col-sm-6 text-right">
                                               <!-- <button type="button" class="btn btn-sm btn-inverse" ng-click="oAddFl('fl4', $index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-plus"></i> Add</button> -->
                                               <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveDl4d($index)" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl4d-{{ $index }}"  class="table-responsive">
                                            <table class="table table-condensed">
                                               <thead>
                                                    <tr>
                                                        <th class="text-center">ITEM</th><th class="text-center">MAN</th><th class="text-center">MATERIAL</th><th class="text-center">MACHINE</th><th class="text-center">METHOD</th><th class="text-center">ENVIRONMENT</th>
                                                    </tr>
                                               </thead>
                                               <tbody>
                                                    <tr ng-repeat="(k1,v1) in v.factorl4">
                                                        <td class="text-bold text-danger">{{ v1 }}</td>
                                                        <td class="p-0">
                                                            <textarea class="form-control input-sm dash-border-text" ng-model="rel_dl4d[v.id][v1]['MAN']"></textarea>
                                                        </td>
                                                        <td class="p-0">
                                                            <textarea class="form-control input-sm dash-border-text" ng-model="rel_dl4d[v.id][v1]['MATERIAL']"></textarea>
                                                        </td>
                                                        <td class="p-0">
                                                            <textarea class="form-control input-sm dash-border-text" ng-model="rel_dl4d[v.id][v1]['MACHINE']"></textarea>
                                                        </td>
                                                        <td class="p-0">
                                                            <textarea class="form-control input-sm dash-border-text" ng-model="rel_dl4d[v.id][v1]['METHOD']"></textarea>
                                                        </td>
                                                        <td class="p-0">
                                                            <textarea class="form-control input-sm dash-border-text" ng-model="rel_dl4d[v.id][v1]['ENVIRONMENT']"></textarea>
                                                        </td>
                                                    </tr>
                                               </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>


                            </li>
                             <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('dl4')"><i class="fa fa-plus"></i> Add L4</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-15">
                        <div class="row">
                            <div class="col-sm-8"><h3 class="">L5 : RENCANA PENANGGULANGAN</h3></div>
                            <div class="col-sm-4 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l5')"><i class="fa fa-table"></i> Grafik Rencana</button>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_dl5" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('dl5',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div class="col-sm-6"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="3" readonly></textarea></div>
                                    <div class="col-sm-4"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="3"></textarea></div>

                                    <div class="col-sm-1 p-t-5" >
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>

                                </div>
                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-4">
                                        <h4 class="text-bold text-primary">Dasar Pembobotan</h4>
                                        <table class="table table-bordered table-striped table-condensed">
                                            <thead><tr><th>Klasifikasi</th><th class="bg-yellow">S</th><th class="bg-red">Q</th><th class="bg-blue">P</th><th class="bg-green">C</th></tr></thead>
                                            <tbody>
                                                <tr><td class="text-bold">Sangat Baik</td><td ng-repeat="a in range(1, 4)">5</td></tr>
                                                <tr><td class="text-bold">Baik</td><td ng-repeat="a in range(1, 4)">4</td></tr>
                                                <tr><td class="text-bold">Sedang</td><td ng-repeat="a in range(1, 4)">4</td></tr>
                                                <tr><td class="text-bold">Kurang</td><td ng-repeat="a in range(1, 4)">2</td></tr>
                                                <tr><td class="text-bold">Sangat Kurang</td><td ng-repeat="a in range(1, 4)">1</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- RENCANA AKTIVITAS -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4 class="text-bold  text-primary">Rencana Aktifitas</h4>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="oAddFl('dl5d', $index)" style="margin: 5px" ng-if="f.crud == 'u' && v.id"><i class="fa fa-plus"></i> Add</button>
                                                <button type="button" class="btn btn-sm btn-warning pull-right" ng-click="fSaveDl5d($index)" style="margin: 5px" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl5d-{{ $index }}"  class="table-responsive">
                                            <table class="table table-bordered table-striped table-condensed" style="white-space: nowrap;">
                                                <thead>
                                                    <tr><th width="20px">#</th><th>RENCANA ALTERNATIF</th><th width="10%">SUMBER IDE</th><th class="bg-yellow" width="50px">S</th><th class="bg-red" width="50px">Q</th><th class="bg-blue" width="50px">P</th><th class="bg-green" width="50px">C</th><th width="50px">TTL</th><th>ANALISA</th></tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="v1 in rel_dl5d | filter:{id_dl5:v.id}:false">
                                                        <td class="p-5 text-center">{{ $index + 1 }}</td>
                                                        <td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="v1.rencana_alt"></textarea></td>
                                                        <td class="p-5">
                                                            <!-- <input type="text" class="form-control input-sm dash-border-text" ng-model="v1.sumber_ide"> -->
                                                            <i class="fa fa-user"></i>
                                                            <span ng-if="v1.sumber_ide!=null" class="pointer text-success" ng-click="oLookup('dl5_sumber_ide',v1.id)">{{v1.sumber_ide}}<br/><i class="text-success">{{v1.sumber_ide_nama}}</i></span>
                                                            <span ng-if="v1.sumber_ide==null" class="text-danger pointer"  ng-click="oLookup('dl5_sumber_ide',v1.id)">Click here</span>
                                                        </td>
                                                        <td class="p-0"><input type="text" class="form-control input-sm dash-border-text text-right" ng-model="v1.s"  awnum="default"></td>
                                                        <td class="p-0"><input type="text" class="form-control input-sm dash-border-text text-right" ng-model="v1.q"  awnum="default"></td>
                                                        <td class="p-0"><input type="text" class="form-control input-sm dash-border-text text-right" ng-model="v1.p"  awnum="default"></td>
                                                        <td class="p-0"><input type="text" class="form-control input-sm dash-border-text text-right" ng-model="v1.c"  awnum="default"></td>
                                                        <td align="right" class="text-bold text-primary p-5">{{ v1.s + v1.q + v1.p + v1.q | number }}</td>
                                                        <td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="v1.analisa"></textarea></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>

                                        <!-- ANALISA 5W & 2H -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4 class="text-bold  text-primary">Analisa 5W dan 2H</h4>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="fSaveDl5d2($index)" style="margin: 5px" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl5d2-{{ $index }}"  class="table-responsive">
                                            <table class="table table-bordered table-condensed">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center" rowspan="2" width="15%">WHAT</td><td width="25%"><i>Akar Masalah</i></td><td width="60%" class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].akar_masalah"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i>Penanggulangan</i></td><td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].penanggulangan"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center">WHY</td><td><i>Alasan Pemilihan</i></td><td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].alasan_pemilihan"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center" rowspan="5">HOW</td><td rowspan="5"><i>Aktifitas</i></td><td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].akt_1" placeholder="Aktivitas 1"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                       <td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].akt_2" placeholder="Aktivitas 2"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                       <td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].akt_3" placeholder="Aktivitas 3"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                       <td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].akt_4" placeholder="Aktivitas 4"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                       <td class="p-0"><textarea class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].akt_5" placeholder="Aktivitas 5"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center">WHERE</td><td><i>Lokasi</i></td><td class="p-0"><input type="text" class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].lokasi"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center">WHEN</td><td><i>Waktu Pelaksanaan</i></td><td class="p-0"><input type="datetime-local" class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].waktu_pelaksanaan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center">WHO</td><td><i>PIC</i></td><td class="p-0"><input type="text" class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].pic"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold text-danger text-center">HOW MUCH</td><td><i>Biaya yg dibutuhkan</i></td><td class="p-0"><input type="text" class="form-control input-sm dash-border-text" ng-model="rel_dl5d2[v.id].biaya" awnum="default"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>


                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('dl5')"><i class="fa fa-plus"></i> Add L5</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-16">
                         <div class="row">
                            <div class="col-sm-8"><h3 class="">L6 : PENANGGULANGAN</h3></div>
                            <div class="col-sm-4 text-right">
                                <button type="button" class="btn btn-sm btn-warning" ng-click="oReport('l6')"><i class="fa fa-table"></i> Tindakan Penanggulangan</button>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item p-2" ng-repeat="v in h.rel_dl6" ng-hide="v.hide ==1 " style="border-bottom-width: 5px !important;">
                                <div class="row">
                                    <div class="col-sm-1 p-t-5">
                                        <span class="pointer text-danger pull-right" ng-click="oDelrow('dl6',$index)"> <i class="fa fa-times"></i></span> <span class="badge badge-primary">{{$index+1}}</span></div>
                                    <div class="col-sm-6"><textarea ng-model="v.activity" class="form-control input-sm dash-border-text text-success" placeholder="Activity..." rows="3" readonly></textarea></div>
                                    <div class="col-sm-4"><textarea ng-model="v.note" class="form-control input-sm dash-border-text" placeholder="Note..." rows="3"></textarea></div>

                                    <div class="col-sm-1 p-t-5" >
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 0 || v.dethide == null" ng-click="v.dethide = 1" id="btn-showdet-{{$index}}"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" class="btn btn-xs btn-info" ng-if="v.dethide == 1" ng-click="v.dethide = 0"><i class="fa fa-chevron-down"></i></button>
                                    </div>

                                </div>
                                <div class="row" ng-if="v.dethide == 1">
                                    <div class="col-sm-12">
                                        <!-- TINDAKAN PENANGGULANGAN -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4 class="text-bold  text-primary">Tindakan Penanggulangan</h4>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <button type="button" class="btn btn-sm btn-warning" ng-click="oAddFl('dl6d', $index)" style="margin: 5px" ng-if="f.crud == 'u' && v.id"><i class="fa fa-plus"></i> Add</button>
                                                <button type="button" class="btn btn-sm btn-warning pull-right" ng-click="fSaveDl6d($index)" style="margin: 5px" ng-if="f.crud == 'u' && v.id"><i class="fa fa-save"></i> Save</button>
                                                <span class="label label-danger" ng-if="f.crud == 'c' || v.id == null"><i class="fa fa-exclamation-triangle"></i> Please, click Create or Update Header first..</span>
                                            </div>
                                        </div>
                                        <form action="#" id="frmDl6d-{{ $index }}"  class="table-responsive">
                                            <table class="table table-bordered table-condensed" width="100%" style="border-style: collapse;">
                                                <thead>
                                                    <tr><th rowspan="2">Step</th><th rowspan="2">Action</th><th colspan="12">Progress</th><th rowspan="2">Evidence Action</th></tr>
                                                    <tr><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>Mei</th><th>Jun</th><th>Jul</th><th>Agu</th><th>Sep</th><th>Okt</th><th>Nov</th><th>Des</th></tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="v1 in rel_dl6d | filter:{id_dl6:v.id}:false">
                                                        <td># {{ $index + 1 }}</td>
                                                        <td class="p-0">
                                                            <textarea class="input-sm form-control dash-border-text" ng-model="v1.action" style="width: 200px !important;"></textarea>
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_1" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_2" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_3" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_4" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_5" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_6" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_7" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_8" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_9" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_10" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_11" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <input type="text" class="form-control input-sm text-right dash-border-text" ng-model="v1.progress_12" awnum="default" />
                                                        </td>
                                                        <td class="p-0">
                                                            <select ng-model="v1.evidence" class="form-control input-sm">
                                                                <option ng-repeat="v in m" ng-value="v.name">{{v.name.substr(19)}}</option>
                                                            </select>
                                                            <div class="thumbnail" ng-hide="v1.evidence==null">
                                                                <img ng-src="<?php echo e(\App\Sf::fileFtpAuthUrl('')); ?>/{{v1.evidence}}" alt="Evidence Action" width="100px">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                        
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-warning">
                                <button type="button" class="btn btn-xs btn-success" ng-click="oAddrow('dl6')"><i class="fa fa-plus"></i> Add L6</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-17">
                        <h3 class="">L7 : EVALUASI / HASIL</h3>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-18">
                        <h3 class="">L8 : STANDARISASI DAN TINDAK LANJUT</h3>
                    </div>
                </div>
            </form>
        </div>
        <div ng-show="f.tab=='todo'">
            <div class="form-inline">
                Name :
                <div class="input-group">
                    <input type="text" class="form-control input-sm" ng-model="f.q_todo_user" ng-enter="oSearch()" placeholder="Userid" readonly="">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success btn-sm" ng-click="oLookup('q_todo')"><i class="fa fa-search"></i></button>
                    </div>
                    <input type="text" class="form-control input-sm" ng-model="f.q_todo_name" ng-enter="oSearch()" size="50" readonly="">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success btn-sm" ng-click="oTodaystaskdata()">Show</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="alert alert-warning" ng-if="todo.length==null|| todo.length==[]">
                Perhatian :<br>
                Tidak ada tugas untuk {{f.q_todo_name}} hari ini.
            </div>
            <ul>
                <li ng-repeat="v in todo">
                    <b>{{v.proj_name}}</b> :
                    <ul>
                        <li ng-repeat="va in v.rel_d3">
                            {{va.plan_start}} to {{va.plan_end}} : <i class="text-success">{{va.activity}}</i> {{va.note}}<b class="text-danger">{{va.progress}}%</b>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<style type="text/css">
.note-editor.note-frame,
.note-btn {
    border-radius: 0px !important;
}

.note-btn {
    padding: 2px 5px;
}

.d3m > thead > tr > th {
    background-color: wheat;
}

.label-warning {
    background-color: #f0ad4e !important;
}

</style>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?php echo e(url('trs_local_nprojh')); ?>");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        trash: 0,
        userid: "<?php echo e(Auth::user()->userid); ?>",
        username: "<?php echo e(Auth::user()->username); ?>",
        plant: "<?php echo e(Session::get('plant')); ?>",
        cat: "<?php echo e(@$request->cat); ?>",
        year: moment().format('YYYY'),
        template: '<?php echo e($template->template); ?>',
        sub_obj: ''};
    $scope.h = {};
    $scope.m = [];
    $scope.todo = [];

    $scope.arrtype = [];
    $scope.arrtype.push({id: '', label: 'ALL'});
    <?php foreach ($arrtype as $k => $v) {?>
        $scope.arrtype.push({id: '<?=$v['proj_type']?>', label:  '<?=$v['type_name']?>'});
    <?php }?>

    $scope.arrobj = [];
    $scope.arrobj.push({id: '', label: 'ALL'});
    <?php foreach ($arrobj as $k => $v) {?>
        $scope.arrobj.push({id: '<?=$v['obj']?>', label:  '<?=$v['obj_name']?>'});
    <?php }?>

    $scope.arrsub_obj = [];
    $scope.arrsub_obj.push({id: '', label: 'ALL', note: ''});
    <?php foreach ($arrsub_obj as $k => $v) {?>
        $scope.arrsub_obj.push({id: '<?=$v['obj']?>', label:  '<?=$v['obj_name']?>', note:  $scope.f.cat + '-<?=$v['note']?>'});
    <?php }?>

    $scope.arrstat = [];
    $scope.arrstat.push({id: '', label: 'ALL'});
    <?php foreach ($arrstat as $k => $v) {?>
        $scope.arrstat.push({id: '<?=$v['stat']?>', label:  '<?=$v['status_name']?>'});
    <?php }?>

    $scope.arrreq_by = [];
    $scope.arrreq_by.push({id: '', label: 'ALL', note: ''});
    <?php foreach (@$arrreq_by as $k => $v) {?>
        $scope.arrreq_by.push({id: '<?=@$v['requester']?>', label:  '<?=@$v['requester']?> - <?=@$v['rel_requester']['username']?>', note: '<?=@$v['sub_obj']?>'});
    <?php }?>

    $scope.arrreq_byall = [];
    $scope.arrreq_byall.push({id: '', label: 'ALL'});
    <?php foreach (@$arrreq_byall as $k => $v) {?>
        $scope.arrreq_byall.push({id: '<?=@$v['requester']?>', label:  '<?=@$v['requester']?> - <?=@$v['rel_requester']['username']?>'});
    <?php }?>

    $scope.rel_d3m = [];
    $scope.rel_d3d1 = [];

    if ($scope.f.template == 'AA' || $scope.f.template == 'QCC'){
        $scope.f.year = <?php echo e(date('Y')); ?>;
    }

    $scope.factorl2 = ['MAN', 'MATERIAL', 'MACHINE', 'METHOD', 'ENVIRONMENT'];

    $scope.sk8steps = [];
    $scope.sk8steps.push({skill: 'Langkah 1', target: 3});
    $scope.sk8steps.push({skill: 'Langkah 2', target: 3});
    $scope.sk8steps.push({skill: 'Langkah 3', target: 2});
    $scope.sk8steps.push({skill: 'Langkah 4', target: 2});
    $scope.sk8steps.push({skill: 'Langkah 5', target: 2});
    $scope.sk8steps.push({skill: 'Langkah 6', target: 2});
    $scope.sk8steps.push({skill: 'Langkah 7', target: 2});
    $scope.sk8steps.push({skill: 'Langkah 8', target: 2});

    $scope.sk7tools = [];
    $scope.sk7tools.push({skill: 'Grafik Bar', target: 2});
    $scope.sk7tools.push({skill: 'Grafik Line', target: 2});
    $scope.sk7tools.push({skill: 'Grafik Combination', target: 2});
    $scope.sk7tools.push({skill: 'Grafik Pie', target: 2});
    $scope.sk7tools.push({skill: 'Grafik Belt', target: 2});
    $scope.sk7tools.push({skill: 'Grafik Radar', target: 2});
    $scope.sk7tools.push({skill: 'Grafik Pareto', target: 2});

    $scope.skpresent = [];
    $scope.skpresent.push({skill: 'Making Slide in Power Point', target: 2});
    $scope.skpresent.push({skill: 'Operating of Power Point', target: 2});
    $scope.skpresent.push({skill: 'Pointer Skill', target: 2});
    $scope.skpresent.push({skill: 'Elevator Speech', target: 2});
    $scope.skpresent.push({skill: 'Audience Approach', target: 2});

    // $scope.factorl4 = ['POINT OF CAUSE', 'ROOT 1ST', 'ROOT 2ND', 'ROOT 3RD', 'ROOT 4TH', 'ROOT 5TH'];

    var uploader = $scope.uploader = new FileUploader({
        url: "<?php echo e(url('upload_file')); ?>",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        onBeforeUploadItem: function(item) {
            //s pattern : t : text, i : image,a : audio, v : video, p : application, x : all mime
            item.formData = [{ id: $scope.h.proj_no, path: 'trs_local_nprojh', s: 'x', userid: $scope.f.userid, plant: $scope.f.plant }];
        },
        onSuccessItem: function(fileItem, response, status, headers) {
            $scope.oGallery();
        }
    });

    $scope.optionsx = { height: 300 }
    $scope.options = {
        height: 300,
        focus: true,
        airMode: false,
        toolbar: [
            // ['edit', ['undo', 'redo']],
            ['headline', ['style']],
            // ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            // ['fontface', ['fontname']],
            ['textsize', ['fontsize']],
            // ['fontclr', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            // ['height', ['height']],
            ['table', ['table']],
            // ['insert', ['link','picture','video','hr']],
            // ['view', ['fullscreen', 'codeview']],
            // ['help', ['help']]
        ]
    };

    $scope.oGallery = function() {
        SfGetMediaList('trs_local_nprojh/' + $scope.h.proj_no, function(jdata) {
            $scope.m = jdata.files;
            $scope.$apply();
        });
    }

    $scope.oNew = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = { cat: $scope.f.cat, proj_date: moment().toDate(), requester: $scope.f.userid, requester_name: $scope.f.username };
        $scope.m = [];
        SfFormNew("#frm");

        if ($scope.f.template == 'AA'){
            $scope.h.proj_type = "<?=@$deftype[0]?>";
            $scope.h.proj_type_name = "<?=@$deftype[1]?>";
            $scope.h.stat = "<?=@$defstatus[0]?>";
            $scope.h.stat_name = "<?=@$defstatus[1]?>";
        }

        if ($scope.f.template == 'QCC'){
            $scope.h.rel_d3 = [];
            for (var i = 0; i < 8; i++) {
                var activity = null;
                switch (i) {
                    case 0:
                        activity = "L1 : PEMILIHAN TEMA";
                        break;
                    case 1:
                        activity = "L2 : ANALISA KONDISI YANG ADA (ANAKONDA)";
                        break;
                    case 2:
                        activity = "L3 : PENETAPAN TARGET";
                        break;
                    case 3:
                        activity = "L4 : ANALISA SEBAB AKIBAT";
                        break;
                    case 4:
                        activity = "L5 : RENCANA PENANGGULANGAN";
                        break;
                    case 5:
                        activity = "L6 : PENANGGULANGAN";
                        break;
                    case 6:
                        activity = "L7 : EVALUASI HASIL";
                        break;
                    case 7:
                        activity = "L8 : STANDARISASI DAN TINDAK LANJUT";
                        break;

                }
                $scope.h.rel_d3.push({
                    'activity': activity
                });
            }

            $scope.h.rel_dl1 = [];
            $scope.h.rel_dl1.push({
                'activity': 'SQPCH',
                'category': 'SQPCHS1',
            });

            $scope.h.rel_dl2 = [];
            $scope.h.rel_dl3 = [];
            $scope.h.rel_dl4 = [];
            $scope.h.rel_dl5 = [];
            $scope.h.rel_dl6 = [];

        }

    }

    $scope.oCopy = function() {
        $scope.f.crud = 'c';
        $scope.h.proj_no = null;
        $scope.h.requester = $scope.f.userid;
        $scope.h.requester_name = $scope.f.username;
        $scope.h.proj_date = moment().toDate();

        $.each($scope.h.rel_d1, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_d2, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_d3, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_d4, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_d5, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_d6, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_dl1, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_dl2, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_dl3, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_dl4, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_dl5, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $.each($scope.h.rel_dl6, function(index, v) {
             v.id = null;
             v.proj_no = null;
        });

        $scope.rel_d3d1  = [];
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
                        userid: $scope.f.userid,
                        cat: $scope.f.cat,
                        type: $scope.f.type,
                        obj: $scope.f.obj,
                        sub_obj: $scope.f.sub_obj,
                        request_by: $scope.f.request_by,
                        stat: $scope.f.stat,
                        year: $scope.f.year
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
        if ($scope.f.template == 'AA' && $scope.f.crud == 'u' && ($scope.h.created_by !== $scope.f.userid && $scope.h.requester !== $scope.f.userid)) {
            swal("You are not authorized to update this Document", "", "error");
            return false;
        }

        SfService.save("#frm", SfService.getUrl(), {
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            console.log(jdata);
            if ($scope.f.template == 'AA'){
                $scope.oShow(jdata.data);
            } else {
                $scope.oSearch();
            }
        });
    }

    $scope.oShow = function(id, row_d3) {
        SfService.show(SfService.getUrl("/" + encodeURI(id) + "/edit"), {}, function(jdata) {
            $scope.oNew();
            $scope.h = jdata.data.h;
            $scope.h.proj_date = jsDate($scope.h.proj_date);
            $scope.f.crud = 'u';
            
            $scope.oGallery();
            if (chatCtrl() != undefined) {
                chatCtrl().listChat();
            }

            angular.forEach($scope.h.rel_d3, function(item, i) {
                $scope.h.rel_d3[i].plan_start = jsDate(item.plan_start);
                $scope.h.rel_d3[i].plan_end = jsDate(item.plan_end);
                $scope.h.rel_d3[i].act_start = jsDate(item.act_start);
                $scope.h.rel_d3[i].act_end = jsDate(item.act_end);
            });
            angular.forEach($scope.h.rel_d5, function(item, i) {
                $scope.h.rel_d5[i].meeting_date = jsDate(item.meeting_date);
            });
            angular.forEach($scope.h.rel_d6, function(item, i) {
                if ($scope.h.rel_d6[i].cat == 'MONTH'){
                    $scope.h.rel_d6[i].cat_name = moment(item.cat_name).toDate();
                }
            });

            $scope.rel_dl2d = [];
            $scope.rel_dl3d = [];
            if ($scope.f.template  == 'AA'){ // Armand 06.02.2020
                var dt_d3d1 = jdata.data.rel_d3d1;
                $scope.dt_d3d1 = dt_d3d1;
                $.each($scope.h.rel_d3, function(a, b) {
                    if (b.detail_group && b.deleted_at == null){
                        $scope.rel_d3d1[b.id] = [];
                        var rel_d3d1 = $scope.rel_d3d1[b.id];
                        $.each($scope.rel_d3m[b.detail_group], function(index, v) {
                            rel_d3d1[index] = [];
                            for (var i = 1; i <= 12; i++) {
                                rel_d3d1[index][i] = [];
                                try{
                                    rel_d3d1[index][i]['id'] = dt_d3d1[b.id][index][i]['id'];
                                    rel_d3d1[index][i]['nilai'] = dt_d3d1[b.id][index][i]['nilai'];
                                } catch(e) {

                                }

                                rel_d3d1[index][i]['cat'] = $scope.f.cat;
                                rel_d3d1[index][i]['id_d3'] = b.id;
                                rel_d3d1[index][i]['proj_no'] = $scope.h.proj_no;
                                rel_d3d1[index][i]['grup'] = b.detail_group;
                                rel_d3d1[index][i]['item'] = v.id;
                                rel_d3d1[index][i]['item_name'] = v.item;

                                rel_d3d1[index][i]['sort_num'] = v.sort_num;
                                rel_d3d1[index][i]['formula'] = v.formula;
                                rel_d3d1[index][i]['reff'] = v.reff;
                                rel_d3d1[index][i]['periode'] = moment(('00' + i).substr(-2) + "/01/" + moment($scope.h.proj_date).format("YYYY")).format("MM/DD/YYYY");
                            }
                        });

                        $scope.fCalcd3d1YTD(b.id);

                        if (row_d3 !== undefined){
                            $scope.h.rel_d3[row_d3].dethide = 1;
                        }

                    }
                });
            } else  if ($scope.f.template  == 'QCC'){ // Armand 06.02.2020
                var dt_d3d1 = jdata.data.rel_d3d1;
                // L QCC
                $scope.rel_d1d = jdata.data.rel_d1d;
                $scope.rel_dl2d = jdata.data.rel_dl2d;
                $scope.rel_dl3d = jdata.data.rel_dl3d;
                $scope.rel_dl3d2 = jdata.data.rel_dl3d2;
                $scope.rel_dl4d = jdata.data.rel_dl4d;
                $scope.rel_dl5d = jdata.data.rel_dl5d;
                $scope.rel_dl6d = jdata.data.rel_dl6d;
                $.each($scope.rel_dl5d, function(index, v) {
                     v.sumber_ide_nama = (v.rel_sumber_ide == null ? null : v.rel_sumber_ide.username);
                });
                $scope.rel_dl5d2 = jdata.data.rel_dl5d2;
                $.each($scope.rel_dl5d2, function(index, v) {
                     v.waktu_pelaksanaan = moment(v.waktu_pelaksanaan).toDate();
                });

                $scope.dt_d3d1 = dt_d3d1;
                $.each($scope.h.rel_dl1, function(a, b) {
                    if (b.category && b.deleted_at == null){
                        $scope.rel_d3d1[b.id] = [];
                        var rel_d3d1 = $scope.rel_d3d1[b.id];
                        $.each($scope.rel_d3m[b.category], function(index, v) {
                            rel_d3d1[index] = [];
                            for (var i = 1; i <= 12; i++) {
                                rel_d3d1[index][i] = [];
                                try{
                                    rel_d3d1[index][i]['id'] = dt_d3d1[b.id][index][i]['id'];
                                    rel_d3d1[index][i]['nilai'] = dt_d3d1[b.id][index][i]['nilai'];
                                } catch(e) {

                                }

                                rel_d3d1[index][i]['cat'] = $scope.f.cat;
                                rel_d3d1[index][i]['id_d3'] = b.id;
                                rel_d3d1[index][i]['proj_no'] = $scope.h.proj_no;
                                rel_d3d1[index][i]['grup'] = b.category;
                                rel_d3d1[index][i]['item'] = v.id;
                                rel_d3d1[index][i]['item_name'] = v.item;

                                rel_d3d1[index][i]['sort_num'] = v.sort_num;
                                rel_d3d1[index][i]['formula'] = v.formula;
                                rel_d3d1[index][i]['reff'] = v.reff;
                                rel_d3d1[index][i]['periode'] = moment(('00' + i).substr(-2) + "/01/" + moment($scope.h.proj_date).format("YYYY")).format("MM/DD/YYYY");
                            }
                            rel_d3d1[index]['ket'] = dt_d3d1[b.id][index]['ket'];
                        });
                        $scope.fCalcd3d1YTD(b.id);

                        if (row_d3 !== undefined){
                            $scope.h.rel_d3[row_d3].dethide = 1;
                        }

                    }
                });



            }
            
        });
    }

    $scope.oDel = function(id, isRestore) {
        if ($scope.f.template == 'AA' && $scope.f.crud == 'u' && ($scope.h.created_by !== $scope.f.userid && $scope.h.requester !== $scope.f.userid)) {
            swal("You are not authorized to delete this Document", "", "error");
            return false;
        }

        if (id == undefined) {
            var id = $scope.h.proj_no;
        }
        SfService.delete(SfService.getUrl("/" + encodeURI(id)), { restore: isRestore }, function(jdata) {
            $scope.oSearch();
        });
    }

    $scope.oRestore = function(id) {
        $scope.oDel(id, 1);
    }

    $scope.oLookup = function(id, selector, obj) {
        $scope.initRow();
        switch (id) {
            case 'f_cat':
                SfLookup("<?php echo e(url('trs_local_nprocat_lookup')); ?>?cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.cat = id;
                    $scope.h.cat_name = name;
                    $scope.oSearch();
                    $scope.$apply();
                });
                break;
            case 'proj_source':
                SfLookup("<?php echo e(url('trs_local_nprojh_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&obj=" + ($scope.h.obj).replace(" ", "_") + "&sub_obj=" + ($scope.h.sub_obj).replace(" ", "_") + "&proj_date=" + moment($scope.h.proj_date).format("YYYY-MM-DD")  + "&reff_lookup=1", function(id, name, jsondata) {
                    $scope.h.proj_source = id;
                    $scope.$apply();
                });
                break;
            case 'proj_type':
                SfLookup("<?php echo e(url('trs_local_nprojtype_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.proj_type = id;
                    $scope.h.proj_type_name = name;
                    $scope.$apply();
                });
                break;
            case 'ticket':
                SfLookup("<?php echo e(url('trs_local_nprojtic_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.ticket = id;
                    $scope.h.ticket_name = name;
                    $scope.$apply();
                });
                break;
            case 'obj':
                SfLookup("<?php echo e(url('trs_local_nprojobj_lookup')); ?>?sub_level=0&plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.obj = id;
                    $scope.h.obj_name = name;
                    if (($scope.f.template == 'AA' || $scope.f.template == 'QCC') && $scope.h.obj){
                        $scope.h.sub_obj = '';
                        $scope.h.sub_obj_name = '';
                    }
                    $scope.$apply();
                });
                break;
            case 'sub_obj':
                var obj = "";
                if (($scope.f.template == 'AA' || $scope.f.template == 'QCC') && $scope.h.obj){
                    obj = $scope.h.obj;
                }
                SfLookup("<?php echo e(url('trs_local_nprojobj_lookup')); ?>?sub_level=1&plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&obj=" + encodeURI(obj) , function(id, name, jsondata) {
                    $scope.h.sub_obj = id;
                    $scope.h.sub_obj_name = name;
                    $scope.$apply();
                });
                break;
            case 'requester':
                SfLookup("<?php echo e(url('sys_syuser_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.requester = id;
                    $scope.h.requester_name = name;
                    $scope.$apply();
                });
                break;
            case 'stat':
                SfLookup("<?php echo e(url('trs_local_nprojstat_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.stat = id;
                    $scope.h.stat_name = name;
                    $scope.$apply();
                });
                break;
            case 'd1_userid':
                SfLookup("<?php echo e(url('sys_syuser_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.rel_d1[selector].userid = id;
                    $scope.h.rel_d1[selector].username = name;
                    $scope.$apply();
                });
                break;
            case 'd1_position':
                SfLookup("<?php echo e(url('trs_local_nprojpos_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.rel_d1[selector].position = id;
                    $scope.$apply();
                });
                break;
            case 'd2_doc_type':
                SfLookup("<?php echo e(url('trs_local_nprojdoc_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.rel_d2[selector].doc_type = id;
                    $scope.h.rel_d2[selector].doc_type_name = name;
                    $scope.$apply();
                });
                break;
            case 'd3_status':
                SfLookup("<?php echo e(url('trs_local_nprojstat_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.rel_d3[selector].status = id;
                    $scope.h.rel_d3[selector].status_name = name;
                    $scope.$apply();
                });
                break;
            case 'd3_userid':
                SfLookup("<?php echo e(url('sys_syuser_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.h.rel_d3[selector].userid = id;
                    $scope.h.rel_d3[selector].username = name;
                    $scope.$apply();
                });
                break;
            case 'q_todo':
                SfLookup("<?php echo e(url('sys_syuser_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    $scope.f.q_todo_user = id;
                    $scope.f.q_todo_name = name;
                    $scope.$apply();
                });
                break;

            case 'dl5_sumber_ide':
                SfLookup("<?php echo e(url('sys_syuser_lookup')); ?>?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, function(id, name, jsondata) {
                    console.log(selector);
                    $.each($scope.rel_dl5d, function(index, v) {
                         if (v.id == selector){
                            v.sumber_ide = id;
                            v.sumber_ide_nama = name;
                         }
                    });
                    $scope.$apply();
                });
                break;

            default:
                swal('Sorry', 'Under construction', 'error');
                break;
        }
    }

    $scope.oLog = function() {
        SfLog('trs_local_nprojh', $scope.h.proj_no);
    }

    $scope.initRow = function() {
        if ($scope.h.rel_d1 == undefined || $scope.h.rel_d1 == null) {
            $scope.h.rel_d1 = [];
        }
        if ($scope.h.rel_d2 == undefined || $scope.h.rel_d2 == null) {
            $scope.h.rel_d2 = [];
        }
        if ($scope.h.rel_d3 == undefined || $scope.h.rel_d3 == null) {
            $scope.h.rel_d3 = [];
        }
        if ($scope.h.rel_d4 == undefined || $scope.h.rel_d4 == null) {
            $scope.h.rel_d4 = [];
        }
        if ($scope.h.rel_d5 == undefined || $scope.h.rel_d5 == null) {
            $scope.h.rel_d5 = [];
        }
        if ($scope.h.rel_d6 == undefined || $scope.h.rel_d6 == null) {
            $scope.h.rel_d6 = [];
        }
        if ($scope.h.rel_d6 == undefined || $scope.h.rel_d6 == null) {
            $scope.h.rel_d6 = [];
        }
        if ($scope.h.rel_dl1 == undefined || $scope.h.rel_dl1 == null) {
            $scope.h.rel_dl1 = [];
        }

        if ($scope.h.rel_dl2 == undefined || $scope.h.rel_dl2 == null) {
            $scope.h.rel_dl2 = [];
        }

        if ($scope.h.rel_dl3 == undefined || $scope.h.rel_dl3 == null) {
            $scope.h.rel_dl3 = [];
        }

        if ($scope.h.rel_dl4 == undefined || $scope.h.rel_dl4 == null) {
            $scope.h.rel_dl4 = [];
        }

        if ($scope.h.rel_dl5 == undefined || $scope.h.rel_dl5 == null) {
            $scope.h.rel_dl5 = [];
        }

        if ($scope.h.rel_dl6 == undefined || $scope.h.rel_dl6 == null) {
            $scope.h.rel_dl6 = [];
        }

    }

    $scope.oAddrow = function(id) {
        $scope.initRow();
        switch (id) {
            case 'd1':
                $scope.h.rel_d1.push({
                    isldap: 1
                });
                break;
            case 'd2':
                $scope.h.rel_d2.push({});
                break;
            case 'd3':
                $scope.h.rel_d3.push({});
                break;
            case 'd4':
                $scope.h.rel_d4.push({});
                break;
            case 'd5':
                $scope.h.rel_d5.push({});
                break;
            case 'd6':
                $scope.h.rel_d6.push({
                    cat: 'MONTH',
                    uom: 'M2',
                });

                break;
            case 'dl1':
                $scope.h.rel_dl1.push({
                    'category': 'PARETO'
                });

                break;

            case 'dl2':
                $scope.h.rel_dl2.push({});

                break;
            case 'dl3':
                var cat = "PA";
                var act = "Plan Target Achievement";
                if ($scope.h.rel_dl3.length == 1){
                    cat = "SMARTPLAN";
                    act = "SMART Analyzed of PLAN";
                } else if ($scope.h.rel_dl3.length > 1){
                    swal("Hanya 2 Category", "", "error");
                    return false;
                }

                $scope.h.rel_dl3.push({
                    'activity': act,
                    'category': cat,
                });

                break;

             case 'dl4':
                $scope.h.rel_dl4.push({
                    'factorl4': ['POINT OF CAUSE', 'ROOT 1ST', 'ROOT 2ND', 'ROOT 3RD', 'ROOT 4TH', 'ROOT 5TH']
                });

                break;

            case 'dl5':
                $scope.h.rel_dl5.push({
                    'activity': 'ROOT CAUSE #' + ($scope.h.rel_dl5.length + 1)
                });

                break;

            case 'dl6':
                $scope.h.rel_dl6.push({
                    'activity': 'ROOT CAUSE #' + ($scope.h.rel_dl6.length + 1)
                });

                break;
        }
    }

    $scope.oAddFl = function(id, index) {
        switch (id) {
            case 'fl4':
                var l = $scope.h.rel_dl4[index].factorl4.length;
                $scope.h.rel_dl4[index].factorl4.push("ROOT " + l  + "TH");
                break;

            case 'dl5d':
                var id = $scope.h.rel_dl5[index].id;
                $scope.rel_dl5d.push({
                    'id_dl5': id
                });
                break;

             case 'dl6d':
                var id = $scope.h.rel_dl6[index].id;
                $scope.rel_dl6d.push({
                    'id_dl6': id
                });
                break;

            default:
                // statements_def
                break;
        }
    }

    $scope.oDelrow = function(id, idx) {
        switch (id) {
            case 'd1':
                $scope.h.rel_d1.splice(idx, 1);
                break;
            case 'd2':
                $scope.h.rel_d2.splice(idx, 1);
                break;
            case 'd3':
                // $scope.h.rel_d3.splice(idx, 1);
                $scope.h.rel_d3[idx].hide = 1;
                break;
            case 'd4':
                $scope.h.rel_d4.splice(idx, 1);
                break;
            case 'd5':
                $scope.h.rel_d5.splice(idx, 1);
                break;
            case 'd6':
                $scope.h.rel_d6[idx].hide = 1;
                break;
            case 'dl1':
                $scope.h.rel_dl1[idx].hide = 1;
                break;
            case 'dl2':
                $scope.h.rel_dl2[idx].hide = 1;
                break;
            case 'dl3':
                $scope.h.rel_dl3[idx].hide = 1;
                break;
            case 'dl4':
                $scope.h.rel_dl4[idx].hide = 1;
                break;

            case 'dl5':
                $scope.h.rel_dl5[idx].hide = 1;
                break;

            case 'dl6':
                $scope.h.rel_dl6[idx].hide = 1;
                break;
        }
    }

    $scope.oReport = function(id){
        switch (id) {
             case 'd1':
                window.open(SfService.getUrl('_rpt_d1_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'd6_aa':
                window.open(SfService.getUrl('_rpt_d6_aa') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat, "_blank");
                break;

            case 'prolog':
                window.open(SfService.getUrl('_rpt_prolog_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'l1':
                window.open(SfService.getUrl('_rpt_l1_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'l1a':
                window.open(SfService.getUrl('_rpt_l1a_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;
            case 'l2':
                window.open(SfService.getUrl('_rpt_l2_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'l3':
                window.open(SfService.getUrl('_rpt_l3_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'l4':
                window.open(SfService.getUrl('_rpt_l4_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'l5':
                window.open(SfService.getUrl('_rpt_l5_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

            case 'l6':
                window.open(SfService.getUrl('_rpt_l6_qcc') + "?plant=" + $scope.f.plant + "&cat=" + $scope.f.cat + "&proj_no=" + $scope.h.proj_no, "_blank");
                break;

        }
    }

    $scope.sum = function(arr, key) {
        var jml = 0;
        angular.forEach(arr, function(item, i) {
            if (item[key] != undefined && item[key] != null) {
                jml = jml + eval(item[key]);
            }
        });
        return jml;
    }

    $scope.calcProgress = function() {
        if ($scope.h.rel_d3 == undefined || $scope.h.rel_d3 == null) {
            return 0;
        }
        var ttl = $scope.sum($scope.h.rel_d3, 'progress');
        var row = $scope.h.rel_d3.length;
        return Math.round(ttl / row, 2);
    }

    $scope.moment = function(dt) {
        return moment(dt);
    }

    $scope.oTodaystaskdata = function() {
        SfService.get(SfService.getUrl('_todaystask'), { userid: $scope.f.q_todo_user, plant: $scope.f.plant, cat: $scope.f.cat }, function(jdata) {
            $scope.todo = jdata.data.data;
        });

    }

    $scope.oTodaystask = function() {
        $scope.f.tab = "todo";
        $scope.f.q_todo_user = $scope.f.userid;
        $scope.f.q_todo_name = $scope.f.username;
        $scope.oTodaystaskdata();
    }

    $scope.fCalcd3d1 = function(id_d3, row, col){
        var rel_d3d1 = $scope.rel_d3d1[id_d3];
        // console.log(rel_d3d1);
        for (var x = 1; x <= 2; x++) { // 2 Kali Looping
            for (var i = 0; i < rel_d3d1.length; i++) {
                for (var j = 0; j < rel_d3d1.length; j++) {
                    if (rel_d3d1[j][col]['formula']){
                        if (!rel_d3d1[j][col]['formula-result']){
                            rel_d3d1[j][col]['formula-result'] = rel_d3d1[j][col]['formula'];
                        }
                        if ((rel_d3d1[j][col]['formula-result']).indexOf(rel_d3d1[i][col]['item']) !== -1){
                            try {
                                if (rel_d3d1[i][col]['nilai'] == null){
                                    var nilai = 0;
                                } else {
                                    var nilai = rel_d3d1[i][col]['nilai'];
                                }
                                var form = (rel_d3d1[j][col]['formula-result']).split(" ");
                                for (var a = 0; a < form.length; a++) {
                                    if (rel_d3d1[i][col]['item'] == form[a]){
                                        form[a] = nilai;
                                    }
                                }
                                rel_d3d1[j][col]['formula-result'] = form.join(" ");
                                if (rel_d3d1[j][col]['reff'] == $scope.f.plant + "-QS1SAFETY"){
                                    // SAFETY QCC
                                   rel_d3d1[j][col]['nilai'] = null;
                                   if (rel_d3d1[j][col]['item'] == $scope.f.plant + "-QS1SACH" && rel_d3d1[j - 1][col]['nilai'] !== null && rel_d3d1[j - 2][col]['nilai'] !== null){
                                        if (rel_d3d1[j - 1][col]['nilai'] <= rel_d3d1[j - 2][col]['nilai']){
                                            rel_d3d1[j][col]['nilai'] = 100;
                                        } else {
                                             rel_d3d1[j][col]['nilai'] = (10 - (rel_d3d1[j - 1][col]['nilai'] - rel_d3d1[j - 2][col]['nilai'])) * 10;
                                        }
                                   }

                                } else if (rel_d3d1[j][col]['reff'] == $scope.f.plant + "-QS1COST"){
                                    // COST QCC
                                   rel_d3d1[j][col]['nilai'] = null;
                                   if (rel_d3d1[j][col]['item'] == $scope.f.plant + "-QS1CACH" && rel_d3d1[j - 1][col]['nilai'] !== null && rel_d3d1[j - 2][col]['nilai'] !== null){
                                        if (rel_d3d1[j - 1][col]['nilai'] <= rel_d3d1[j - 2][col]['nilai']){
                                            rel_d3d1[j][col]['nilai'] = 100;
                                        } else {
                                             rel_d3d1[j][col]['nilai'] = (10 - (rel_d3d1[j - 1][col]['nilai'] - rel_d3d1[j - 2][col]['nilai'])) * 10;
                                        }
                                   }

                                } else if (rel_d3d1[j][col]['reff'] == $scope.f.plant + "-SFSAFETY"){
                                    // SAFETY ANNUAL ACTIVITY
                                   rel_d3d1[j][col]['nilai'] = null;
                                   if (rel_d3d1[j][col]['item'] == $scope.f.plant + "-SFACH" && rel_d3d1[j - 1][col]['nilai'] !== null && rel_d3d1[j - 2][col]['nilai'] !== null){
                                        if (rel_d3d1[j - 1][col]['nilai'] <= rel_d3d1[j - 2][col]['nilai']){
                                            rel_d3d1[j][col]['nilai'] = 100;
                                        } else {
                                             rel_d3d1[j][col]['nilai'] = (10 - (rel_d3d1[j - 1][col]['nilai'] - rel_d3d1[j - 2][col]['nilai'])) * 10;
                                        }
                                   }

                                } else {
                                    rel_d3d1[j][col]['nilai'] = eval(rel_d3d1[j][col]['formula-result']);
                                    if (isNaN(rel_d3d1[j][col]['nilai']) || rel_d3d1[j][col]['nilai'] == 'Infinity'){
                                        rel_d3d1[j][col]['nilai'] = 0;
                                    } else {
                                        rel_d3d1[j][col]['nilai'] = Math.round(rel_d3d1[j][col]['nilai'] * 100) / 100;
                                    }

                                }

                                rel_d3d1[j][col]['formula-result'] = '';
                            } catch(e){

                            }

                        }

                    }

                }
            }
        }

        $scope.fCalcd3d1YTD(id_d3);


    }

    $scope.fCalcd3d1YTD = function(id_d3){
        // MENGHTIUNG YTD
        var rel_d3d1 = $scope.rel_d3d1[id_d3];
        for (var i = 0; i < rel_d3d1.length; i++) {
            rel_d3d1[i]['ytd'] = [];
            rel_d3d1[i]['ytd']['nilai'] = 0;
            rel_d3d1[i]['ytd']['formula'] = rel_d3d1[i][1]['formula'];
            rel_d3d1[i]['ytd']['item'] = rel_d3d1[i][1]['item'];

            if (rel_d3d1[i][1]['formula'] == null || rel_d3d1[i][1]['formula'] == '' || rel_d3d1[i][1]['formula'] == 'AVERAGE'){
                var divider = 0;
                for (var a = 1; a <= 12; a++) {
                    try {
                       rel_d3d1[i]['ytd']['nilai'] = rel_d3d1[i]['ytd']['nilai'] + (rel_d3d1[i][a]['nilai'] == null ? 0 : rel_d3d1[i][a]['nilai']);
                       rel_d3d1[i][1]['ytd'] = rel_d3d1[i]['ytd']['nilai'];

                       if (rel_d3d1[i][a]['nilai'] > 0){
                            divider = divider + 1;
                       }
                    } catch(e){

                    }
                }
                if (rel_d3d1[i][1]['formula'] == 'AVERAGE') {
                    rel_d3d1[i]['ytd']['nilai'] =  Math.round(rel_d3d1[i]['ytd']['nilai'] / divider * 100) / 100;
                }
            }

        }

        for (var x = 1; x <= 2; x++) { // 2 Kali Looping
            for (var i = 0; i < rel_d3d1.length; i++) {
                for (var j = 0; j < rel_d3d1.length; j++) {
                    if (rel_d3d1[j]['ytd']['formula']){
                        if (!rel_d3d1[j]['ytd']['formula-result']){
                            rel_d3d1[j]['ytd']['formula-result'] = rel_d3d1[j]['ytd']['formula'];
                        }
                        if ((rel_d3d1[j]['ytd']['formula-result']).indexOf(rel_d3d1[i]['ytd']['item']) !== -1){
                            try {
                                if (rel_d3d1[i]['ytd']['nilai'] == null){
                                    var nilai = 0;
                                } else {
                                    var nilai = rel_d3d1[i]['ytd']['nilai'];
                                 }
                                var form = (rel_d3d1[j]['ytd']['formula-result']).split(" ");
                                for (var a = 0; a < form.length; a++) {
                                    if (rel_d3d1[i]['ytd']['item'] == form[a]){
                                        form[a] = nilai;
                                    }
                                }
                                rel_d3d1[j]['ytd']['formula-result'] = form.join(" ");
                                if (rel_d3d1[j][1]['reff'] == $scope.f.plant + "-QS1SAFETY"){
                                  // SAFETY
                                   if (rel_d3d1[j]['ytd']['item'] == $scope.f.plant + "-QS1SACH"){
                                        if (rel_d3d1[j - 1]['ytd']['nilai'] <= rel_d3d1[j - 2]['ytd']['nilai']){
                                            rel_d3d1[j]['ytd']['nilai'] = 100;
                                        } else {
                                             rel_d3d1[j]['ytd']['nilai'] = (10 - (rel_d3d1[j - 1][1]['nilai'] - rel_d3d1[j - 2][1]['nilai'])) * 10;
                                        }
                                   }

                                } else if (rel_d3d1[j][1]['reff'] == $scope.f.plant + "-QS1COST"){
                                  // COST
                                   if (rel_d3d1[j]['ytd']['item'] == $scope.f.plant + "-QS1CACH"){
                                        if (rel_d3d1[j - 1]['ytd']['nilai'] <= rel_d3d1[j - 2]['ytd']['nilai']){
                                            rel_d3d1[j]['ytd']['nilai'] = 100;
                                        } else {
                                             rel_d3d1[j]['ytd']['nilai'] = (10 - (rel_d3d1[j - 1][1]['nilai'] - rel_d3d1[j - 2][1]['nilai'])) * 10;
                                        }
                                   }

                                } else if (rel_d3d1[j][1]['reff'] == $scope.f.plant + "-SFSAFETY"){
                                    // SAFETY ANNUAL ACTIVITY
                                   if (rel_d3d1[j]['ytd']['item'] == $scope.f.plant + "-SFACH" && rel_d3d1[j - 1]['ytd']['nilai'] !== null && rel_d3d1[j - 2]['ytd']['nilai'] !== null){
                                        if (rel_d3d1[j - 1]['ytd']['nilai'] <= rel_d3d1[j - 2]['ytd']['nilai']){
                                            rel_d3d1[j]['ytd']['nilai'] = 100;
                                        } else {
                                             rel_d3d1[j]['ytd']['nilai'] = (10 - (rel_d3d1[j - 1]['ytd']['nilai'] - rel_d3d1[j - 2]['ytd']['nilai'])) * 10;
                                        }
                                   }

                                } else {
                                    rel_d3d1[j]['ytd']['nilai'] = 0;
                                    rel_d3d1[j]['ytd']['nilai'] = eval(rel_d3d1[j]['ytd']['formula-result']);
                                    if (isNaN(rel_d3d1[j]['ytd']['nilai']) || rel_d3d1[j]['ytd']['nilai'] == 'Infinity'){
                                        rel_d3d1[j]['ytd']['nilai'] = 0;
                                    } else {
                                        rel_d3d1[j]['ytd']['nilai'] = Math.round(rel_d3d1[j]['ytd']['nilai'] * 100) / 100;
                                    }
                                    rel_d3d1[j][1]['ytd'] = rel_d3d1[j]['ytd']['nilai'];
                                }
                                rel_d3d1[j]['ytd']['formula-result'] = '';
                            } catch(e){

                            }

                        }

                    }

                }
            }
        }
    }

    $scope.fSaveD3d1 = function(row_d3){
        var id_d3 = $scope.h.rel_d3[row_d3].id;
        var dethide = $scope.h.rel_d3[row_d3].dethide;
        console.log(id_d3);

        var access = [$scope.h.rel_d3[row_d3].userid, $scope.h.created_by, $scope.h.requester];
        console.log(access);
        console.log(access.includes($scope.f.userid));
        if (access.includes($scope.f.userid) == false ){
            swal("You are not Owner or to be assigned to do this activity", "", "warning");
            return false;
        }

        var rel_d3d1 = {};
        for (var i = 0; i < ($scope.rel_d3d1[id_d3]).length; i++) {
            rel_d3d1[i] = Object.assign({}, $scope.rel_d3d1[id_d3][i]);

            for (var j = 1; j <= 12; j++) {
                rel_d3d1[i][j] = Object.assign({}, rel_d3d1[i][j]);
            }
             rel_d3d1[i]['ytd'] = Object.assign({}, rel_d3d1[i]['ytd']);

        }

        SfService.save("#frmD3d1-" + row_d3, SfService.getUrl('_save_det_d3d1'), {
            h: rel_d3d1,
            f: $scope.f
        }, function(jdata) {
            $scope.oShow($scope.h.proj_no, row_d3);

        });


    }

    $scope.fSaveD1d = function(row){
        var id_d1 = $scope.h.rel_d1[row].id;
        // if ($scope.h.requester !== $scope.f.userid){
        //     swal("You can not update this Detail", "", "warning");
        //     return false;

        // }

        // $.each($scope.rel_d1d[id_d1], function(i, v) {
        //      if (i == 'sk8steps'){
        //         $.each(v, function(i1, v1) {
        //              $.each($scope.sk8steps, function(a, b) {
        //                   if (i1 == b.skill){
        //                     v1.target = b.target;
        //                   }
        //              });
        //         });
        //      }

        //      if (i == 'sk7tools'){
        //         $.each(v, function(i1, v1) {
        //              $.each($scope.sk7tools, function(a, b) {
        //                   if (i1 == b.skill){
        //                     v1.target = b.target;
        //                   }
        //              });
        //         });
        //      }

        //      if (i == 'skpresent'){
        //         $.each(v, function(i1, v1) {
        //              $.each($scope.skpresent, function(a, b) {
        //                   if (i1 == b.skill){
        //                     v1.target = b.target;
        //                   }
        //              });
        //         });
        //      }
        // });


        SfService.save("#frmD1d-" + row, SfService.getUrl('_save_det_d1d'), {
            d1d: $scope.rel_d1d[id_d1],
            id_d1: id_d1,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fSaveDl1d = function(row){
        var id_d3 = $scope.h.rel_dl1[row].id;
        var dethide = $scope.h.rel_dl1[row].dethide;
        var category = $scope.h.rel_dl1[row].category;
        // if ($scope.h.requester !== $scope.f.userid){
        //     swal("You can not update this Detail", "", "warning");
        //     return false;

        // }

        var rel_d3d1 = {};
        for (var i = 0; i < ($scope.rel_d3d1[id_d3]).length; i++) {
            rel_d3d1[i] = Object.assign({}, $scope.rel_d3d1[id_d3][i]);

            for (var j = 1; j <= 12; j++) {
                rel_d3d1[i][j] = Object.assign({}, rel_d3d1[i][j]);
            }
            // if (category == 'SQPCHS1'){
            //     for (var j = 1; j <= 6; j++) {
            //         rel_d3d1[i][j] = Object.assign({}, rel_d3d1[i][j]);
            //     }
            // } else {
            //     for (var j = 7; j <= 12; j++) {
            //         rel_d3d1[i][j] = Object.assign({}, rel_d3d1[i][j]);
            //     }
            // }

             rel_d3d1[i]['ytd'] = Object.assign({}, rel_d3d1[i]['ytd']);
        }

        console.log(rel_d3d1);

        // return false;

        SfService.save("#frmD3d1-" + row, SfService.getUrl('_save_det_d3d1'), {
            h: rel_d3d1,
            f: $scope.f
        }, function(jdata) {
            $scope.oShow($scope.h.proj_no, row);

        });


    }

     $scope.fSaveDl2d = function(row){
        var id_dl2 = $scope.h.rel_dl2[row].id;
        if ($scope.h.requester !== $scope.f.userid){
            swal("You can not update this Detail", "", "warning");
            return false;

        }

        SfService.save("#frmDl2d-" + row, SfService.getUrl('_save_det_dl2d'), {
            dl2d: $scope.rel_dl2d[id_dl2],
            id_dl2: id_dl2,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fSaveDl3d = function(row){
        var id_dl3 = $scope.h.rel_dl3[row].id;
        if ($scope.h.requester !== $scope.f.userid){
            swal("You can not update this Detail", "", "warning");
            return false;

        }

        SfService.save("#frmDl3d-" + row, SfService.getUrl('_save_det_dl3d'), {
            dl3d: $scope.rel_dl3d[id_dl3],
            id_dl3: id_dl3,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fSaveDl3d2 = function(row){
        var id_dl3 = $scope.h.rel_dl3[row].id;
        if ($scope.h.requester !== $scope.f.userid){
            swal("You can not update this Detail", "", "warning");
            return false;

        }

        SfService.save("#frmDl3d2-" + row, SfService.getUrl('_save_det_dl3d2'), {
            dl3d2: $scope.rel_dl3d2[id_dl3],
            id_dl3: id_dl3,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fSaveDl4d = function(row){
        var id_dl4 = $scope.h.rel_dl4[row].id;
        if ($scope.h.requester !== $scope.f.userid){
            swal("You can not update this Detail", "", "warning");
            return false;

        }

        SfService.save("#frmDl4d-" + row, SfService.getUrl('_save_det_dl4d'), {
            dl4d: $scope.rel_dl4d[id_dl4],
            id_dl4: id_dl4,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fSaveDl5d = function(row){
        var id_dl5 = $scope.h.rel_dl5[row].id;
        if ($scope.h.requester !== $scope.f.userid){
            swal("You can not update this Detail", "", "warning");
            return false;

        }

        SfService.save("#frmDl5d-" + row, SfService.getUrl('_save_det_dl5d'), {
            dl5d: $scope.rel_dl5d,
            id_dl5: id_dl5,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fSaveDl5d2 = function(row){
        var id_dl5 = $scope.h.rel_dl5[row].id;
        if ($scope.h.requester !== $scope.f.userid){
            swal("You can not update this Detail", "", "warning");
            return false;

        }

        SfService.save("#frmDl5d2-" + row, SfService.getUrl('_save_det_dl5d2'), {
            dl5d2: $scope.rel_dl5d2,
            id_dl5: id_dl5,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });
    }

    $scope.fSaveDl6d = function(row){
        var id_dl6 = $scope.h.rel_dl6[row].id;
        // if ($scope.h.requester !== $scope.f.userid){
        //     swal("You can not update this Detail", "", "warning");
        //     return false;

        // }

        SfService.save("#frmDl6d-" + row, SfService.getUrl('_save_det_dl6d'), {
            dl6d: $scope.rel_dl6d,
            id_dl6: id_dl6,
            h: $scope.h,
            f: $scope.f
        }, function(jdata) {
            // $scope.oShow($scope.h.proj_no, row);
            swal(jdata.data, "", "info");
        });


    }

    $scope.fShowDet = function(row_d3){
         $scope.h.rel_d3[row_d3].dethide = 1;
    }

    $scope.floadTemplate = function(){
        SfService.httpGet(SfService.getUrl("_load_template_d3"), { plant: $scope.f.plant, template: $scope.f.template }, function(jdata) {
            $scope.rel_d3m = jdata.data.rel_d3m;
        });
    }

    $scope.range = function(min, max, step) {
        step = step || 1;
        var input = [];
        for (var i = min; i <= max; i += step) {
            input.push(i);
        }
        return input;
    };

    if ($scope.f.template == 'AA' || $scope.f.template == 'QCC'){
        $scope.floadTemplate();
    }

    $scope.oSearch();
}]);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsn\smart\smart_back\resources\views/trs/local/nprojh/nprojh_frm.blade.php ENDPATH**/ ?>