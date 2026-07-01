

<?php $__env->startSection('title', 'Dokter'); ?>
<?php $__env->startSection('nav-doctors', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h2>Dokter Kami</h2>
    <p>Temukan dokter terbaik untuk kebutuhan kesehatan Anda.</p>

    <form action="<?php echo e(route('member.doctors.index')); ?>" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                class="form-control"
                placeholder="Cari dokter...">

            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </div>
    </form>

    <?php if($doctors->isEmpty()): ?>
    <div>
        Tidak ada dokter ditemukan.
    </div>
    <?php else: ?>

    <div class=" row">
        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">

                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo e($doctor->name); ?>

                    </h5>

                    <p class="card-text">
                        <?php echo e($doctor->specialization->name ?? '-'); ?>

                    </p>

                    <p class="card-text">
                        Dokter: <?php echo e($doctor->email ?? '-'); ?>

                    </p>

                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\PROJECT\Project_WFP-main\resources\views/member/doctors/index.blade.php ENDPATH**/ ?>