<h2>Edit Schedule</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Doctor</label>
    <select class="form-control" id="doctor_id">
        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($doctor->id); ?>" data-name="<?php echo e($doctor->name); ?>" <?php echo e($data->doctor_id == $doctor->id ? 'selected' : ''); ?>>
                <?php echo e($doctor->id); ?> - <?php echo e($doctor->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group mb-2">
    <label>Day</label>
    <select class="form-control" id="day">
        <option value="Senin" <?php echo e($data->day == 'Senin' ? 'selected' : ''); ?>>Senin</option>
        <option value="Selasa" <?php echo e($data->day == 'Selasa' ? 'selected' : ''); ?>>Selasa</option>
        <option value="Rabu" <?php echo e($data->day == 'Rabu' ? 'selected' : ''); ?>>Rabu</option>
        <option value="Kamis" <?php echo e($data->day == 'Kamis' ? 'selected' : ''); ?>>Kamis</option>
        <option value="Jumat" <?php echo e($data->day == 'Jumat' ? 'selected' : ''); ?>>Jumat</option>
        <option value="Sabtu" <?php echo e($data->day == 'Sabtu' ? 'selected' : ''); ?>>Sabtu</option>
        <option value="Minggu" <?php echo e($data->day == 'Minggu' ? 'selected' : ''); ?>>Minggu</option>
    </select>
</div>

<div class="form-group mb-2">
    <label>Start Time</label>
    <input type="time" class="form-control" id="start_time" value="<?php echo e($data->start_time); ?>">
</div>

<div class="form-group mb-2">
    <label>End Time</label>
    <input type="time" class="form-control" id="end_time" value="<?php echo e($data->end_time); ?>">
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/admin/schedules/getEditForm.blade.php ENDPATH**/ ?>