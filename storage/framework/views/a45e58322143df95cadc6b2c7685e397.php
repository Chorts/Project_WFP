<h2>Edit Article</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Title</label>
    <input type="text" class="form-control" id="title" value="<?php echo e($data->title); ?>">
</div>
<div class="form-group mb-2">
    <label>Article</label>
    <input type="text" class="form-control" id="article" value="<?php echo e($data->article); ?>">
</div>
<div class="form-group mb-2">
    <label>Date Published</label>
    <input type="date" class="form-control" id="date" value="<?php echo e($data->date_published); ?>">
</div>
<div class="form-group mb-2">
    <label>Doctors</label>
    <select class="form-control" id="doctor_id">
        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($doctor->id); ?>"
                <?php echo e($data->doctor->id == $doctor->id ? 'selected' : ''); ?>>
                <?php echo e($doctor->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/articles/getEditForm.blade.php ENDPATH**/ ?>