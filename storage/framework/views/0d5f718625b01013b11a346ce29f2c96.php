<?php $__env->startSection('title', 'Dokter'); ?>
<?php $__env->startSection('nav-doctors', 'active'); ?>

<?php $__env->startSection('content'); ?>

<div class="lb-page-header">
    <div class="container">
        <h1>Dokter Kami</h1>
        <p>Temukan dokter terbaik untuk kebutuhan kesehatan Anda.</p>
    </div>
</div>

<div class="container mb-5">

    <form action="<?php echo e(route('member.doctors.index')); ?>" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                class="form-control lb-form-control"
                placeholder="Cari dokter...">

            <button type="submit" class="btn btn-lb">
                Cari
            </button>
        </div>
    </form>

    <?php if($doctors->isEmpty()): ?>
    <div class="lb-empty">
        <i class="bi bi-person-x fs-1 d-block mb-2"></i>
        Tidak ada dokter ditemukan.
    </div>
    <?php else: ?>

    <div class="row g-4">
        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4">
            <div class="lb-card h-100">

                <div class="p-4">
                    <div class="lb-card-icon">
                        <i class="bi bi-person-hearts"></i>
                    </div>

                    <h5 class="card-title mb-1">
                        <?php echo e($doctor->name); ?>

                    </h5>

                    <p class="lb-meta mb-3">
                        <?php echo e($doctor->specialization->name ?? '-'); ?>

                    </p>

                    <p class="mb-0">
                        <i class="bi bi-envelope me-1"></i><?php echo e($doctor->email ?? '-'); ?>

                    </p>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/member/doctors/index.blade.php ENDPATH**/ ?>