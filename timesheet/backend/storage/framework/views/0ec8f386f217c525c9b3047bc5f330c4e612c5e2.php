<?php if ($syparsys->parnote != ''): ?>
<div class="alert alert-info "><b>Information</b><br><?php echo e($syparsys->parnote); ?></div>
<?php endif?>
<?php if ($syparsys->input_type == 'textarea'): ?>
<textarea id="d_parvalue" class="form-control input-sm" rows="15"><?php echo e($val); ?></textarea>
<?php elseif ($syparsys->input_type == 'number'): ?>
<input type="number" id="d_parvalue" value="<?php echo e($val); ?>" class="form-control input-sm">
<?php elseif ($syparsys->input_type == 'date'): ?>
<input type="date" id="d_parvalue" value="<?php echo e($val); ?>" class="form-control input-sm">
<?php elseif ($syparsys->input_type == 'select'): ?>
<select id="d_parvalue" value="<?php echo e($val); ?>" class="form-control input-sm">
	<?php
$arr = \App\Sf::parseComboStrToArr($syparsys->option_value);
?>
	<?php foreach ($arr as $key => $v): ?>
		<option value="<?php echo e($v[0]); ?>" <?php echo e($v[0]==$val?"selected":""); ?>><?php echo e($v[1]); ?></option>
	<?php endforeach?>
</select>
<?php else: ?>
<input type="text" id="d_parvalue" value="<?php echo e($val); ?>" class="form-control input-sm">
<?php endif?>
<br>
<button class="btn btn-sm btn-success btn-block" type="button" onclick="mainCtrl().saveDash('<?php echo e($syparsys->parid); ?>');">Save</button>
<br>
<div class="text-warning text-right">Source : <?php echo e($syparsys->parid); ?></div>
<?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/syparsys/syparsys_disp.blade.php ENDPATH**/ ?>