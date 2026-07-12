

<?php $__env->startSection('title', 'Artikel Kesehatan'); ?>
<?php $__env->startSection('nav-articles', 'active'); ?>

<?php $__env->startSection('content'); ?>

<div class="lb-page-header">
    <div class="container">
        <h1>Artikel Kesehatan</h1>
        <p>Baca artikel kesehatan tepercaya dari dokter kami.</p>
    </div>
</div>

<div class="container mb-5">

    <form action="<?php echo e(route('member.articles.index')); ?>" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                class="form-control lb-form-control"
                placeholder="Cari artikel...">

            <button type="submit" class="btn btn-lb">
                Cari
            </button>
        </div>
    </form>

    <?php if($articles->isEmpty()): ?>
    <div class="lb-empty">
        <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
        Tidak ada artikel ditemukan.
    </div>
    <?php else: ?>

    <div class="row g-4">
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4">
            <div class="lb-card h-100 d-flex flex-column">

                <div class="p-4 d-flex flex-column flex-grow-1">
                    <div class="lb-card-icon">
                        <i class="bi bi-journal-medical"></i>
                    </div>

                    <h5 class="card-title mb-2">
                        <?php echo e($article->title); ?>

                    </h5>

                    <p class="mb-3 flex-grow-1">
                        <?php echo e(Str::limit(strip_tags($article->article), 100)); ?>

                    </p>

                    <p class="lb-meta mb-1">
                        <i class="bi bi-person-badge me-1"></i><?php echo e($article->doctor->name ?? 'Dokter'); ?>

                    </p>

                    <p class="lb-meta mb-3">
                        <i class="bi bi-calendar3 me-1"></i><?php echo e(\Carbon\Carbon::parse($article->date_published)->format('d M Y')); ?>

                    </p>

                    <a href="<?php echo e(route('member.articles.show', $article->id)); ?>"
                        class="btn btn-lb align-self-start mt-auto">
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