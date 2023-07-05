<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title'); ?>Plant Selection <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('breadcrumb'); ?>
<span>Select</span> <?php $__env->stopSection(); ?>
<!-- ------------------------------------------------------------------------------- -->
<?php $__env->startSection('content'); ?>
<div class="panel">
	<div class="panel-body">
        <?php if ($syplant->count() == 0): ?>
            <div class="alert alert-warning">
                <i class="fa fa-warning fa-3x pull-left"></i>
                <b>Sorry!</b>
                <p>You haven't any plant allowed. Contact your administrator.</p>
            </div>
        <?php endif?>
		<?php foreach ($syplant as $k => $v): ?>
        <a href="javascript:;" onclick="SfSelectPlant('<?php echo e($v->plant); ?>')">
        	<span class="fa fa-5x pull-left">0<?php echo e($k+1); ?></span>
            <?php if (Session::get('plant') == $v->plant): ?>
            <i class="fa fa-5x fa-check pull-right"></i>
            <?php endif?>
            <h4 class="text-success"><?php echo e($v->plant); ?>. <?php echo e($v->plantname); ?>, <?php echo e($v->provice); ?>, <?php echo e($v->state); ?></h4>
            <p class="desc">
                Address : <?php echo e($v->addr); ?>, <?php echo e($v->city); ?>, <?php echo e($v->provice); ?>, <?php echo e($v->state); ?>  <?php echo e($v->postcode); ?><br>
                Company : <?php echo e(@$v->rel_com_code->com_name); ?>

            </p>
        </a>
        <hr>
	<?php endforeach?>
	</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\palu\palu1\backend\resources\views/sys/system/utility/select_plant.blade.php ENDPATH**/ ?>