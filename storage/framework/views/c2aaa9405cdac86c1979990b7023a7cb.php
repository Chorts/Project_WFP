

<?php $__env->startSection('title', 'Artikel Kesehatan'); ?>
<?php $__env->startSection('nav-articles', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h2>Artikel Kesehatan</h2>
    <p>Baca artikel kesehatan dari dokter kami.</p>

    <form action="<?php echo e(route('member.articles.index')); ?>" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                class="form-control"
                placeholder="Cari artikel...">

            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </div>
    </form>

    <?php if($articles->isEmpty()): ?>
    <div>
        Tidak ada artikel ditemukan.
    </div>
    <?php else: ?>

    <div class=" row">
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">

                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo e($article->title); ?>

                    </h5>

                    <p class="card-text">
                        <?php echo e(Str::limit(strip_tags($article->article), 100)); ?>

                    </p>

                    <p class="text-muted mb-2">
                        Dokter: <?php echo e($article->doctor->name ?? 'Dokter'); ?>

                    </p>

                    <p class="text-muted">
                        <?php echo e(\Carbon\Carbon::parse($article->date_published)->format('d M Y')); ?>

                    </p>

                    <a href="<?php echo e(route('member.articles.show', $article->id)); ?>"
                        class="btn btn-primary">
                        Baca Selengkapnya
                    </a>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\baru\Project_WFP\resources\views/member/articles/index.blade.php ENDPATH**/ ?>