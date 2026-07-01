<h2>Edit Service</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Service Name</label>
    <input type="text" class="form-control" id="s_service_name" value="<?php echo e($data->service_name); ?>">
</div>
<div class="form-group mb-2">
    <label>Description</label>
    <input type="text" class="form-control" id="s_description" value="<?php echo e($data->description); ?>">
</div>
<div class="form-group mb-2">
    <label>Price</label>
    <input type="number" class="form-control" id="s_price" value="<?php echo e($data->price); ?>">
</div>
<div class="form-group mb-2">
    <label>Category</label>
    <select class="form-control" id="s_category_id">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>"
            <?php echo e($data->category_id == $category->id ? 'selected' : ''); ?>>
            <?php echo e($category->category_name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="form-group mb-2">
    <label>Tipe Service</label>
    <select class="form-control" id="s_tipe_service">
        <option value="Chat" <?php echo e($data->tipe_service == 'Chat' ? 'selected' : ''); ?>>Chat</option>
        <option value="Offline" <?php echo e($data->tipe_service == 'Offline' ? 'selected' : ''); ?>>Offline</option>
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\xampp\htdocs\wfp\PROJECT\Project_WFP-main\resources\views/admin/services/getEditFormB.blade.php ENDPATH**/ ?>