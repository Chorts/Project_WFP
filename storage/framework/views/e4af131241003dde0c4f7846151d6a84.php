<h2>Edit Doctor</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2 text-center">
    <?php if($data->photo): ?>
    <img id="preview_photo" src="<?php echo e(asset('storage/' . $data->photo)); ?>" alt="<?php echo e($data->name); ?>"
        class="img-thumbnail rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;">
    <?php else: ?>
    <div id="preview_photo" class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center mb-2"
        style="width:100px;height:100px;margin:0 auto;">
        <i class="bi bi-person fs-2"></i>
    </div>
    <?php endif; ?>
</div>
<div class="form-group mb-2">
    <label>Foto</label>
    <input type="file" class="form-control" id="photo" accept="image/*">
</div>
<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="name" value="<?php echo e($data->name); ?>">
</div>
<div class="form-group mb-2">
    <label>Email (dari akun user, tidak dapat diubah di sini)</label>
    <input type="text" class="form-control" value="<?php echo e($data->user->email ?? '-'); ?>" disabled>
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
    <label>No. Telepon</label>
    <input type="text" class="form-control" id="phone" value="<?php echo e($data->phone); ?>">
</div>
<div class="form-group mb-2">
    <label>Pengalaman (tahun)</label>
    <input type="number" min="0" class="form-control" id="experience_years" value="<?php echo e($data->experience_years); ?>">
</div>
<div class="form-group mb-2">
    <label>Bio</label>
    <textarea class="form-control" id="bio" rows="3"><?php echo e($data->bio); ?></textarea>
</div>
<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/admin/doctors/getEditForm.blade.php ENDPATH**/ ?>