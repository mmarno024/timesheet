<span ng-app="sfApp" ng-controller="chatCtrl" id="chatCtrl">
    <?php if (@$mode == 'inline'): ?>
    <div>
        <div>
            <div class="modal-title text-muted" id="myModalLabel">Comment and Chat ({{getId()}})</div>
        </div>
        <div>
            <div data-scrollbar="true" data-height="275px">
                <ul class="chats">
                    <li ng-class="{'right':v.created_by==f.userid,'left':v.created_by!=f.userid}" ng-repeat="v in list">
                        <span class="date-time">{{sayDate(v.created_at)}} ~ {{v.rel_created_by.username}} </span>
                        <a href="javascript:;" class="name">{{v.created_by}}</a>
                        <a href="javascript:;" class="image">
                            <img onerror="this.src='<?php echo e(url('coloradmin/assets/img/user-12.jpg')); ?>'" ng-src="<?php echo e(\App\Sf::fileFtpUrl('/')); ?>/{{v.rel_created_by.url_img}}" alt="Foto">
                        </a>
                        <div class="message">
                            <p ng-if="v.deleted_at==null">{{v.msg}}</p>
                            <del ng-if="v.deleted_at!=null" class="text-danger">Comment has ben deleted.</del>
                        </div>
                        <div class="date-time">Chat No. {{$index+1}}</div>
                        <div class="date-time pull-right p-r-20" ng-if="v.created_by==f.userid && v.deleted_at == null"><a href="javascript:;" class="text-danger" ng-click="delChat(v.id)">Delete</a> </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" style="display: flex;">
                <input type="text" class="form-control input-sm" placeholder="Enter your message here." ng-model="plugin_chat_msg" ng-enter="addChat(plugin_chat_msg,null)">
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-sm" type="button" ng-click="addChat(plugin_chat_msg,null)">Send</button>
                </span>
            </div>
        </div>
    <?php else: ?>
    <a href="JavaScript:Void(0);" class="btn btn-sm btn-info" title="Comment and Chat" data-toggle="modal" data-target="#modal_comment_chat_more1" ng-click="listChat()"><i class="fa fa-comments"></i> <span class="badge">{{list.length}}</span></a>
    <div class="modal" id="modal_comment_chat_more1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                    <h4 class="modal-title text-navy" id="myModalLabel">Comment and Chat ({{getId()}})</h4>
                </div>
                <div class="modal-body">
                    <div data-scrollbar="true" data-height="275px">
                        <ul class="chats">
                            <li ng-class="{'right':v.created_by==f.userid,'left':v.created_by!=f.userid}" ng-repeat="v in list">
                                <span class="date-time">{{sayDate(v.created_at)}} ~ {{v.rel_created_by.username}} </span>
                                <a href="javascript:;" class="name">{{v.created_by}}</a>
                                <a href="javascript:;" class="image">
                                    <img onerror="this.src='<?php echo e(url('coloradmin/assets/img/user-12.jpg')); ?>'" ng-src="<?php echo e(\App\Sf::fileFtpUrl('/')); ?>/{{v.rel_created_by.url_img}}" alt="Foto">
                                </a>
                                <div class="message">
                                    <p ng-if="v.deleted_at==null">{{v.msg}}</p>
                                    <del ng-if="v.deleted_at!=null" class="text-danger">Comment has ben deleted.</del>
                                </div>
                                <div class="date-time">Chat No. {{$index+1}}</div>
                                <div class="date-time pull-right p-r-20" ng-if="v.created_by==f.userid && v.deleted_at == null"><a href="javascript:;" class="text-danger" ng-click="delChat(v.id)">Delete</a> </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="input-group" style="display: flex;">
                        <input type="text" class="form-control input-sm" placeholder="Enter your message here." ng-model="plugin_chat_msg" ng-enter="addChat(plugin_chat_msg,null)">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" type="button" ng-click="addChat(plugin_chat_msg,null)">Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>
</span>
<script type="text/javascript">
$(document).ready(function() {
    $('#slimscroll').slimScroll({
        height: '250px',
        start: 'bottom'
    });
});

function chatCtrl() {
    return angular.element($("#chatCtrl")).scope();
}

app.controller('chatCtrl', ['$scope', '$http', 'SfService', function($scope, $http, SfService) {
    // SfService.setUrl("sys_sychat");

    $scope.list = [];
    $scope.f = { userid: "<?php echo e(Auth::check()?Auth::user()->userid:''); ?>" };

    $scope.getId = function() {
        return $scope.$parent.
        <?=$id?>;
    }

    $scope.getRoute = function() {
        return "<?php echo e($route); ?>";
    }
    $scope.pluginChatSend = function() {
        alert($scope.getId());
    }

    $scope.listChat = function() {
        if ($scope.getId() == undefined) {
            $scope.list = [];
        } else {
            SfService.httpGet("<?php echo e(url('sys_sychat_list_chat')); ?>", { id: $scope.getId(), route: $scope.getRoute() }, function(jdata) {
                $scope.list = jdata.data.data;
            });
        }
    }

    $scope.sayDate = function(strdate) {
        return moment(jsDate(strdate)).calendar();
    }

    $scope.addChat = function(msg, parent) {
        if (parent == undefined) {
            parent = null;
        }
        SfService.httpGet("<?php echo e(url('sys_sychat_add_chat')); ?>", { doc_no: $scope.getId(), ctg: $scope.getRoute(), parent_id: parent, msg: msg, msg_type: 's', userid: $scope.f.userid }, function(jdata) {
            $scope.plugin_chat_msg = "";
            $scope.listChat();
        });
    }

    $scope.delChat = function(id) {
        SfService.httpGet("<?php echo e(url('sys_sychat_del_chat')); ?>", { id: id }, function(jdata) {
            $scope.listChat();
        });
    }

    $scope.listChat();
}]);
</script>
</div><?php /**PATH C:\xampp\htdocs\dsn\smart\smart_back\resources\views/layouts/common/coloradmin/chat.blade.php ENDPATH**/ ?>