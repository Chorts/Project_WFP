

<?php $__env->startSection('title', 'Booking Saya'); ?>
<?php $__env->startSection('nav-bookings', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Booking Saya</h2>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Booking Baru
        </button>
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
                <th>Tanggal Booking</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($booking->schedule->doctor->name ?? '-'); ?></td>
                <td><?php echo e($booking->booking_date); ?></td>
                <td><?php echo e($booking->status ?? 'Menunggu'); ?></td>
                <td>
                    <form action="<?php echo e(route('member.consultations.store', $booking->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Mulai Konsultasi
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>

<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('member.bookings.store')); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Booking Konsultasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="form-group mb-2">
                        <label>Jadwal</label>
                        <select class="form-control" name="schedule_id" id="selectSchedule">
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($schedule->id); ?>">
                                <?php echo e($schedule->doctor->name ?? ''); ?>

                                - <?php echo e($schedule->day); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Tanggal Booking</label>
                        <input type="date" class="form-control" name="booking_date">
                    </div>

                    <input type="hidden" name="status" value="menunggu">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\baru\Project_WFP\resources\views/member/bookings/index.blade.php ENDPATH**/ ?>