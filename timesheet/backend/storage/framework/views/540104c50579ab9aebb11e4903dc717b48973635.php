<!DOCTYPE html>
<html>

<head>
    <title>Data Detail Logger</title>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        @page  {
            margin: 80px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 30px;
            background: #2508a8;
            border-bottom: 2px solid #c82107;
            color: #ffffff;
            line-height: 5px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 30px;
            border-top: 1px solid #951515;
            line-height: 5px;
        }

    </style>
</head>

<body>
    <header>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" valign="top">
                    <h4 style="font-family:'Courier New', Courier, monospace">DATA DETAIL LOGGER</h4>
                </td>
            </tr>
        </table>
    </header>
    <!-- Wrap the subject matter content of your PDF inside a main tag -->
    <main style="padding:30px">
        <table cellspacing="0" cellpadding="3" style="font-family:'Courier New', Courier, monospace">
            <tr>
                <td align="left">Perangkat</td>
                <td align="center">:</td>
                <td align="left">
                    <?php echo e($data_logger->kd_hardware); ?>

                </td>
            </tr>
            <tr>
                <td align="left">Lokasi</td>
                <td align="center">:</td>
                <td align="left">
                    <?php echo e($data_logger->location); ?>

                </td>
            </tr>
            <tr>
                <td align="left">Koordinat</td>
                <td align="center">:</td>
                <td align="left">
                    <i><?php echo e($data_logger->latitude); ?>, <?php echo e($data_logger->longitude); ?></i>
                </td>
            </tr>
            <tr>
                <td align="left">Periode</td>
                <td align="center">:</td>
                <td align="left">
                    <?php echo e(date('d-m-Y', strtotime($time1))); ?> s/d <?php echo e(date('d-m-Y', strtotime($time2))); ?>

                </td>
            </tr>
        </table>

        <p style="page-break-after: never;">
        <table border="1" cellspacing="0" cellpadding="3" style="font-family:'Courier New', Courier, monospace">
            <tr>
                <th>No</th>
                <th>Waktu Aktual</th>
                <?php $__currentLoopData = $data_table[0]['sensor']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($v['properties']->nm_sensor); ?> <i>(<?php echo e($v['properties']->satuan); ?>)</i></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <?php $i=1 ?>
            <?php $__currentLoopData = $data_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($v['date_act']); ?></td>
                    <?php $__currentLoopData = $v['sensor']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td align="right"><?php echo e($v1['value']); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        </p>
        <!-- <p style="page-break-after: always;">
            subject matter data Page 2
        </p> -->
    </main>
    <footer>
        <table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <td align="right" width="100%">
                    <h5 style="font-family:'Courier New', Courier, monospace"><?php echo e($data_logger->plantname); ?> © <?php echo date('Y-m-d H:i:s'); ?></h5>
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
<?php /**PATH C:\laragon\www\wmon_fix\admin\backend\resources\views/trs/local/trs_raw/trs_raw_frm_detail_pdf.blade.php ENDPATH**/ ?>