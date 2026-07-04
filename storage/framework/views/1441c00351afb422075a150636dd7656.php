

<?php $__env->startSection('title', 'Dafter Booking '); ?>
<?php $__env->startSection('nav-bookings', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Booking Konsultasi Saya</h2>

    </div>

    <?php if($bookings->isEmpty()): ?>

    <div class="alert alert-info">
        Anda belum memiliki booking konsultasi.
    </div>

    <?php else: ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Layanan</th>
                <th>Tanggal Booking</th>
                <th>Status</th>

            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($booking->schedule->doctor->name ?? '-'); ?></td>

                <td><?php echo e($booking->service->service_name ?? '-'); ?></td>

                <td>
                    <?php echo e($booking->booking_date); ?>

                </td>

                <td>
                    <?php echo e($booking->status ?? 'Menunggu'); ?>

                </td>


            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/doctor/bookings/index.blade.php ENDPATH**/ ?>