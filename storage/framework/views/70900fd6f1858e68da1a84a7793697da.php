<?php $__env->startSection('sidebar-users'); ?>
active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('status')): ?>
    <div class="alert alert-warning"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + New User
    </button>

    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Name</td>
                <td style="font-weight:bold">Email</td>
                <td style="font-weight:bold">Role</td>
            </tr>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="tr_<?php echo e($u->id); ?>">
                <td><?php echo e($u->id); ?></td>
                <td id="td_name_<?php echo e($u->id); ?>"><?php echo e($u->name); ?></td>
                <td id="td_email_<?php echo e($u->id); ?>"><?php echo e($u->email); ?></td>
                <td id="td_role_<?php echo e($u->id); ?>"><?php echo e($u->role); ?></td>
                <td>
                    <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        onclick="getEditForm(<?php echo e($u->id); ?>)">Edit</a>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="if(confirm('Are you sure to delete <?php echo e($u->id); ?> - <?php echo e($u->name); ?>?')) deleteDataRemove(<?php echo e($u->id); ?>)">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('admin.users.store')); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group mb-2">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            <option value="admin">admin</option>
                            <option value="doctor">doctor</option>
                            <option value="member">member</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    function getEditForm(id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("admin.users.getEditForm")); ?>',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id
            },
            success: function(data) {
                $('#modalContent').html(data.msg);
            }
        });
    }

    function saveDataUpdate(id) {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var role = $('#role').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("admin.users.saveDataUpdate")); ?>',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'name': name,
                'email': email,
                'password': password,
                'role': role
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#td_name_' + id).html(name);
                    $('#td_email_' + id).html(email);
                    $('#td_role_' + id).html(role);
                    $('#modalEdit').modal('hide');
                }
            }
        });
    }

    function deleteDataRemove(id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("admin.users.deleteData")); ?>',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#tr_' + id).remove();
                }
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\baru\Project_WFP\resources\views/admin/users/index.blade.php ENDPATH**/ ?>