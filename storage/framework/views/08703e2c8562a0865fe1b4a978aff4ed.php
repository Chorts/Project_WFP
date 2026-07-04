<h2>Edit Booking</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Patient</label>
    <select class="form-control" id="user_id">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($user->id); ?>" <?php echo e($data->user_id == $user->id ? 'selected' : ''); ?>>
            <?php echo e($user->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group mb-2">
    <label>Schedule</label>
    <select class="form-control" id="schedule_id">
        <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($schedule->id); ?>" data-doctor="<?php echo e($schedule->doctor->name); ?>" data-day="<?php echo e($schedule->day); ?>"
            data-time="<?php echo e($schedule->start_time); ?> - <?php echo e($schedule->end_time); ?>" <?php echo e($data->schedule_id == $schedule->id ? 'selected' : ''); ?>>
            <?php echo e($schedule->doctor->name); ?> - <?php echo e($schedule->day); ?> - <?php echo e($schedule->start_time); ?> -
            <?php echo e($schedule->end_time); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="form-group mb-2">
    <label>Status</label>
    <select class="form-control" id="status">
        <option value="Selesai" <?php echo e($data->status == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
        <option value="Dipesan" <?php echo e($data->status == 'Dipesan' ? 'selected' : ''); ?>>Dipesan</option>
        <option value="Dibatalkan" <?php echo e($data->status == 'Dibatalkan' ? 'selected' : ''); ?>>Dibatalkan</option>
    </select>
</div>
<div class="form-group mb-2">
    <label>Booking Date</label>
    <input type="date" class="form-control" id="booking_date" value="<?php echo e($data->booking_date); ?>">
</div>
<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/admin/bookings/getEditForm.blade.php ENDPATH**/ ?>