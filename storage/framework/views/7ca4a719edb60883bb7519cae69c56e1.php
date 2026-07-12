
<?php $__env->startSection('sidebar-dashboard'); ?>
active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('status')): ?>
    <div class="alert alert-warning"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <h3 class="mb-3">Dashboard Administrator</h3>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Dokter</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo e($doctorCount); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Member</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo e($memberCount); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Artikel Kesehatan</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo e($articleCount); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Booking Konsultasi</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo e($bookingCount); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Konsultasi Berlangsung</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo e($activeConsultationCount); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">Konsultasi Selesai</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo e($doneConsultationCount); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>