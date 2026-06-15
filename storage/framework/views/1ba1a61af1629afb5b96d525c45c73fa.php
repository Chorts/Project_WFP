
<?php $__env->startSection('sidebar-services'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Add New Service
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Add New Service</h2>

        <form method="POST" action="<?php echo e(url('/services')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group mb-2">
                <label>Service Name</label>
                <input type="text" class="form-control" name="service_name" placeholder="Enter Service Name">
            </div>
            <div class="form-group mb-2">
                <label>Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter Description">
            </div>
            <div class="form-group mb-2">
                <label>Price</label>
                <input type="number" class="form-control" name="price" placeholder="Enter Price">
            </div>
            <div class="form-group mb-2">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Tipe Service</label>
                <select class="form-control" name="tipe_service">
                    <option value="Chat">Chat</option>
                    <option value="Offline">Offline</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?php echo e(route('services.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/services/create.blade.php ENDPATH**/ ?>