<h2>Edit Chat</h2>

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="form-group mb-2">
    <label>Booking</label>
    <select class="form-control" id="booking_id">
        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($booking->id); ?>" data-doctor="<?php echo e($booking->schedule->doctor->name); ?>" <?php echo e($data->booking_id == $booking->id ? 'selected' : ''); ?>><?php echo e($booking->id); ?> - <?php echo e($booking->user->name); ?> -
                <?php echo e($booking->schedule->doctor->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group mb-2">
    <label>Sender</label>
    <select class="form-control" id="sender_id">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>" data-name="<?php echo e($user->name); ?>" <?php echo e($data->sender_id == $user->id ? 'selected' : ''); ?>><?php echo e($user->id); ?> - <?php echo e($user->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group mb-2">
    <label>Sender Type</label>
    <select class="form-control" id="tipe_sender">
        <option value="user" <?php echo e($data->tipe_sender == 'user' ? 'selected' : ''); ?>>user</option>
        <option value="doctor" <?php echo e($data->tipe_sender == 'doctor' ? 'selected' : ''); ?>>doctor</option>
    </select>
</div>

<div class="form-group mb-2">
    <label>Chat</label>
    <textarea class="form-control" id="chat"><?php echo e($data->chat); ?></textarea>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate(<?php echo e($data->id); ?>)">Submit</button><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/chats/getEditForm.blade.php ENDPATH**/ ?>