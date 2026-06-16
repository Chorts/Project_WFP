
<?php $__env->startSection('sidebar-bookings'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Bookings
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
            + New Booking
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Patient Name</td>
                    <td style="font-weight:bold">Service Name</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Day</td>
                    <td style="font-weight:bold">Time</td>
                    <td style="font-weight:bold">Status</td>
                    <td style="font-weight:bold">Booking Date</td>
                </tr>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="tr_<?php echo e($booking->id); ?>">
                        <td><?php echo e($booking->id); ?></td>
                        <td id="td_user_<?php echo e($booking->id); ?>"><?php echo e($booking->user->name); ?></td>
                        <td id="td_service_<?php echo e($booking->id); ?>"><?php echo e($booking->service->service_name); ?></td>
                        <td id="td_doctor_<?php echo e($booking->id); ?>"><?php echo e($booking->schedule->doctor->name); ?></td>
                        <td id="td_day_<?php echo e($booking->id); ?>"><?php echo e($booking->schedule->day); ?></td>
                        <td id="td_time_<?php echo e($booking->id); ?>"><?php echo e($booking->schedule->start_time); ?> -
                            <?php echo e($booking->schedule->end_time); ?>

                        </td>
                        <td id="td_status_<?php echo e($booking->id); ?>"><?php echo e($booking->status); ?></td>
                        <td id="td_booking_date_<?php echo e($booking->id); ?>"><?php echo e($booking->booking_date); ?></td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm(<?php echo e($booking->id); ?>)">Edit</a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete Booking <?php echo e($booking->id); ?>?')) deleteDataRemove(<?php echo e($booking->id); ?>)">
                                    Delete
                                </a>
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
            <form method="POST" action="<?php echo e(url('/bookings')); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Booking</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-2">
                            <label>Patient</label>
                            <select class="form-control" name="user_id">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Service</label>
                            <select class="form-control" name="service_id">
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($service->id); ?>"><?php echo e($service->service_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Schedule</label>
                            <select class="form-control" name="schedule_id">
                                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($schedule->id); ?>"><?php echo e($schedule->doctor->name); ?> - <?php echo e($schedule->day); ?> -
                                        <?php echo e($schedule->start_time); ?> - <?php echo e($schedule->end_time); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Selesai">Selesai</option>
                                <option value="Dipesan">Dipesan</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Booking Date</label>
                            <input type="date" class="form-control" name="booking_date">
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
                    <h4 class="modal-title">Edit Booking</h4>
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
                url: '<?php echo e(route("bookings.getEditForm")); ?>',
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
            var user_id = $('#user_id').val();
            var service_id = $('#service_id').val();
            var schedule_id = $('#schedule_id').val();
            var status = $('#status').val();
            var booking_date = $('#booking_date').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("bookings.saveDataUpdate")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'user_id': user_id,
                    'service_id': service_id,
                    'schedule_id': schedule_id,
                    'status': status,
                    'booking_date': booking_date,
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_user_' + id).html($('#user_id option:selected').text());
                        $('#td_doctor_' + id).html($('#schedule_id option:selected').data('doctor'));
                        $('#td_day_' + id).html($('#schedule_id option:selected').data('day'));
                        $('#td_time_' + id).html($('#schedule_id option:selected').data('time'));
                        $('#td_status_' + id).html(status);
                        $('#td_booking_date_' + id).html(booking_date);
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("bookings.deleteData")); ?>',
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
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/bookings/index.blade.php ENDPATH**/ ?>