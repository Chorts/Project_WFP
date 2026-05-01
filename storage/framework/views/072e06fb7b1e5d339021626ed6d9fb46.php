<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedules Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->

<?php $__env->startSection('sidebar-schedules'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Schedules
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Day</td>
                    <td style="font-weight:bold">Start Time</td>
                    <td style="font-weight:bold">End Time</td>
                </tr>
                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($schedule->id); ?></td>
                        <td><?php echo e($schedule->doctor_id); ?></td>
                        <td><?php echo e($schedule->doctor->name); ?></td>
                        <td><?php echo e($schedule->day); ?></td>
                        <td><?php echo e($schedule->start_time); ?></td>
                        <td><?php echo e($schedule->end_time); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <!-- </body>

    </html> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/schedules/index.blade.php ENDPATH**/ ?>