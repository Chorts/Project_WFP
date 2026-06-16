
<?php $__env->startSection('sidebar-chats'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Chats
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
            + New Chat
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Sender</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Sender Type</td>
                    <td style="font-weight:bold">Chat</td>
                    <td style="font-weight:bold">Time</td>
                </tr>
                <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="tr_<?php echo e($c->id); ?>">
                        <td><?php echo e($c->id); ?></td>
                        <td id="td_sender_<?php echo e($c->id); ?>"><?php echo e($c->sender->name); ?></td>
                        <td id="td_doctor_<?php echo e($c->id); ?>"><?php echo e($c->booking->schedule->doctor->name); ?></td>
                        <td id="td_type_<?php echo e($c->id); ?>"><?php echo e($c->tipe_sender); ?></td>
                        <td id="td_chat_<?php echo e($c->id); ?>"><?php echo e($c->chat); ?></td>
                        <td id="td_time_<?php echo e($c->id); ?>"><?php echo e($c->created_at); ?></td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm(<?php echo e($c->id); ?>)">Edit</a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete Chat <?php echo e($c->id); ?>?')) deleteDataRemove(<?php echo e($c->id); ?>)">Delete</a>
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
            <form method="POST" action="<?php echo e(url('/chats')); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Chat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-2">
                            <label>Booking</label>
                            <select class="form-control" name="booking_id">
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($booking->id); ?>"><?php echo e($booking->id); ?> - <?php echo e($booking->user->name); ?> -
                                        <?php echo e($booking->schedule->doctor->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Sender</label>
                            <select class="form-control" name="sender_id">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?> - <?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Sender Type</label>
                            <select class="form-control" name="tipe_sender">
                                <option value="user">user</option>
                                <option value="doctor">doctor</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Chat</label>
                            <textarea class="form-control" name="chat"></textarea>
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
                    <h4 class="modal-title">Edit Chat</h4>
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
                url: '<?php echo e(route("chats.getEditForm")); ?>',
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
            var booking_id = $('#booking_id').val();
            var sender_id = $('#sender_id').val();
            var tipe_sender = $('#tipe_sender').val();
            var chat = $('#chat').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("chats.saveDataUpdate")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'booking_id': booking_id,
                    'sender_id': sender_id,
                    'tipe_sender': tipe_sender,
                    'chat': chat
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_sender_' + id).html($('#sender_id option:selected').data('name'));
                        $('#td_doctor_' + id).html($('#booking_id option:selected').data('doctor'));
                        $('#td_type_' + id).html(tipe_sender);
                        $('#td_chat_' + id).html(chat);
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("chats.deleteData")); ?>',
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
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/chats/index.blade.php ENDPATH**/ ?>