

<?php $__env->startSection('title', 'Consultation Saya'); ?>
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
                <th>Chat</th>
                <th>Ringkasan</th>


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
                    <a href="<?php echo e(route('member.consultations.show', $consultation->id)); ?>" class="btn btn-sm btn-primary">
                        Lihat Chat
                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('member.consultations.show', $consultation->id)); ?>" class="btn btn-sm btn-primary">
                        Lihat histori chat
                    </a>
                    <?php endif; ?>

                </td>
                <td>
                    <?php if($consultation->ringkasan != ""): ?>
                    <?php echo e($consultation->ringkasan ?? '-'); ?>

                    <?php endif; ?>

                    Belum tersedia
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/member/consultations/index.blade.php ENDPATH**/ ?>