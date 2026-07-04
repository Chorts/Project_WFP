

<?php $__env->startSection('title', 'Daftar Konsultasi'); ?>
<?php $__env->startSection('nav-consultations', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Konsultasi Saya</h2>
    </div>

    <?php if($consultations->isEmpty()): ?>

    <div class="alert alert-info">
        Anda belum memiliki konsultasi.
    </div>

    <?php else: ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Dokter</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>

            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($consultation->booking_id); ?></td>
                <td><?php echo e($consultation->doctor->name ?? '-'); ?></td>
                <td><?php echo e($consultation->status ?? '-'); ?></td>
                <td><?php echo e($consultation->started_at ?? '-'); ?></td>
                <td><?php echo e($consultation->ended_at ?? '-'); ?></td>

                <td>
                    <?php if($consultation->status == "Aktif"): ?>
                    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalClose<?php echo e($consultation->id); ?>">
                        Tutup Konsultasi
                    </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('modals'); ?>

<?php if(!$consultations->isEmpty()): ?>
<?php $__currentLoopData = $consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($consultation->status == "Aktif"): ?>

<div class="modal fade" id="modalClose<?php echo e($consultation->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('doctor.consultations.close', $consultation->id)); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tutup Konsultasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="form-group mb-2">
                        <label>Ringkasan Konsultasi</label>
                        <textarea class="form-control" name="ringkasan" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tutup Konsultasi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/doctor/consultations/index.blade.php ENDPATH**/ ?>