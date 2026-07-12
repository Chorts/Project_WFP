<h2>Edit User</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="name" value="<?php echo e($data->name); ?>">
</div>

<div class="form-group mb-2">
    <label>Email</label>
    <input type="email" class="form-control" id="email" value="<?php echo e($data->email); ?>">
</div>

<div class="form-group mb-2">
    <label>Password</label>
    <input type="password" class="form-control" id="password" placeholder="Blank if no change">
</div>

<div class="form-group mb-2">
    <label>Role</label>
    <select class="form-control" id="role">
        <option value="admin" <?php echo e($data->role == 'admin' ? 'selected' : ''); ?>>admin</option>
        <option value="doctor" <?php echo e($data->role == 'doctor' ? 'selected' : ''); ?>>doctor</option>
        <option value="member" <?php echo e($data->role == 'member' ? 'selected' : ''); ?>>member</option>
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/admin/users/getEditForm.blade.php ENDPATH**/ ?>