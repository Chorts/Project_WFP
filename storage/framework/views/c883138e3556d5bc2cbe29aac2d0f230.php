

<?php $__env->startSection('title', 'Consultation Saya'); ?>
<?php $__env->startSection('nav-consultations', 'active'); ?>

<?php $__env->startSection('content'); ?>

<div class="lb-page-header">
    <div class="container">
        <h1>Konsultasi Saya</h1>
        <p>Riwayat dan status konsultasi Anda dengan dokter.</p>
    </div>
</div>

<div class="container mb-5">

    <?php if($consultations->isEmpty()): ?>

    <div class="lb-empty">
        <i class="bi bi-chat-square-x fs-1 d-block mb-2"></i>
        Anda belum memiliki konsultasi.
    </div>

    <?php else: ?>

    <div class="table-responsive lb-table">
        <table class="table mb-0 align-middle">
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
                    <td>
                        <span class="lb-badge <?php echo e($consultation->status == 'Aktif' ? 'lb-badge-active' : 'lb-badge-done'); ?>">
                            <?php echo e($consultation->status ?? '-'); ?>

                        </span>
                    </td>
                    <td><?php echo e($consultation->started_at ?? '-'); ?></td>
                    <td><?php echo e($consultation->ended_at ?? '-'); ?></td>

                    <td>
                        <?php if($consultation->status == "Aktif"): ?>
                        <a href="<?php echo e(route('member.consultations.show', $consultation->id)); ?>" class="btn btn-lb btn-sm">
                            Lihat Chat
                        </a>
                        <?php else: ?>
                        <a href="<?php echo e(route('member.consultations.show', $consultation->id)); ?>" class="btn btn-lb-outline btn-sm">
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
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\baru\Project_WFP\resources\views/member/consultations/index.blade.php ENDPATH**/ ?>