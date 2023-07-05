<span ng-app="sfApp" ng-controller="guideCtrl" id="guideCtrl">
    <a href="JavaScript:Void(0);" class="btn btn-sm btn-info" title="Documentation" data-toggle="modal"
        data-target="#modal_guide_more1" ng-click="modalguidelistGuide()"><i class="fa fa-question-circle-o"></i>
        {{ counter }}</a>
    <div class="modal" id="modal_guide_more1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                    <h4 class="modal-title text-navy" id="myModalLabel">Documentation </h4>
                </div>
                <div class="modal-body">
                    <div ng-repeat="v in modalguidelist">
                        <h3 class="text-primary">{{ v . subj }}</h3>
                        <div class="text-muted p-b-15">Categories : {{ v . cat }} <br>Created by
                            {{ v . created_by }} at {{ moment(v . created_at) . format('DD MMMM YYYY') }} ,
                            updated
                            {{ moment(v . updated_at) . format('DD MMMM YYYY') }}</div>
                        <p ng-bind-html="v.body"></p>
                        <hr>
                    </div>
                    <div class="alert alert-warning" ng-if="modalguidelist.length == 0">
                        <b>Information</b>
                        <p>There is not any documentation found. Maybe you haven't access to this documentation</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="pull-left text-warning">{{ getTag() }}</span>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
</span>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slimscroll').slimScroll({
            height: '250px',
            start: 'bottom'
        });
    });

    function guideCtrl() {
        return angular.element($("#guideCtrl")).scope();
    }

    app.controller('guideCtrl', ['$scope', '$http', 'SfService', function($scope, $http, SfService) {
        // SfService.setUrl("sys_sychat");

        $scope.modalguidelist = [];
        $scope.modalguide_f = {
            userid: "<?php echo e(Auth::check() ? Auth::user()->userid : ''); ?>"
        };


        $scope.getTag = function() {
            return "<?php echo e($tag); ?>";
        }

        $scope.moment = function(x) {
            return moment(x);
        }


        $scope.modalguidelistGuide = function(counter_only) {
            if ($scope.getTag() == undefined) {
                $scope.modalguidelist = [];
            } else {
                SfService.httpGet("<?php echo e(url('sys_syguide_read_bytag')); ?>", {
                    tag: $scope.getTag(),
                    counter_only: counter_only
                }, function(jdata) {
                    $scope.modalguidelist = jdata.data.data;
                    $scope.counter = jdata.data.counter;
                });
            }
        }

        $scope.modalguidelistGuide(1);
    }]);

</script>
</div>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\new\a_data\monitoring_back\backend\resources\views/layouts/common/coloradmin/guide.blade.php ENDPATH**/ ?>