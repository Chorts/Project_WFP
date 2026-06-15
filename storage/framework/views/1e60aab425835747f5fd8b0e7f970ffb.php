
<?php $__env->startSection('sidebar-services'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Edit Service
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Edit Service</h2>

        <form method="POST" action="<?php echo e(route('services.update', $service->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group mb-2">
                <label>Service Name</label>
                <input type="text" class="form-control" name="service_name" value="<?php echo e($service->service_name); ?>">
            </div>
            <div class="form-group mb-2">
                <label>Description</label>
                <input type="text" class="form-control" name="description" value="<?php echo e($service->description); ?>">
            </div>
            <div class="form-group mb-2">
                <label>Price</label>
                <input type="number" class="form-control" name="price" value="<?php echo e($service->price); ?>">
            </div>
            <div class="form-group mb-2">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php echo e($service->category_id == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->category_name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Tipe Service</label>
                <select class="form-control" name="tipe_service">
                    <option value="Chat" <?php echo e($service->tipe_service == 'Chat' ? 'selected' : ''); ?>>Chat</option>
                    <option value="Offline" <?php echo e($service->tipe_service == 'Offline' ? 'selected' : ''); ?>>Offline</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo e(route('services.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/services/edit.blade.php ENDPATH**/ ?>