<?php $__env->startSection('title', 'Konsultasi'); ?>
<?php $__env->startSection('nav-consultations', 'active'); ?>

<?php $__env->startSection('content'); ?>

<div class="lb-page-header">
    <div class="container">
        <h1>Konsultasi<?php echo e($consultation ? ' dengan ' . $consultation->doctor->name : ''); ?></h1>
        <?php if($consultation): ?>
        <p>
            Status:
            <span class="lb-badge <?php echo e($consultation->status === 'Aktif' ? 'lb-badge-active' : 'lb-badge-done'); ?>">
                <?php echo e($consultation->status); ?>

            </span>
        </p>
        <?php endif; ?>
    </div>
</div>

<div class="container mb-5">

    <a href="<?php echo e(route('member.consultations.index')); ?>" class="btn btn-lb-outline mb-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>

    <?php if(!$consultation): ?>

    <div class="lb-empty">
        <i class="bi bi-chat-square-x fs-1 d-block mb-2"></i>
        Konsultasi tidak ditemukan.
    </div>

    <?php else: ?>

    <div class="lb-chat-box mb-3">
        <div class="p-3" style="max-height: 420px; overflow-y: auto;">

            <?php $__empty_1 = true; $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-3 d-flex <?php echo e($chat->tipe_sender === 'user' ? 'justify-content-end' : 'justify-content-start'); ?>">
                <div class="lb-bubble <?php echo e($chat->tipe_sender === 'user' ? 'lb-bubble-user' : 'lb-bubble-other'); ?>">
                    <div><?php echo e($chat->chat); ?></div>
                    <small class="d-block text-end mt-1" style="opacity: 0.7; font-size: 10px;">
                        <?php echo e($chat->created_at); ?>

                    </small>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted mb-0">Belum ada pesan.</p>
            <?php endif; ?>

        </div>
    </div>

    <?php if($consultation->status === 'Aktif'): ?>
    <form action="<?php echo e(route('member.consultations.memberChat', $consultation->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="input-group">
            <input type="text" name="chat" class="form-control lb-form-control" placeholder="Tulis pesan..." required>
            <button type="submit" class="btn btn-lb">Kirim</button>
        </div>
    </form>
    <?php else: ?>
    <div class="lb-empty py-3">
        Konsultasi ini sudah selesai.
    </div>
    <?php endif; ?>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/member/consultations/show.blade.php ENDPATH**/ ?>