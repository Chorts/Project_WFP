

<?php $__env->startSection('title', $doctor->name); ?>
<?php $__env->startSection('nav-doctors', 'active'); ?>

<?php $__env->startSection('content'); ?>

<div class="lb-page-header">
    <div class="container">
        <h1><?php echo e($doctor->name); ?></h1>
        <p><?php echo e($doctor->specialization->name ?? '-'); ?></p>
    </div>
</div>

<div class="container mb-5">
    <a href="<?php echo e(route('member.doctors.index')); ?>" class="btn btn-link mb-3 ps-0">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Dokter
    </a>

    <div class="row g-4">
        <div class="col-md-4 text-center">
            <?php if($doctor->photo): ?>
            <img src="<?php echo e(asset('storage/' . $doctor->photo)); ?>" alt="<?php echo e($doctor->name); ?>"
                class="img-fluid rounded-circle mb-3" style="width:220px;height:220px;object-fit:cover;">
            <?php else: ?>
            <div class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center mb-3"
                style="width:220px;height:220px;margin:0 auto;">
                <i class="bi bi-person-hearts fs-1"></i>
            </div>
            <?php endif; ?>

            <?php if($doctor->phone): ?>
            <p class="mb-1"><i class="bi bi-telephone me-1"></i><?php echo e($doctor->phone); ?></p>
            <?php endif; ?>
            <?php if($doctor->user && $doctor->user->email): ?>
            <p class="mb-1"><i class="bi bi-envelope me-1"></i><?php echo e($doctor->user->email); ?></p>
            <?php endif; ?>
        </div>

        <div class="col-md-8">
            <div class="lb-card p-4">
                <h5 class="mb-3">Tentang Dokter</h5>

                <p class="mb-2">
                    <strong>Spesialisasi:</strong> <?php echo e($doctor->specialization->name ?? '-'); ?>

                </p>

                <?php if(!is_null($doctor->experience_years)): ?>
                <p class="mb-2">
                    <strong>Pengalaman:</strong> <?php echo e($doctor->experience_years); ?> tahun
                </p>
                <?php endif; ?>

                <?php if($doctor->bio): ?>
                <p class="mb-2">
                    <strong>Bio:</strong><br>
                    <?php echo e($doctor->bio); ?>

                </p>
                <?php else: ?>
                <p class="text-muted">Dokter belum menambahkan bio.</p>
                <?php endif; ?>

                <?php if($doctor->schedules && $doctor->schedules->count()): ?>
                <hr>
                <h5 class="mb-3">Jadwal Praktik</h5>
                <ul class="list-unstyled mb-0">
                    <?php $__currentLoopData = $doctor->schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mb-1">
                        <strong><?php echo e($schedule->day); ?></strong>:
                        <?php echo e(\Carbon\Carbon::parse($schedule->start_time)->format('H:i')); ?> -
                        <?php echo e(\Carbon\Carbon::parse($schedule->end_time)->format('H:i')); ?>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/member/doctors/show.blade.php ENDPATH**/ ?>