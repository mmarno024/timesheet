<?="<?php"?>

Route::group(['namespace' => '<?php echo e($conf['namespace']); ?>', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/<?php echo e($conf['route']); ?>', '<?php echo e($conf['tableCamel']); ?>Controller');
	Route::get('/<?php echo e($conf['route']); ?>_list', '<?php echo e($conf['tableCamel']); ?>Controller@getList');
	Route::get('/<?php echo e($conf['route']); ?>_lookup', '<?php echo e($conf['tableCamel']); ?>Controller@getLookup');
});<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/sycrud/sycrud_template_routes.blade.php ENDPATH**/ ?>