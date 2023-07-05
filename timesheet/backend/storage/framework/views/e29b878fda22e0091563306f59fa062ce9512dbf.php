<div class="row">
    <div class="col-sm-6">
        <div class="input-group">
            <input type="text" id="sflookup-search-key" class="form-control input-sm" ng-enter="oSearchLookup()" placeholder="Search" value="<?php echo e($request->q); ?>">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default btn-sm" onclick="oSearchLookup()"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
    	<select class="form-control input-sm" id="sflookup-limit" onchange="oSearchLookup()">
    		<option value="10">10</option>
    		<option value="25">25</option>
    		<option value="50">50</option>
    		<option value="100">100</option>
    	</select>
    </div>
    <div class="col-sm-3">
        <button type="button" class="btn btn-default btn-sm btn-block" onclick="SfExportExcel('sflookup-result-div1')"><i class="fa fa fa-file-excel-o"></i> Excel</button>
    </div>
</div>
<hr>
<div id="sflookup-result-div1" class="table-responsive">
    <table class="table table-condensed" style="white-space: nowrap;">
        <thead>
            <tr>
                <th>#</th>
                <th>Time</th>
                <th>Username</th>
                <th>Activity</th>
                <th>Tag</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $k => $v): ?>
            <tr>
                <td class="text-right"><?php echo e($v->id); ?></td>
                <td><?php echo e($v->created_at); ?></td>
                <td><?php echo e(@$v->rel_created_by->username); ?></td>
                <td><?php echo e($v->activity); ?></td>
                <td><?php echo e($v->tag); ?></td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>
<?php echo $data->appends(['q' => @$request->q,'limit'=>@$request->limit,'orderby'=>isset($request->orderby)?$request->orderby:'id','isactive'=>@$request->isactive,'plant'=>@$request->plant,'trs'=>@$request->trs,'doc_no'=>@$request->doc_no])->render(); ?>

<script type="text/javascript">
$("#sfdialog-seelog_ #sflookup-limit").val("<?php echo e($request->limit); ?>");
$("#sfdialog-seelog_ #sflookup-search-key").focus();
$("#sfdialog-seelog_ #sflookup-search-key").on('keypress', function(e) {
    if (e.which == 13) {
        oSearchLookup();
    }
});

function oSearchLookup(){
	SfSeeLog(SfBaseUrl + '/sys_sylog_seelog/<?php echo e($request->trs); ?>/<?php echo e($request->doc_no); ?>?q=' + $('#sfdialog-seelog_ #sflookup-search-key').val()+'&limit=' + $('#sfdialog-seelog_ #sflookup-limit').val());
}
</script><?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/sylog/sylog_mylog.blade.php ENDPATH**/ ?>