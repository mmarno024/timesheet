<a href="#" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_uploader_more1" ng-hide="f.crud=='c'" title="Attachment">
    <i class="fa fa-paperclip"></i> <span class="badge">{{m.length}}</span>
</a>
<div class="modal" id="modal_uploader_more1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h4 class="modal-title text-navy" id="myModalLabel">Attachment
                    <small class=" subtitle">
                    </small>
                </h4>
            </div>
            <div class="modal-body">
                <div class="form_uploader_more1">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="ui_tabs_accordions.html#default-tab-1" data-toggle="tab" aria-expanded="true">Attachment List</a></li>
                        <li class=""><a href="ui_tabs_accordions.html#default-tab-2" data-toggle="tab" aria-expanded="false">Upload New File</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in form-inline" id="default-tab-1">
                            <div class="pull-right">
                                <input type="text" class="form-control input-sm" placeholder="Search Attachment" ng-model="f.m_filter">
                                <button type="button" class="btn btn-sm btn-default" ng-click="oGallery()">Refresh</button>
                            </div>
                            <h3 class="m-t-10"><i class="fa fa-paperclip"></i> Attachment List</h3>
                            <div class="row">
                                <div class="col-md-4" ng-repeat="v in m | filter: f.m_filter">
                                    <div class="thumbnail">
                                        <img ng-if="(['png','jpg']).includes(v.name.split('.').pop())" src="<?= \App\Sf::fileFtpAuthUrl() ?>/{{v.name}}?w=100&h=100" alt="{{v.name}}">
                                        <img ng-if="!(['png','jpg']).includes(v.name.split('.').pop())" src="<?= url('coloradmin/assets/img/icon-doc.png') ?>">
                                        <div><a href="<?= \App\Sf::fileFtpAuthUrl() ?>/{{v.name}}" target="_blank">{{v.file_name}} ({{v.size| number}} KB)</a></div>
                                        <div class="text-right"><a href="javascript:void(0)" onclick="hapusFile(this)" data-v="{{v.name}}" class="text-danger"> Delete?</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="default-tab-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <h3>Select files</h3>
                                    <div ng-show="uploader.isHTML5">
                                        <div nv-file-drop="" uploader="uploader" options="{ url: '/foo' }">
                                            <div nv-file-over="" uploader="uploader" over-class="another-file-over-class" class="well my-drop-zone">
                                                Drop Your file here!
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" nv-file-select="" uploader="uploader" multiple />
                                </div>
                                <div class="col-md-9" style="margin-bottom: 40px">
                                    <h3>Upload queue</h3>
                                    <p>Queue length: {{ uploader.queue.length }}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th width="50%">Name</th>
                                                    <th ng-show="uploader.isHTML5">Size</th>
                                                    <th ng-show="uploader.isHTML5">Progress</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in uploader.queue">
                                                    <td class="text-right">{{$index+1}}</td>
                                                    <td><strong>{{ item.file.name }}</strong>
                                                        <div class="thumbnail" ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
                                                    </td>
                                                    <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>
                                                    <td ng-show="uploader.isHTML5">
                                                        <div class="progress" style="margin-bottom: 0;">
                                                            <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="text-center">
                                                            <span ng-show="item.isSuccess" class="text-primary"><i class="glyphicon glyphicon-ok "></i> Success</span>
                                                            <span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i> Canceled</span>
                                                            <span ng-show="item.isError" class="text-danger"><i class="glyphicon glyphicon-remove "></i>Removed</span>
                                                        </div>
                                                        <br>
                                                        <div style="white-space: nowrap;">
                                                            <button type="button" class="btn btn-primary btn-xs" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                                                <span class="glyphicon glyphicon-upload"></span> Upload
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-xs" ng-click="item.cancel()" ng-disabled="!item.isUploading">
                                                                <span class="glyphicon glyphicon-ban-circle"></span> Cancel
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
                                                                <span class="glyphicon glyphicon-trash"></span> Remove
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <div>
                                            Queue progress:
                                            <div class="progress" style="">
                                                <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">
                                            <span class="glyphicon glyphicon-upload"></span> Upload all
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading">
                                            <span class="glyphicon glyphicon-ban-circle"></span> Cancel all
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length">
                                            <span class="glyphicon glyphicon-trash"></span> Remove all
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            function oAttachment() {
                $("#modal_uploader_more1").modal('show');
            }

        });

        function hapusFile(v) {
            var file_name = $(v).attr('data-v');

            swal({
                title: 'Are you sure?',
                text: "Delete file " + file_name,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.value) {
                    var $btn = $('button').button('loading');
                    $.get("<?= url('delete_file') ?>?file_name=" + file_name, function() {
                            console.log('Success');
                        })
                        .done(function() {
                            $btn.button('reset');
                            mainCtrl().oGallery();
                        })
                        .fail(function() {
                            swal('', 'Failure', 'error');
                        })
                        .always(function() {});
                }
            });


        }
    </script>
</div>