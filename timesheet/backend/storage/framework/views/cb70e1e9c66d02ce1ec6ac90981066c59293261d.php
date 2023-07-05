<?php
$arr = $data->toArray();
?>
    <div class="input-group">
        <input type="text" class="form-control input-sm clear q-search" placeholder="Search" value="<?php echo e($request->q); ?>">
        <span class="input-group-btn"><button type="button" class="btn btn-sm btn-default btn-search" ><i class="fa fa-search"></i></button></span>
    </div>
    <br>
    <div class="table-responsive">
        <?php if($arr==[] || $arr['total']==0): ?>
        <div class="alert alert-warning">Data tidak ada</div>
        <?php else: ?>
        <table class="table table-striped table-bordered table-hover table-condensed" style="white-space: nowrap;">
            <thead>
                <tr>
                    <?php $__currentLoopData = $arr['data'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e(ucwords(str_replace('_',' ',$k))); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
            <tbody class="<?php echo e((isset($request->isactive) && $request->isactive==0)?'text-danger':''); ?>">
                <?php $__currentLoopData = $arr['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="pointer onclicktrlookup" data-id="<?php echo e(reset($value)); ?>" data-name="<?php echo e(next($value)); ?>" data-json='<?php echo e(json_encode($value)); ?>'>
                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td><?php echo e($v); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php echo $data->appends($request->all())->render(); ?>

    <?php endif; ?>
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\monitoring\webadm\backend\resources\views/sys/system/dialog/sflookup.blade.php ENDPATH**/ ?>