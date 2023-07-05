<?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('title-small'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
$sf_version = "3.1.1";
$arr = [
	[
		"subj" => "Theme & Color",
		"desc" => "Template skin, css packaged",
		"platform" => "Color Admin",
		"version" => "2.0",
	], [
		"subj" => "Front End Framework",
		"desc" => "Javascript logical programming front end",
		"platform" => "Angular",
		"version" => "1.7",
	], [
		"subj" => "Back End Framework",
		"desc" => "PHP logical programming back end / server side",
		"platform" => "Laravel",
		"version" => app()::VERSION,
	], [
		"subj" => "Application Framework",
		"desc" => "Combine many periperal in harmony",
		"platform" => "Savetime Framework (SF)",
		"version" => $sf_version,
	], /* [
		"subj" => "",
		"desc" => "",
		"platform" => "",
		"version" => "",
	]*/
];
?>
<!-- begin invoice -->
<div class="invoice">
    <div class="invoice-company">
        <span class="pull-right hidden-print">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                    </span>
        <?php echo e(\App\Sf::getParsys('APP_LABEL')); ?>

    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <small>Development Team</small>
            <address class="m-t-5 m-b-5">
                <strong>Elite Development.</strong><br />
                IT DSN WP<br />
                Temanggung<br />
                Phone: (123) 456-7890<br />
                Fax: (123) 456-7890
            </address>
        </div>
        <div class="invoice-to">
            <small>Dedicated to</small>
            <address class="m-t-5 m-b-5">
                <strong>PT Dharma Satya Nusantara, Tbk</strong><br />
                Street Address<br />
                City, Zip Code<br />
                Phone: (123) 456-7890<br />
                Fax: (123) 456-7890
            </address>
        </div>
        <div class="invoice-date">
            <small>Release Date</small>
            <div class="date m-t-5">October 17,2018</div>
            <div class="invoice-detail">
                Version<br />
                v.<?php echo e($sf_version); ?>

            </div>
        </div>
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
                    <?php endforeach?>
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
    <div><hr>
        <h3>Release Note!</h3>
        <b>Version 3.1.1 (8th July 2019) </b>
        <p>
            <ul>
                <li>Upgrade laravel version from 5.6 to 5.8</li>
                <li>Add Barcode Fiture</li>
                <li>Add Email Rule</li>
                <li>Add PDF Creator (DOM)</li>
                <li>Add Autocomplete Textbox</li>
                <li>Add Awnum Input Number</li>
                <li>Add Chatting in form</li>
            </ul>
        </p>
        <b>Version 3.0.1 (2nd February 2018) </b>
        <p>
            <ul>
                <li>Form Calendar</li>
                <li>Add Fusion Chart</li>
                <li>Add File Attachment</li>
            </ul>
        </p>
        <b>Version 3.0.0 (17th December 2018) </b>
        <p>
            <ul>
                <li>Core SF Framework</li>
            </ul>
        </p>
        <b>Version 2.0.0 (10th November 2018) </b>
        <p>
            <ul>
                <li>SF Framework 2</li>
            </ul>
        </p>
        <b>Version 1.0.0 (26th November 2016) </b>
        <p>
            <ul>
                <li>SF Framework 1</li>
            </ul>
        </p>
    </div>
    <div class="invoice-note">
        * This application dedicated to PT DSN, Tbk<br />
        * Use this application follow the rule<br />
        * Always read manual book befor use, and contact administrator if any problem
    </div>
    <div class="invoice-footer text-muted">
        <p class="text-center m-b-5">
            THANK YOU FOR YOUR BUSINESS
        </p>
        <p class="text-center">
            <span class="m-r-10"><i class="fa fa-globe"></i> dharmasatyanusantara.co.id</span>
            <!-- <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span> -->
            <span class="m-r-10"><i class="fa fa-envelope"></i> it.wwk@dsngroup.co.id</span>
        </p>
    </div>
</div>
<!-- end invoice -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.coloradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tatonas\new_webmon\backend\resources\views/sys/system/sfabout.blade.php ENDPATH**/ ?>