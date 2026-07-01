<?php $__env->startSection('sidebar-transactions'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Transactions
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
            + New Transaction
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">Booking ID</td>
                    <td style="font-weight:bold">Patient ID</td>
                    <td style="font-weight:bold">Patient Name</td>
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Service ID</td>
                    <td style="font-weight:bold">Service Name</td>
                    <td style="font-weight:bold">Status</td>
                    <td style="font-weight:bold">Price</td>
                    <td style="font-weight:bold">Date</td>
                </tr>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="tr_<?php echo e($transaction->id); ?>">
                        <td id="td_booking_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->id); ?></td>
                        <td id="td_patient_id_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->user->id); ?></td>
                        <td id="td_patient_name_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->user->name); ?></td>
                        <td id="td_doctor_id_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->schedule->doctor->id); ?></td>
                        <td id="td_doctor_name_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->schedule->doctor->name); ?></td>
                        <td id="td_service_id_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->service->id); ?></td>
                        <td id="td_service_name_<?php echo e($transaction->id); ?>"><?php echo e($transaction->booking->service->service_name); ?></td>
                        <td id="td_status_<?php echo e($transaction->id); ?>"><?php echo e($transaction->status); ?></td>
                        <td id="td_price_<?php echo e($transaction->id); ?>"><?php echo e($transaction->price); ?></td>
                        <td id="td_date_<?php echo e($transaction->id); ?>"><?php echo e($transaction->transaction_date); ?></td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm(<?php echo e($transaction->id); ?>)">Edit</a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete Transaction <?php echo e($transaction->id); ?>?')) deleteDataRemove(<?php echo e($transaction->id); ?>)">
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
            <form method="POST" action="<?php echo e(url('/transactions')); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Transaction</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-2">
                            <label>Booking</label>
                            <select class="form-control" name="booking_id">
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($booking->id); ?>"><?php echo e($booking->id); ?> - <?php echo e($booking->user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Enter Price">
                        </div>
                        <div class="form-group mb-2">
                            <label>Transaction Date</label>
                            <input type="datetime-local" class="form-control" name="transaction_date">
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
                    <h4 class="modal-title">Edit Transaction</h4>
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
                url: '<?php echo e(route("transactions.getEditForm")); ?>',
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
            var booking_id = $('#booking_id').val();
            var status = $('#status').val();
            var price = $('#price').val();
            var transaction_date = $('#transaction_date').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("transactions.saveDataUpdate")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'booking_id': booking_id,
                    'status': status,
                    'price': price,
                    'transaction_date': transaction_date,
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#td_booking_' + id).html($('#booking_id').val());
                        $('#td_patient_id_' + id).html($('#booking_id option:selected').data('patient-id'));
                        $('#td_patient_name_' + id).html($('#booking_id option:selected').data('patient-name'));
                        $('#td_doctor_id_' + id).html($('#booking_id option:selected').data('doctor-id'));
                        $('#td_doctor_name_' + id).html($('#booking_id option:selected').data('doctor-name'));
                        $('#td_service_id_' + id).html($('#booking_id option:selected').data('service-id'));
                        $('#td_service_name_' + id).html($('#booking_id option:selected').data('service-name'));
                        $('#td_status_' + id).html(status);
                        $('#td_price_' + id).html(price);
                        $('#td_date_' + id).html(transaction_date);
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("transactions.deleteData")); ?>',
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
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\PROJECT\Project_WFP-main\resources\views/transactions/index.blade.php ENDPATH**/ ?>