

<?php $__env->startSection('title', 'Booking Konsultasi'); ?>
<?php $__env->startSection('nav-bookings', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">

    <h2>Booking Konsultasi</h2>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('member.bookings.memberStore')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group mb-2">
            <label>Layanan</label>

        </div>

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
            <input type="date"
                class="form-control"
                name="booking_date">
        </div>

        <input type="hidden" name="status" value="menunggu">

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?php echo e(route('member.bookings.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/member/bookings/create.blade.php ENDPATH**/ ?>