<!DOCTYPE html>
<html>

<head>
    <title>Detail data perjam</title>
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
            height: 50px;
            background: #157f95;
            border-bottom: 5px solid #24b5d2;
            color: #ffffff;
            line-height: 20px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            border-top: 1px solid #157f95;
            line-height: 20px;
        }

    </style>
</head>

<body>
    <header>
        <table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <td width="25%" valign="top">
                    <h3 style="color: #fef200;font-weight: bold;font-family: sans-serif;margin-left: 10px;">PSDA DKI
                        JAKARTA
                    </h3>
                </td>
                <td align="center" width="50%" valign="top">
                    <h3 style="font-family:'Courier New', Courier, monospace">DATA PERJAM (
                        <?php echo e($arr_raw['nm_logger']); ?> - <?php echo e($arr_raw['kd_hardware']); ?> - <?php echo e($arr_raw['nm_sensor']); ?>

                        )</h3>
                </td>
                <td width="25%">&nbsp;</td>
            </tr>
        </table>
    </header>
    <footer>
        <table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <td align="right" width="100%">
                    <h5 style="font-family:'Courier New', Courier, monospace">PSDA - DKI Jakarta © <?php
                        echo date('Y-m-d H:i:s'); ?></h5>
                </td>
            </tr>
        </table>
    </footer>
    <!-- Wrap the subject matter content of your PDF inside a main tag -->
    <main>

        <p style="page-break-after: never;">
        <table border="1" cellspacing="0" cellpadding="3" align="center"
            style="font-family:'Courier New', Courier, monospace">
            <tr>
                <th>No</th>
                <th>Time (Hour)</th>
                <th>Value (Avg)</th>
            </tr>
            <?php $i=1 ?>
            <?php $__currentLoopData = $arr_raw['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($v->jam); ?></td>
                    <td><?php echo e($v->value); ?> <?php echo e($v->satuan); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        </p>
    </main>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\tatonas\psda\psda\backend\resources\views/trs/local/trs_raw/trs_raw_frm_detail_pdf.blade.php ENDPATH**/ ?>