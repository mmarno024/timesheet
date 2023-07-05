<button type="button" class="btn btn-sm btn-default form_uploader_more1" onclick="$('.form_uploader_more1').toggle();">
    <i class="fa fa-paperclip"></i> Attachment <i class="fa fa-chevron-down"></i>
</button>
<button type="button" class="btn btn-sm btn-default form_uploader_more1" onclick="$('.form_uploader_more1').toggle();" style="display: none;">
    <i class="fa fa-paperclip"></i> Attachment <i class="fa fa-chevron-up"></i>
</button>
<div class="form_uploader_more1" style="display: none;">
    <hr class="form_uploader_hr">
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
                            <td>{{$index+1}}</td>
                            <td>{{v.file_name}}</td>
                            <td class="text-right">{{v.size| number}} KB</td>
                            <td>
                                <a href="<?= \App\Sf::fileFtpAuthUrl() ?>/{{v.name}}" target="_blank"><i class="fa fa-eye"></i></a> |
                                <a href="<?= \App\Sf::fileFtpAuthUrl() ?>/{{v.name}}" target="_blank" download> <i class="fa fa-download"></i></a> |
                                <a href="#" ng-click="SfDelMedia(v.name,oGallery())"> <i class="fa fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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