<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->

<?php $__env->startSection('sidebar-doctors'); ?>
active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Doctors
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('status')): ?>
    <div class="alert alert-warning"><?php echo e(session('status')); ?></div>
    <?php endif; ?>


    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Name</td>
                <td style="font-weight:bold">Email</td>
                <td style="font-weight:bold">Specialization</td>
            </tr>
            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="tr_<?php echo e($doctor->id); ?>">
                <td id="td_id_<?php echo e($doctor->id); ?>"><?php echo e($doctor->id); ?></td>
                <td id="td_name_<?php echo e($doctor->id); ?>"><?php echo e($doctor->name); ?></td>
                <td id="td_email_<?php echo e($doctor->id); ?>"><?php echo e($doctor->user->email); ?></td>
                <td id="td_specialization_<?php echo e($doctor->id); ?>"><?php echo e($doctor->specialization_id); ?> -
                    <?php echo e($doctor->specialization->name); ?>

                </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\baru\Project_WFP\resources\views/doctor/doctors/index.blade.php ENDPATH**/ ?>