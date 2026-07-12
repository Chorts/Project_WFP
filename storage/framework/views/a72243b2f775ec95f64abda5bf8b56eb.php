<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->

<?php $__env->startSection('sidebar-doctors'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Doctors
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
            + New Doctor
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Foto</td>
                    <td style="font-weight:bold">Name</td>
                    <td style="font-weight:bold">Email</td>
                    <td style="font-weight:bold">Specialization</td>
                    <td style="font-weight:bold">Action</td>
                </tr>
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="tr_<?php echo e($doctor->id); ?>">
                        <td id="td_id_<?php echo e($doctor->id); ?>"><?php echo e($doctor->id); ?></td>
                        <td id="td_photo_<?php echo e($doctor->id); ?>">
                            <?php if($doctor->photo): ?>
                                <img src="<?php echo e(asset('storage/' . $doctor->photo)); ?>"
                                    style="width:40px;height:40px;object-fit:cover;border-radius:50%;">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td id="td_name_<?php echo e($doctor->id); ?>"><?php echo e($doctor->name); ?></td>
                        <td id="td_email_<?php echo e($doctor->id); ?>"><?php echo e($doctor->user->email ?? '-'); ?></td>
                        <td id="td_specialization_<?php echo e($doctor->id); ?>"><?php echo e($doctor->specialization_id); ?> -
                            <?php echo e($doctor->specialization->name); ?>

                        </td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm(<?php echo e($doctor->id); ?>)">Edit</a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete <?php echo e($doctor->id); ?> - <?php echo e($doctor->name); ?>?')) deleteDataRemove(<?php echo e($doctor->id); ?>)">
                                    Delete
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <!-- </body>

                </html> -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>
    
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="<?php echo e(route('admin.doctors.store')); ?>" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Doctor</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-2">
                            <label>Users</label>
                            <select class="form-control" name="user_id">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->email); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Specialization</label>
                            <select class="form-control" name="specialization_id">
                                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($specialization->id); ?>"><?php echo e($specialization->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>No. Telepon</label>
                            <input type="text" class="form-control" name="phone" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="form-group mb-2">
                            <label>Pengalaman (tahun)</label>
                            <input type="number" min="0" class="form-control" name="experience_years">
                        </div>
                        <div class="form-group mb-2">
                            <label>Bio</label>
                            <textarea class="form-control" name="bio" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
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
                    <h4 class="modal-title">Edit Article</h4>
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
                url: '<?php echo e(route("admin.doctors.getEditForm")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    $('#modalContent').html(data.msg);
                }
            });
        }

        function saveDataUpdate(id) {
            var name = $('#name').val();
            var specialization_id = $('#specialization_id').val();
            var phone = $('#phone').val();
            var experience_years = $('#experience_years').val();
            var bio = $('#bio').val();
            var photoFile = $('#photo')[0].files[0];

            var formData = new FormData();
            formData.append('_token', '<?php echo csrf_token(); ?>');
            formData.append('id', id);
            formData.append('name', name);
            formData.append('specialization_id', specialization_id);
            formData.append('phone', phone);
            formData.append('experience_years', experience_years);
            formData.append('bio', bio);
            if (photoFile) {
                formData.append('photo', photoFile);
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("admin.doctors.saveDataUpdate")); ?>',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_name_' + id).html(name);
                        $('#td_specialization_' + id).html($('#specialization_id option:selected').text());
                        if (data.photo_url) {
                            $('#td_photo_' + id).html('<img src="' + data.photo_url + '" style="width:40px;height:40px;object-fit:cover;border-radius:50%;">');
                        }
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("admin.doctors.deleteData")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#tr_' + id).remove();
                    }
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\baru\Project_WFP\resources\views/admin/doctors/index.blade.php ENDPATH**/ ?>