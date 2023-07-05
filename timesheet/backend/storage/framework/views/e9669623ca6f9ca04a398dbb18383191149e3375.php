<?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
    $sf_version = '3.1.1';
    $arr = [
    [
    'subj' => 'Theme & Color',
    'desc' => 'Template skin, css packaged',
    'platform' => 'Color Admin',
    'version' => '2.0',
    ],
    [
    'subj' => 'Front End Framework',
    'desc' => 'Javascript logical programming front end',
    'platform' => 'Angular',
    'version' => '1.7',
    ],
    [
    'subj' => 'Back End Framework',
    'desc' => 'PHP logical programming back end / server side',
    'platform' => 'Laravel',
    'version' => app()::VERSION,
    ],
    [
    'subj' => 'Application Framework',
    'desc' => 'Combine many periperal in harmony',
    'platform' => 'Savetime Framework (SF)',
    'version' => $sf_version,
    ] /* [
    "subj" => "",
    "desc" => "",
    "platform" => "",
    "version" => "",
    */,
    ];
    ?>
    <!-- begin invoice -->
    <div class="invoice">
        <div class="invoice-company">
            <span class="pull-right hidden-print">
                <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-primary m-b-10"><i
                        class="fa fa-print m-r-5"></i> Print</a>
            </span>
            <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

        </div>
        <div class="invoice-content">
            <div class="table-responsive">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>TOOLS DESCRIPTION</th>
                            <th>PLATFORM</th>
                            <th>VERSION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arr as $k => $v): ?>
                        <tr>
                            <td>
                                <?php echo e($v['subj']); ?><br />
                                <small><?php echo e($v['desc']); ?></small>
                            </td>
                            <td><?php echo e($v['platform']); ?></td>
                            <td><?php echo e($v['version']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="invoice-price">
                <div class="invoice-price-left">
                    <div class="invoice-price-row">
                        <div class="sub-price">
                            <small>BACKEND</small>
                            Laravel <?php echo e(app()::VERSION); ?>

                        </div>
                        <div class="sub-price">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="sub-price">
                            <small>FRONTEND</small>
                            Angular 1.*
                        </div>
                    </div>
                </div>
                <div class="invoice-price-right" style="text-align: center;">
                    <small>MODULE</small> <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

                </div>
            </div>
        </div>
        <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
                THANK YOU
            </p>
        </div>
    </div>
    <!-- end invoice -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/admin/backend/resources/views/sys/system/sfabout.blade.php ENDPATH**/ ?>