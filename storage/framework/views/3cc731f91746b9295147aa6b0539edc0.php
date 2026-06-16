<h2>Edit Category</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Category Name</label>
    <input type="text" class="form-control" id="category_name" value="<?php echo e($data->category_name); ?>">
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/categories/getEditForm.blade.php ENDPATH**/ ?>