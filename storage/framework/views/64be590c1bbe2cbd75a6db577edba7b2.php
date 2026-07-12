

<?php $__env->startSection('title', 'Konsultasi'); ?>
<?php $__env->startSection('nav-consultations', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <a href="<?php echo e(route('doctor.consultations.index')); ?>" class="btn btn-secondary mb-3">
        Kembali
    </a>

    <?php if(!$consultation): ?>

    <div class="alert alert-danger">
        Konsultasi tidak ditemukan.
    </div>

    <?php else: ?>

    <div class="card mb-3">
        <div class="card-body">
            <h4>Konsultasi dengan <?php echo e($consultation->doctor->name); ?></h4>
            <p>
                Status: <b><?php echo e($consultation->status); ?></b>
            </p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body" id="chat" style="max-height: 400px; overflow-y: auto;">

            <?php $__empty_1 = true; $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-2 d-flex <?php echo e($chat->tipe_sender === 'user' ? 'justify-content-start' : 'justify-content-end'); ?>">
                <div class="p-2 rounded <?php echo e($chat->tipe_sender === 'user' ? 'bg-primary text-white' : 'bg-light'); ?>" style="max-width: 70%;">
                    <div><?php echo e($chat->chat); ?></div>
                    <small class="d-block text-end" style="opacity: 0.7;">
                        <?php echo e($chat->created_at); ?>

                    </small>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted">Belum ada pesan.</p>
            <?php endif; ?>

        </div>
    </div>

    <?php if($consultation->status === 'Aktif'): ?>
    <form action="<?php echo e(route('doctor.consultations.doctorChat', $consultation->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="input-group ">
            <input type="text" name="chat" class="form-control" placeholder="Tulis pesan..." required>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
    <?php else: ?>
    <div class="alert alert-secondary">
        Konsultasi ini sudah selesai.
    </div>
    <?php endif; ?>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $(function () {
    var cont = document.getElementById('chat');
    cont.scrollTop = cont.scrollHeight;
    });
    var idLast = <?php echo e($chats->isNotEmpty() && $chats->last()->id); ?>;
    var consId = <?php echo e($consultation->id); ?>;
    <?php if($consultation && $consultation->status === "Aktif"): ?>
    setInterval(function(){
        $.ajax({
            type: 'GET',
            url: '<?php echo e(route("chat.baca")); ?>',
            data: { 'consId': consId, 'idLast': idLast}, 
            success: function(data) {
                if (data.status == 'oke' && data.chats.length > 0) {
                    $.each(data.chats, function (i, chat) {
                        var user = chat.tipe_sender === 'doctor';
                        var align = user ? 'justify-content-end' : 'justify-content-start';
                        var chatBubble = user ? 'bg-primary text-white' : 'bg-light';
                        $('#chat').append('<div class="mb-2 d-flex ' + align + '">' +
                        '<div class="p-2 rounded ' + chatBubble + '" style="max-width: 70%;">' +
                        '<div>' + chat.chat + '</div>' + '<small class="d-block text-end" style="opacity: 0.7;">' + chat.created_at + '</small>' +'</div></div>');
                        idLast = chat.id;
                    });
                    var cont = document.getElementById('chat');
                    cont.scrollTop = cont.scrollHeight;
                }
            }
        })
    }, 3000);
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/doctor/consultations/show.blade.php ENDPATH**/ ?>