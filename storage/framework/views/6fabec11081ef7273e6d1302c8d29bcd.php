

<?php $__env->startSection('title', $article->title ?? 'Artikel Kesehatan'); ?>
<?php $__env->startSection('nav-articles', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <a href="<?php echo e(route('member.articles.index')); ?>" class="btn btn-secondary mb-3">
        Kembali
    </a>

    <?php if(!$article): ?>

    <div class="alert alert-danger">
        Artikel tidak ditemukan.
    </div>

    <?php else: ?>

    <div class="card">
        <div class="card-body">

            <h2><?php echo e($article->title); ?></h2>

            <p class="text-muted">
                Dokter: <?php echo e($article->doctor->name ?? 'Dokter'); ?>

            </p>

            <p class="text-muted">
                Tanggal Publikasi:
                <?php echo e(\Carbon\Carbon::parse($article->date_published)->format('d M Y')); ?>

            </p>

            <hr>

            <p>
                <?php echo nl2br(e($article->article)); ?>

            </p>

        </div>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/member/articles/show.blade.php ENDPATH**/ ?>