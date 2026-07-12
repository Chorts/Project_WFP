
<?php $__env->startSection('sidebar-schedules'); ?>
active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Schedules
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
        + New Schedule
    </button>

    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Doctor ID</td>
                <td style="font-weight:bold">Doctor Name</td>
                <td style="font-weight:bold">Day</td>
                <td style="font-weight:bold">Start Time</td>
                <td style="font-weight:bold">End Time</td>
            </tr>
            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="tr_<?php echo e($schedule->id); ?>">
                <td><?php echo e($schedule->id); ?></td>
                <td id="td_doctor_id_<?php echo e($schedule->id); ?>"><?php echo e($schedule->doctor_id); ?></td>
                <td id="td_doctor_name_<?php echo e($schedule->id); ?>"><?php echo e($schedule->doctor->name); ?></td>
                <td id="td_day_<?php echo e($schedule->id); ?>"><?php echo e($schedule->day); ?></td>
                <td id="td_start_time_<?php echo e($schedule->id); ?>"><?php echo e($schedule->start_time); ?></td>
                <td id="td_end_time_<?php echo e($schedule->id); ?>"><?php echo e($schedule->end_time); ?></td>
                <td>
                    <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        onclick="getEditForm(<?php echo e($schedule->id); ?>)">Edit</a>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="if(confirm('Are you sure to delete <?php echo e($schedule->id); ?>?')) deleteDataRemove(<?php echo e($schedule->id); ?>)">Delete</a>
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
        <form method="POST" action="<?php echo e(route('admin.schedules.store')); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Schedule</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-2">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor_id">
                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->id); ?> - <?php echo e($doctor->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Day</label>
                        <select class="form-control" name="day">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Start Time</label>
                        <input type="time" class="form-control" name="start_time">
                    </div>
                    <div class="form-group mb-2">
                        <label>End Time</label>
                        <input type="time" class="form-control" name="end_time">
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
                <h4 class="modal-title">Edit Schedule</h4>
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
            url: '<?php echo e(route("admin.schedules.getEditForm")); ?>',
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
        var doctor_id = $('#doctor_id').val();
        var day = $('#day').val();
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("admin.schedules.saveDataUpdate")); ?>',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'doctor_id': doctor_id,
                'day': day,
                'start_time': start_time,
                'end_time': end_time,
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#td_doctor_id_' + id).html(doctor_id);
                    $('#td_doctor_name_' + id).html($('#doctor_id option:selected').data('name'));
                    $('#td_day_' + id).html(day);
                    $('#td_start_time_' + id).html(start_time);
                    $('#td_end_time_' + id).html(end_time);
                    $('#modalEdit').modal('hide');
                }
            }
        });
    }

    function deleteDataRemove(id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("admin.schedules.deleteData")); ?>',
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
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/admin/schedules/index.blade.php ENDPATH**/ ?>