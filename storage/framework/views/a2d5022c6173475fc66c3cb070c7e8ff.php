<h2>Edit Doctor</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="name" value="<?php echo e($data->name); ?>">
</div>
<div class="form-group mb-2">
    <label>Email</label>
    <input type="text" class="form-control" id="email" value="<?php echo e($data->email); ?>">
</div>
<div class="form-group mb-2">
    <label>Specialization</label>
    <select class="form-control" id="specialization_id">
        <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($specialization->id); ?>"
                <?php echo e($data->specialization_id == $specialization->id ? 'selected' : ''); ?>>
                <?php echo e($specialization->id); ?> - <?php echo e($specialization->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="form-group mb-2">
    <label>Users</label>
    <select class="form-control" id="user_id">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>"
                <?php echo e($data->user->id == $user->id ? 'selected' : ''); ?>>
                <?php echo e($user->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/admin/doctors/getEditForm.blade.php ENDPATH**/ ?>