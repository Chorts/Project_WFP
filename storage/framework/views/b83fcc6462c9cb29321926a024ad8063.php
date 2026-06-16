<h2>Edit Transaction</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Booking</label>
    <select class="form-control" id="booking_id">
        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($booking->id); ?>"
                data-patient-id="<?php echo e($booking->user->id); ?>"
                data-patient-name="<?php echo e($booking->user->name); ?>"
                data-doctor-id="<?php echo e($booking->schedule->doctor->id); ?>"
                data-doctor-name="<?php echo e($booking->schedule->doctor->name); ?>"
                data-service-id="<?php echo e($booking->service->id); ?>"
                data-service-name="<?php echo e($booking->service->service_name); ?>"
                <?php echo e($data->booking_id == $booking->id ? 'selected' : ''); ?>>
                <?php echo e($booking->id); ?> - <?php echo e($booking->user->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group mb-2">
    <label>Status</label>
    <select class="form-control" id="status">
        <option value="Menunggu Pembayaran" <?php echo e($data->status == 'Menunggu Pembayaran' ? 'selected' : ''); ?>>Menunggu Pembayaran</option>
        <option value="Dibatalkan" <?php echo e($data->status == 'Dibatalkan' ? 'selected' : ''); ?>>Dibatalkan</option>
        <option value="Lunas" <?php echo e($data->status == 'Lunas' ? 'selected' : ''); ?>>Lunas</option>
    </select>
</div>

<div class="form-group mb-2">
    <label>Price</label>
    <input type="number" class="form-control" id="price" value="<?php echo e($data->price); ?>">
</div>

<div class="form-group mb-2">
    <label>Transaction Date</label>
    <input type="datetime-local" class="form-control" id="transaction_date" value="<?php echo e(\Carbon\Carbon::parse($data->transaction_date)->format('Y-m-d\TH:i')); ?>">
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/transactions/getEditForm.blade.php ENDPATH**/ ?>